<?php

namespace App\Http\Controllers;

use App\Models\Vendedora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VendedoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $vendedoras = Vendedora::all();
        return Inertia::render('Vendedoras', ["vendedoras" => $vendedoras]);
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
            'nome' => 'required|max:60',
        ]);

        Vendedora::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedora $vendedora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedora $vendedora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedora  $vendedora
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Vendedora $vendedora)
    {
        $request->validate([
            'nome' => 'required|max:60',
        ]);

        $vendedora->update($request->all());

        return Redirect::route('vendedora.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedora  $vendedora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedora $vendedora)
    {
        //
    }
}
