<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\NotaFiscal;
use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $entradas = Entrada::with(['Produto.Foto', 'Produto.TipoProduto'])->get();
        $notas_fiscais = NotaFiscal::all();
        $produtos = Produto::with(['Foto'])->where('ativo', true)->get();
        return Inertia::render('Entradas',
            [
                "entradas" => $entradas,
                "notas_fiscais" => $notas_fiscais,
                "produtos" => $produtos
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
            'quantidade' => 'required',
            'tamanho' => 'required',
            'valor_unitario' => 'required',
            'status' => 'required',
            'produtos_id' => 'required',
        ]);

        Entrada::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Entrada $entrada)
    {
        $request->validate([
            'quantidade' => 'required',
            'tamanho' => 'required',
            'valor_unitario' => 'required',
            'status' => 'required',
            'produtos_id' => 'required',
        ]);

        $entrada->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
