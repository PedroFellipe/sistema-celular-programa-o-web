<?php

namespace Modulos\Seguranca\Repositories;

use DB;
use Modulos\Seguranca\Models\Perfil;
use Modulos\Core\Repository\BaseRepository;

class PerfilRepository extends BaseRepository
{
    public function __construct(Perfil $perfil)
    {
        parent::__construct($perfil);
    }

    public function getPerfilModulo($perfil)
    {
        $permissoes = DB::table('permissoes')
            ->where('rota', 'like', $perfil->modulo->slug . '%')->get();

        $arrayRecursos = [];
        $arrayRecursosPermissoes = [];

        foreach ($permissoes as $key => $permissao) {
            $habilitado = DB::table('permissoes_has_perfis')
                ->where('perfis_id', '=', $perfil->id)
                ->where('permissoes_id', '=', $permissao->id)
                ->get();

            if ($habilitado->isEmpty()) {
                $habilitado = 0;
            } else {
                $habilitado = 1;
            }

            $separa = explode('.', $permissao->rota);
            $conta = count($separa);
            $arrayPermissoes = [
                'prm_id' => $permissao->id,
                'prm_nome' => $permissao->nome,
                'habilitado' => $habilitado
            ];

            $arrayRecursosPermissoes[$key]['rcs_nome'] = $separa[$conta - 2];
            $arrayRecursosPermissoes[$key]['permissao'] = $arrayPermissoes;

            if (!in_array($separa[$conta - 2], $arrayRecursos)) {
                $arrayRecursos[] = $separa[$conta - 2];
            }
        }

        $retornoperfis = [];

        foreach ($arrayRecursos as $key => $arrayRecurso) {
            $retornoperfis[$key]['rcs_id'] = 0;
            $retornoperfis[$key]['rcs_nome'] = $arrayRecurso;
            $retornoperfis[$key]['permissoes'] = 'arraydepermissoes';
        }

        $arraypermissoes = [];
        foreach ($retornoperfis as $keyA => $novo) {
            foreach ($arrayRecursosPermissoes as $keyB => $arrayRecurso) {
                $stringA = $arrayRecurso['rcs_nome'];
                $stringB = $novo['rcs_nome'];

                if ($stringA == $stringB) {
                    $arraypermissoes[] = $arrayRecurso['permissao'];
                }
            }
            $retornoperfis[$keyA]['permissoes'] = $arraypermissoes;
            $arraypermissoes = [];
        }

        return $retornoperfis;
    }


    public function sincronizarPermissoes($perfilId, array $permissoes)
    {

        return $this->model->find($perfilId)->permissoes()->sync($permissoes);
    }

}
