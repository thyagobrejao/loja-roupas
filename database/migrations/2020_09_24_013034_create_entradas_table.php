<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("quantidade")->unsigned();
            $table->string('tamanho', 3);
            $table->float("valor", 8,2);
            $table->tinyInteger("status")->unsigned()->comment("1-foi levada para troca
                                                                                2-veio na troca de outra
                                                                                3-devolução de compra de cliente
                                                                                4-Reserva cadastrada");
            $table->bigInteger("nota_fiscals_id")->unsigned();
            $table->bigInteger("produtos_id")->unsigned();
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
        Schema::dropIfExists('entradas');
    }
}
