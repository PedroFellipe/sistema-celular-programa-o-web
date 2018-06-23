<?php

namespace Modulos\Alunos\Repositories;

use DB;
use Cache;

class AlunosRepository
{
    public function getCreditos($alunoId = 1)
    {
        $debitos = DB::table('movimentacoes')
            ->where('mov_tipo', '=', 'debito')
            ->where('mov_alu_id', '=', $alunoId)
            ->get();

        $creditos = DB::table('movimentacoes')
            ->where('mov_tipo', '=', 'credito')
            ->where('mov_alu_id', '=', $alunoId)
            ->get();

       $debitoval = 0;
       foreach ($debitos as $key => $debito) {
         $debitoval =+ $debito->mov_valor;
       }


       $creditoval = 0;
       foreach ($creditos as $key => $credito) {
         $creditoval =+ $credito->mov_valor;
       }

       return $creditoval-$debitoval;
    }
}
