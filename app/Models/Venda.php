<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Cliente() {
        return $this->belongsTo("App\Models\Cliente", "clientes_id");
    }

    public function Vendedora() {
        return $this->belongsTo("App\Models\Vendedora", "vendedoras_id");
    }

    public function FormaPagamento() {
        return $this->belongsTo("App\Models\FormaPagamento", "formas_pagamentos_id");
    }

    public function Saida() {
        return $this->hasMany("App\Models\Saida", "vendas_id");
    }
}
