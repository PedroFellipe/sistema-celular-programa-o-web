<?php

namespace Modulos\Alunos\Models;

use Carbon\Carbon;
use Modulos\Core\Model\BaseModel;

class Pessoa extends BaseModel
{
    protected $table = 'alunos';

    protected $primaryKey = 'alu_id';

    protected $fillable = [
        'alu_nome',
        'alu_sexo',
        'alu_email',
        'alu_telefone',
        'alu_nascimento',
        'alu_mae',
        'alu_pai',
        'alu_estado_civil',
        'alu_naturalidade',
        'alu_nacionalidade',
        'alu_raca',
        'alu_necessidade_especial',
        'alu_estrangeiro',
        'alu_cidade',
        'alu_bairro',
        'alu_estado',
        'alu_cep',
        'alu_numero',
        'alu_endereco',
        'alu_complemento'
    ];

    // protected $searchable = [
    //     'alu_nome' => 'like',
    //     'alu_email' => '=',
    //     'alu_cpf' => '='
    // ];

    public function movimentacoes()
    {
        return $this->hasMany('Modulos\Alunos\Models\Movimentacoes', 'mov_alu_id');
    }

    public function solicitacoes()
    {
      return $this->hasMany('Modulos\Alunos\Models\Solicitacoes', 'tin_alu_id');
    }
}
