<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    public function Venda() {
        return $this->belongsTo("App\Models\Venda", "formas_pagamentos_id");
    }
}
