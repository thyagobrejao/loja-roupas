<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    public function Cliente() {
        return $this->hasOne("App\Models\Cliente", "clientes_id");
    }

    public function Vendedora() {
        return $this->hasOne("App\Models\Vendedora", "vendedoras_id");
    }

    public function FormaPagamento() {
        return $this->hasOne("App\Models\FormaPagamento", "formas_pagamentos_id");
    }

    public function Saida() {
        return $this->belongsTo("App\Models\Saida", "vendas_id");
    }
}
