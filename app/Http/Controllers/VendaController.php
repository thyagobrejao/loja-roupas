<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\Produto;
use App\Models\Saida;
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
            ->get();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendedoras_id' => 'required',
            'clientes_id' => 'required',
            'formas_pagamentos_id' => 'required',
        ]);

        $venda = new Venda();
        $venda->vendedoras_id = $request->get("vendedoras_id");
        $venda->clientes_id = $request->get("clientes_id");
        $venda->formas_pagamentos_id = $request->get("formas_pagamentos_id");
        $venda->desconto = $request->get("desconto");
        $venda->save();

        foreach ($request->get("saidas") as $saidas) {
            $saida = new Saida();
            $saida->produtos_id = $saidas["produtos_id"];
            $saida->quantidade = $saidas["quantidade"];
            $saida->tamanho = $saidas["tamanho"];
            $saida->reserva = $saidas["reserva"];
            $saida->valor_venda = $saidas["valor_venda"];
            $saida->vendas_id = $venda->id;
            $saida->save();
        }

        return redirect()->back();

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
