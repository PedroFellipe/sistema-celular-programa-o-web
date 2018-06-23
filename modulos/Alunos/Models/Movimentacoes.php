<?php

namespace Modulos\Alunos\Models;

use Carbon\Carbon;
use Modulos\Core\Model\BaseModel;

class Movimentacoes extends BaseModel
{
    protected $table = 'movimentacoes';

    protected $primaryKey = 'mov_id';

    protected $fillable = [
        'mov_alu_id',
        'mov_valor',
        'mov_tipo',
        'mov_data_solicitacao',
        'mov_data_finalizacao'
    ];

    public function aluno()
    {
        return $this->belongsTo('Modulos\Alunos\Models\Alunos', 'sol_alu_id');
    }


}
