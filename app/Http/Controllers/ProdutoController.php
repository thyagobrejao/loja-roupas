<?php

namespace App\Http\Controllers;

use App\Models\Fornecedore;
use App\Models\Foto;
use App\Models\Produto;
use App\Models\TipoProduto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $produtos = Produto::with(['Foto', 'Fornecedore', 'TipoProduto'])->get();
        $fornecedores = Fornecedore::pluck('nome', 'id');
        $tipos_produtos = TipoProduto::pluck('descricao', 'id');

        return Inertia::render('Produtos', [
            "produtos" => $produtos,
            "fornecedores" => $fornecedores,
            "tipos_produtos" => $tipos_produtos
        ]);
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
            'descricao' => 'required|max:255',
            'cor' => 'required|max:20',
            'codigo' => 'required|max:30',
            'fornecedores_id' => 'required',
            'tipos_id' => 'required',
            'valor_sugerido' => 'required',
        ]);

        $produto = Produto::create($request->except(['fotos']));

        $fotos = $request->file("fotos");

        if($request->hasFile('fotos')) {
            foreach ($fotos as $foto) {
                $fotoModel = new Foto();
                $path = "produtos/" . Carbon::now()->format("m-Y");
                $name = time().'.'.$foto->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/' . $path);
                $foto->move($destinationPath, $name);
                $fotoModel->caminho = $path . '/' . $name;
                $fotoModel->produtos_id = $produto->id;
                $fotoModel->save();
            }
        }


        return Redirect::route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'descricao' => 'required|max:255',
            'cor' => 'required|max:20',
            'codigo' => 'required|max:30',
            'fornecedores_id' => 'required',
            'tipos_id' => 'required',
            'valor_sugerido' => 'required',
        ]);

        $produto->update($request->except(['fotos']));

        $fotos = $request->file("fotos");

        if($request->hasFile('fotos')) {
            foreach ($fotos as $foto) {
                $fotoModel = new Foto();
                $path = "produtos/" . Carbon::now()->format("m-Y");
                $name = time().'.'.$foto->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/' . $path);
                $foto->move($destinationPath, $name);
                $fotoModel->caminho = $path . '/' . $name;
                $fotoModel->produtos_id = $produto->id;
                $fotoModel->save();
            }
        }

        return Redirect::route('produto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
