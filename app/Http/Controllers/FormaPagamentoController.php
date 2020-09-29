<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $forma_pagamento = FormaPagamento::all();
        return Inertia::render('FormaPagamento', ["forma_pagamento" => $forma_pagamento]);
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
            'descricao' => 'required',
            'taxa' => 'required',
        ]);

        FormaPagamento::create($request->all());

        return Redirect::route('formaPagamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormaPagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function show(FormaPagamento $formaPagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormaPagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(FormaPagamento $formaPagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormaPagamento  $formaPagamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, FormaPagamento $formaPagamento)
    {
        $request->validate([
            'descricao' => 'required',
            'taxa' => 'required',
        ]);

        $formaPagamento->update($request->all());

        return Redirect::route('formaPagamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormaPagamento  $formaPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaPagamento $formaPagamento)
    {
        //
    }
}
