<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->increments('sol_id');
            $table->integer('sol_alu_id')->unsigned();
            $table->double('sol_valor');
            $table->enum('sol_status', ['processando','aceito', 'recusado']);
            $table->date('sol_data_solicitacao');
            $table->date('sol_data_finalizacao')->nullable();
            $table->timestamps();

            $table->foreign('sol_alu_id')->references('alu_id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solicitacoes');
    }
}
