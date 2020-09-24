<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeinsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->foreign('vendedoras_id')->references('id')->on('vendedoras');
            $table->foreign('formas_pagamentos_id')->references('id')->on('forma_pagamentos');
        });

        Schema::table('saidas', function (Blueprint $table) {
            $table->foreign('produtos_id')->references('id')->on('produtos');
            $table->foreign('vendas_id')->references('id')->on('vendas');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->foreign('fornecedores_id')->references('id')->on('fornecedores');
            $table->foreign('tipos_id')->references('id')->on('tipo_produtos');
        });

        Schema::table('entradas', function (Blueprint $table) {
            $table->foreign('nota_fiscals_id')->references('id')->on('nota_fiscals');
            $table->foreign('produtos_id')->references('id')->on('produtos');
        });

        Schema::table('fotos', function (Blueprint $table) {
            $table->foreign('produtos_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
}
