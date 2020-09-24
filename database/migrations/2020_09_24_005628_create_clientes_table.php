<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 60);
            $table->string("email", 120);
            $table->string("telefone", 12)->nullable();
            $table->string("tamanho", 3)->nullable();
            $table->string("cidade", 80)->nullable();
            $table->string("cep", 10)->nullable();
            $table->string("uf", 2)->nullable();
            $table->string("endereco")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
