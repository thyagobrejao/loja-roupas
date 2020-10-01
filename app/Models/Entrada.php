<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    public function NotaFiscal() {
        return $this->belongsTo("App\Models\NotaFiscal", "nota_fiscals_id");
    }

    public function Produto() {
        return $this->belongsTo("App\Models\Produto", "produtos_id");
    }

}
