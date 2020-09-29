<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $notas_fiscais = NotaFiscal::all();
        return Inertia::render('NotaFiscal',
            [
                "notas_fiscais" => $notas_fiscais
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
            'valor_total' => 'required',
            'date' => 'required',
        ]);

        $nota = new NotaFiscal();

        if ($request->hasFile('foto')) {
            $foto = $request->file("foto");
            $name = time().'.'.$foto->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/notas');
            $foto->move($destinationPath, $name);
            $nota->caminho_foto = $name;
        }

        $nota->valor_total = $request->get("valor_total");
        $nota->data = Carbon::parse($request->get("date"));
        $nota->save();

        return Redirect::route('notaFiscal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function show(NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, NotaFiscal $notaFiscal)
    {

        $request->validate([
            'valor_total' => 'required',
            'date' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            File::delete(storage_path("/app/public/notas/" . $notaFiscal->caminho_foto));
            $foto = $request->file("foto");
            $name = time().'.'.$foto->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/notas');
            $foto->move($destinationPath, $name);
            $notaFiscal->caminho_foto = $name;
        }

        $notaFiscal->valor_total = $request->get("valor_total");
        $notaFiscal->data = Carbon::parse($request->get("date"));
        $notaFiscal->save();

        return Redirect::route('notaFiscal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaFiscal  $notaFiscal
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaFiscal $notaFiscal)
    {
        //
    }
}
