<?php

namespace App\Http\Controllers;

use App\Models\Fornecedore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FornecedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $fornecedores = Fornecedore::all();
        return Inertia::render('Fornecedores', ["fornecedores" => $fornecedores]);
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
            'nome' => 'required|max:100',
            'endereco' => 'max:100',
        ]);

        Fornecedore::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedore  $fornecedore
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedore $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedore  $fornecedore
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedore $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedore  $fornecedore
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Fornecedore $fornecedor)
    {
        $request->validate([
            'nome' => 'max:60',
        ]);

        $fornecedor->update($request->all());

        return Redirect::route('fornecedor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedore  $fornecedore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedore $fornecedor)
    {
        //
    }
}
