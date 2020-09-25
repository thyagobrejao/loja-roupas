<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function Venda() {
        return $this->belongsTo("App\Models\Venda", "clientes_id");
    }
}
