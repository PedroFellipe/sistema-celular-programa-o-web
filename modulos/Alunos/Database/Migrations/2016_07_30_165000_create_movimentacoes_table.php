<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentacoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->increments('mov_id');
            $table->integer('mov_alu_id')->unsigned();
            $table->double('mov_valor');
            $table->enum('mov_tipo', ['debito','credito']);
            $table->date('mov_data');
            $table->timestamps();

            $table->foreign('mov_alu_id')->references('alu_id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movimentacoes');
    }
}
