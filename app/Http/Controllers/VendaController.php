<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Vendedora;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $vendas = Venda::with(['Cliente','Vendedora','Saida','FormaPagamento'])->get();
        $produdos = Produto::with(['Foto', 'TipoProduto'])->where("ativo", true)
            ->get()
            ->filter(function($item) {
                return $item->estoque > 0;
            });
        $clientes = Cliente::all();
        $vendedoras = Vendedora::all();
        $formas_pagamento = FormaPagamento::all();

        return Inertia::render('Venda',
            [
                "vendas" => $vendas,
                "clientes" => $clientes,
                "vendedoras" => $vendedoras,
                "produtos" => $produdos,
                "formas_pagamento" => $formas_pagamento
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
