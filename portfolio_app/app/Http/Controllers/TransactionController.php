<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{

    public function TransactionsView()
    {

        return view('transactions.index');

    }

    public function PurchasesView()
    {

        $purchases = Transaction::where('transaction_type', 1)->whereIn('user_id', [Auth::id()])->orderBy('created_at', 'DESC')->paginate(perPage: 5);
        
        $stocks = DB::table('transactions')
                ->join('stocks', 'transactions.stock_id', '=', 'stocks.id')
                ->select('stocks.id', 'stocks.name')->get();

        $stocks = json_decode($stocks, true);

        $stocks_id = [];

        for ($i = 0; $i < sizeof($stocks); $i++) {
            array_push($stocks_id, $stocks[$i]['id']);
        }

        $stocks = Stock::all()->whereIn('id', $stocks_id);  

        return view('transactions.purchases', compact('purchases', 'stocks'));  

    }

    public function SalesView()
    {

        $sales = Transaction::where('transaction_type', 2)->whereIn('user_id', [Auth::id()])->orderBy('created_at', 'DESC')->paginate(perPage: 5);
        
        $stocks = DB::table('transactions')
                ->join('stocks', 'transactions.stock_id', '=', 'stocks.id')
                ->select('stocks.id', 'stocks.name')->get();
                
        $stocks = json_decode($stocks, true);

        $stocks_id = [];

        for ($i = 0; $i < sizeof($stocks); $i++) {
            array_push($stocks_id, $stocks[$i]['id']);
        }

        $stocks = Stock::all()->whereIn('id', $stocks_id);  
        
        return view('transactions.sales', compact('sales', 'stocks'));   
           
    }

    public function DestroyPurchaseTransaction($transactionId)
    {

        $transaction = Transaction::find($transactionId);
        $transaction->delete();
        return redirect('/transacoes/compras');

    }

    public function DestroySaleTransaction($transactionId)
    {
        
        $transaction = Transaction::find($transactionId);
        $transaction->delete();
        return redirect('/transacoes/vendas');

    }

}
