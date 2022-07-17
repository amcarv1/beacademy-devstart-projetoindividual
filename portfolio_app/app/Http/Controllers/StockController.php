<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

require realpath(dirname(__FILE__, 3)).'\Helpers\Awesome\Cotation.php';


class StockController extends Controller
{

    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        { 
            $stock = new Stock;
            $stock->name = $request->name;
            $stock->ticket = $request->ticket;
            $stock->price = $request->price;
            $stock->save();
            return redirect()->route('stocks.index');
        }    
    }


    public function edit($id)
    {
        $stock = Stock::find($id);
        return ($stock) ? view('stocks.edit', compact('stock')) : redirect()->route('stocks.index');
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        
        $data = $request->only('name', 'ticket', 'price');

        $stock->update($data);

        return redirect()->route('stocks.index');
    }

    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete(); 
 
        return redirect('/stocks')->with('success', 'Stock removed.');
    }


    public function getQuote($ticket = "AMZN") 
    {
        $jsonurl = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=" . urlencode($ticket) . "&apikey=" . env('AVANTAGE_API_KEY');
        $jsonResponse = file_get_contents($jsonurl);
        $jsonResponseDecode = json_decode($jsonResponse);
        if (isset($jsonResponseDecode->{env('AVANTAGE_API_PARENT')}->{env('AVANTAGE_API_CHILD')})) {  //Validation for empty response(Stock not found). 
            $currentQuote = round($jsonResponseDecode->{env('AVANTAGE_API_PARENT')}->{env('AVANTAGE_API_CHILD')},2);
        } else { 
            $currentQuote = false;
        }
        return $currentQuote;
    }
 

    public function updateQuote($id) 
    {
        $stock = Stock::find($id);
        $updatedQuote = self::getQuote($stock->ticket);
        if ($updatedQuote) { 
            $stock->price = $updatedQuote;
            $stock->save();
            return redirect('/portfolio');
        } else {
            return response('erro');
        }
    }

    public function updateAllQuote() 
    {
        $stocks = DB::table('stocks')
        ->join('stocks_in_portfolios', 'stocks.id', '=', 'stocks_in_portfolios.stock_id')
        ->join('portfolios', 'stocks_in_portfolios.portfolio_id', '=', 'portfolios.id')
        ->join('users', 'portfolios.user_id', '=', 'users.id')
        ->addSelect('stocks.id', 'stocks.name', 'stocks.ticket', DB::raw('COUNT(stocks.id)'), DB::raw('(COUNT(stocks.id) * stocks.price)'),'stocks.price')
        ->where('users.id', Auth::id())
        ->groupBy('stocks.name')
        ->get();

        $stocks = json_decode($stocks, true);
        $dados = [];
        for($i = 0; $i < sizeof($stocks); $i++){
            array_push($dados, $stocks[$i]['id']);
        }

        for($i = 0; $i < sizeof($stocks); $i++) {
            foreach($dados as $id){
                $stock = Stock::find($id);
                $updatedQuote = self::getQuote($stock->ticket);
                if ($stock->category == 1) {
                    $stock->price = ($updatedQuote * dolarValue());
                } else {
                    $stock->price = $updatedQuote;
                }
                $stock->save();
            }
        }


        return view('portfolio.index', compact('stocks'));
    }
}
