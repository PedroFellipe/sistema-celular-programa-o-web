<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('alu_id');
            $table->string('alu_nome', 150);
            $table->enum('alu_sexo', ['M', 'F']);
            $table->string('alu_email', 150)->unique();
            $table->string('alu_telefone', 20);
            $table->date('alu_nascimento');
            $table->string('alu_mae', 150);
            $table->string('alu_pai', 150)->nullable();
            $table->enum('alu_estado_civil', [
                'solteiro',
                'casado',
                'divorciado',
                'viuvo(a)',
                'uniao_estavel',
                'outros'
            ])->nullable();
            $table->string('alu_naturalidade', 45)->nullable();
            $table->string('alu_nacionalidade', 45)->nullable();
            $table->string('alu_raca', 45)->nullable();
            $table->string('alu_necessidade_especial', 150)->nullable();
            $table->boolean('alu_estrangeiro')->default(0);
            $table->string('alu_endereco');
            $table->string('alu_numero', 45);
            $table->string('alu_complemento', 150)->nullable();
            $table->string('alu_cep', 10);
            $table->string('alu_cidade', 150);
            $table->string('alu_bairro', 150);
            $table->char('alu_estado', 2);
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
        Schema::drop('alunos');
    }
}
