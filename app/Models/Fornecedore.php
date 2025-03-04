<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedore extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Produto() {
        return $this->hasMany("App\Models\Produto", "fornecedores_id");
    }
}
