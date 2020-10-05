<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'estoque',
        'entradas',
        'saidas',
        'reservas',
        'tamanhos'
    ];

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
        $reservas = $this->Saida()->where("reserva", true)->get();

        $tamanhos = [];

        foreach ($reservas as $reserva) {
            if (!array_key_exists($reserva->tamanho, $tamanhos)) {
                $tamanhos[$reserva->tamanho] = 0;
            }
            $tamanhos[$reserva->tamanho] += $reserva->quantidade;
        }

        return $tamanhos;
    }

    public function getTamanhosAttribute()
    {
        $entradas = $this->Entrada()->get();
        $saidas = $this->Saida()->get();

        $tamanhos = [];

        foreach ($entradas as $entrada) {
            if (!array_key_exists($entrada->tamanho, $tamanhos)) {
                $tamanhos[$entrada->tamanho] = 0;
            }
            $tamanhos[$entrada->tamanho] += $entrada->quantidade;
        }

        foreach ($saidas as $saida) {
            if (!array_key_exists($saida->tamanho, $tamanhos)) {
                $tamanhos[$saida->tamanho] = 0;
            }
            $tamanhos[$saida->tamanho] -= $saida->quantidade;
        }

        return $tamanhos;
    }
}
