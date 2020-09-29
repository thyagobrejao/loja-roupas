<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedora extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Venda() {
        return $this->belongsTo("App\Models\Venda", "vendedoras_id");
    }
}
