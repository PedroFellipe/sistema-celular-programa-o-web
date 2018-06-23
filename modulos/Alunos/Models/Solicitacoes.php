<?php

namespace Modulos\Alunos\Models;

use Carbon\Carbon;
use Modulos\Core\Model\BaseModel;

class Solicitacoes extends BaseModel
{
    protected $table = 'solicitacoes';

    protected $primaryKey = 'sol_id';

    protected $fillable = [
        'sol_alu_id',
        'sol_valor',
        'sol_status',
        'sol_data_solicitacao',
        'sol_data_finalizacao'
    ];

    public function aluno()
    {
        return $this->belongsTo('Modulos\Alunos\Models\Alunos', 'sol_alu_id');
    }


}
