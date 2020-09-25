<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    public function Produto() {
        return $this->belongsTo("App\Models\Produto", "produtos_id");
    }
}
