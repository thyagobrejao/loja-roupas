<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Produto() {
        return $this->hasOne("App\Models\Produto", "produtos_id");
    }

    public function Venda() {
        return $this->hasOne("App\Models\Venda", "venda_id");
    }
}
