<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $appends = ['estoque', 'entradas', 'saidas', 'reservas'];

    public function Entrada()
    {
        return $this->hasMany("App\Models\Entrada", "produtos_id");
    }

    public function Foto()
    {
        return $this->hasMany("App\Models\Foto", "produtos_id");
    }

    public function Saida()
    {
        return $this->hasMany("App\Models\Saida", "produtos_id");
    }

    public function Fornecedore()
    {
        return $this->belongsTo("App\Models\Fornecedore", "fornecedores_id");
    }

    public function TipoProduto()
    {
        return $this->belongsTo("App\Models\TipoProduto", "tipos_id");
    }

    public function getEntradasAttribute()
    {
        $entradas = $this->Entrada()->get();
        $total = 0;
        foreach ($entradas as $entrada) {
            $total += $entrada->quantidade;
        }
        return $total;
    }

    public function getSaidasAttribute()
    {
        $saidas = $this->Saida()->get();
        $total = 0;
        foreach ($saidas as $saida) {
            $total += $saida->quantidade;
        }
        return $total;
    }

    public function getEstoqueAttribute()
    {
        return $this->entradas - $this->saidas;
    }

    public function getReservasAttribute()
    {
        return $this->Saida()->where("reserva", true)->count();
    }
}
