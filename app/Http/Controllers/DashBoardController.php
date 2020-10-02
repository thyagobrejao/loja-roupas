<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashBoardController extends Controller
{
    public function index() {

        $estoque = Produto::with(['Foto', 'TipoProduto', 'Fornecedore', 'Entrada', 'Saida'])->get();

        $entradas = ['qts' => 0, 'valor' => 0];
        $saidas = ['qts' => 0, 'valor' => 0];

        foreach ($estoque as $etq) {
            foreach ($etq->Entrada as $entrada) {
                $entradas['qts'] += $entrada->quantidade;
                $entradas['valor'] += $entrada->quantidade * $entrada->valor_unitario;
            }
        }

        foreach ($estoque as $etq) {
            foreach ($etq->Saida as $saida) {
                $saidas['qts'] += $saida->quantidade;
                $saidas['valor'] += $saida->quantidade * $saida->valor_venda;
            }
        }

        $numeros = ['entradas' => $entradas, 'saidas' => $saidas];

        return Inertia::render('Dashboard', ['estoque' => $estoque, 'numeros' => $numeros]);
    }
}
