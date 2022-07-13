<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Portfolio;
use App\Models\StocksInPortfolio;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function PortfolioView()
    {

        $portfolio = new Portfolio();
        
        try {
            $portfolio->user_id = Auth::id();
            $portfolio->save();
        }catch(\Exception $e){
            //
        }

        $stocks = DB::table('stocks')
        ->join('stocks_in_portfolios', 'stocks.id', '=', 'stocks_in_portfolios.stock_id')
        ->join('portfolios', 'stocks_in_portfolios.portfolio_id', '=', 'portfolios.id')
        ->join('users', 'portfolios.user_id', '=', 'users.id')
        ->addSelect('stocks.id', 'stocks.name', 'stocks.ticket', DB::raw('COUNT(stocks.id)'), DB::raw('(COUNT(stocks.id) * stocks.price)'),'stocks.price')
        ->where('users.id', Auth::id())
        ->groupBy('stocks.name')
        ->get();

        $stocks = json_decode($stocks, true);
        
        return view('portfolio.index', compact('stocks'));

    }


    public function PortfolioChoiceStock()
    {
        $stocks = Stock::all();

        return view('portfolio.choice', compact('stocks'));
    }

    public function NegotiateStockPurchase($StockId)
    {
        $stock = Stock::findOrFail($StockId);

        return view('portfolio.purchase', compact('stock'));
    }

    public function FinalizePurchase(Request $request, $StockId)
    {
        
        $stocks = DB::table('users')
        ->join('portfolios', 'users.id', '=', 'portfolios.user_id')
        ->addSelect('portfolios.id')
        ->where('users.id', Auth::id())
        ->get();

        $stocks = json_decode($stocks, true);

        $purchase = new Transaction();
        $purchase->user_id = Auth::id();
        $purchase->transaction_type = 1;
        $purchase->stock_id = $StockId;
        $purchase->quantity = $request->quantity;
        $purchase->created_at = $request->created_at;
        $purchase->value = ($request->value * $purchase->quantity);
        $purchase->save();

        for($i = 1; $i <= $request->quantity; $i++){
            $stock_in_portfolio = new StocksInPortfolio();
            $stock_in_portfolio->portfolio_id = $stocks[0]['id'];
            $stock_in_portfolio->stock_id = $StockId; 
            $stock_in_portfolio->save();     
        }

        return redirect()->route('portfolio.index')->with('msg', $request->quantity.' Ativo(s) de '.(Stock::find($purchase->stock_id))->name.' Adicionado(s)!');
    }

    public function NegotiateStockSale($StockId)
    {
        $stock = Stock::findOrFail($StockId);

        return view('portfolio.sale', compact('stock'));
    }

    public function FinalizeSale(Request $request, $StockId)
    {
        $raw_query = 'DELETE 
                        FROM stocks_in_portfolios
                        WHERE portfolio_id = ? 
                        AND stock_id = ?
                        LIMIT ?;'; 

        $stocks = DB::table('users')
        ->join('portfolios', 'users.id', '=', 'portfolios.user_id')
        ->addSelect('portfolios.id')
        ->where('users.id', Auth::id())
        ->get();

        $stocks = json_decode($stocks, true);
        $idPortfolio = $stocks[0]['id'];

        $stock_in_portfolio = DB::table('stocks_in_portfolios')
        ->join('portfolios', 'stocks_in_portfolios.portfolio_id', '=', 'portfolios.id')
        ->addSelect(DB::raw('COUNT(stocks_in_portfolios.stock_id)'))
        ->where('portfolios.user_id', Auth::id())
        ->groupBy('stocks_in_portfolios.stock_id')
        ->get();

        $stock_in_portfolio = json_decode($stock_in_portfolio, true);  

        $amountInPortfolio = ($stock_in_portfolio[0]['COUNT(stocks_in_portfolios.stock_id)']);

        if($request->quantity <= $amountInPortfolio && $request->quantity > 0) {
            $status = DB::delete($raw_query, array($idPortfolio, $StockId, $request->quantity));
            $sale = new Transaction();
            $sale->user_id = Auth::id();
            $sale->transaction_type = 2;
            $sale->stock_id = $StockId;
            $sale->created_at = $request->created_at;
            $sale->quantity = $request->quantity;
            $sale->value = ($request->value * $sale->quantity);
            $sale->save();
            
            return redirect()->route('portfolio.index')->with('msg', $request->quantity.' Ativo(s) de '.(Stock::find($sale->stock_id))->name.' Vendido(s)!');
        }   else {
                return redirect()->route('portfolio.sale', $StockId)->with('msg', 'Erro: Você digitou uma quantidade de venda inválida carteira!');
        }   
        
    }

    public function DeleteStock($stockId)
    {
        $raw_query = 'DELETE stocks_in_portfolios
                    FROM stocks_in_portfolios
                    INNER JOIN portfolios 
                    ON stocks_in_portfolios.portfolio_id = portfolios.id
                    WHERE portfolios.id = ?
                    AND stocks_in_portfolios.stock_id = ?'; 

        $stocks = DB::table('users')
        ->join('portfolios', 'users.id', '=', 'portfolios.user_id')
        ->addSelect('portfolios.id')
        ->where('users.id', Auth::id())
        ->get();


        $stocks = json_decode($stocks, true);
        $idPortfolio = $stocks[0]['id'];

        $status = DB::delete($raw_query, array($idPortfolio, $stockId));
        
        return redirect()->route('portfolio.index');
    }}
