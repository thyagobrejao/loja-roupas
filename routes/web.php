<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\FornecedoreController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SaidaController;
use App\Http\Controllers\TipoProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendedoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    Route::resources([
        'entrada' => EntradaController::class,
        'cliente' => ClienteController::class,
        'formaPagamento' => FormaPagamentoController::class,
        'fornecedor' => FornecedoreController::class,
        'foto' => FotoController::class,
        'notaFiscal' => NotaFiscalController::class,
        'produto' => ProdutoController::class,
        'saida' => SaidaController::class,
        'tipoProduto' => TipoProdutoController::class,
        'venda' => VendaController::class,
        'vendedora' => VendedoraController::class,
    ]);

    Route::put('/produto/ativo/{produto}', [ProdutoController::class, 'ativo'])->name('produto.ativo');

    Route::get('images', function (Request $request) {
        $path = $request->get("path");
        $ret = storage_path("app/public") . '/' . $path;
        if (file_exists($ret)) {
            return response()->file($ret);
        }
    });
});
