<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    use HasFactory;

    public function Produto() {
        return $this->hasMany("App\Models\Produto", "tipos_id");
    }

}
