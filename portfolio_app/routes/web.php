<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// stocks routes
Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::put('/stocks/edit/{id}', [StockController::class, 'update'])->name('stocks.update');
Route::delete('/stocks/{id}', [StockController::class, 'destroy'])->name('stocks.destroy');
Route::post('stocks/updateQuote/{id}', [StockController::class, 'updateQuote'])->name('stocks.updateQuote');

Route::post('/portfolio', [StockController::class, 'updateAllQuote'])->name('stocks.updateAllQuote');


// user routes
Route::get('/portfolio', [PortfolioController::class, 'PortfolioView'])->name('portfolio.index');
Route::get('portfolio/escolher', [PortfolioController::class, 'PortfolioChoiceStock'])->name('portfolio.choice');
Route::get('/portfolio/{id}/negociar-compra', [PortfolioController::class, 'NegotiateStockPurchase'])->name('portfolio.purchase');
Route::put('/portfolio/comprar/{id}', [PortfolioController::class, 'FinalizePurchase'])->name('portfolio.buy');
Route::get('/portfolio/{id}/negociar-venda', [PortfolioController::class, 'NegotiateStockSale'])->name('portfolio.sale');
Route::put('/portfolio/vender/{id}', [PortfolioController::class, 'FinalizeSale'])->name('portfolio.sell');
Route::delete('/portfolio/{id}', [PortfolioController::class, 'DeleteStock'])->name('portfolio.destroy');

// transactions routes
Route::get('/transacoes', [TransactionController::class, 'TransactionsView'])->name('transactions.index');
Route::get('/transacoes/compras', [TransactionController::class, 'PurchasesView'])->name('transactions.purchases');
Route::delete('/transacoes/compras/{id}', [TransactionController::class, 'DestroyPurchaseTransaction'])->name('transactions.purchase.destroy');
Route::get('/transacoes/vendas', [TransactionController::class, 'SalesView'])->name('transactions.sales');
Route::delete('/transacoes/vendas/{id}', [TransactionController::class, 'DestroySaleTransaction'])->name('transactions.sale.destroy');

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('generate-pdf', [ProjectController::class, 'pdfview'])->name('generate-pdf');


