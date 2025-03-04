<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ["data"];

    public function Entrada() {
        return $this->belongsTo("App\Models\Entrada", "nota_fiscals_id");
    }
}
