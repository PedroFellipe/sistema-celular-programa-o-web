<?php

namespace Modulos\Seguranca\Http\Controllers;



use Modulos\Seguranca\Providers\ActionButton\Facades\ActionButton;
use Modulos\Seguranca\Providers\ActionButton\TButton;
use Modulos\Core\Http\Controller\BaseController;
use Illuminate\Http\Request;
use Modulos\Seguranca\Repositories\ModulosRepository;
use Modulos\Seguranca\Repositories\PerfilRepository;

class PerfisController extends BaseController
{
    protected $perfilRepository;
    protected $moduloRepository;

    public function __construct(PerfilRepository $perfilRepository, ModulosRepository $moduloRepository)
    {
        $this->perfilRepository = $perfilRepository;
        $this->moduloRepository = $moduloRepository;
    }

    public function getIndex(Request $request)
    {
        $btnNovo = new TButton();
        $btnNovo->setName('Novo')->setRoute('seguranca.perfis.create')->setIcon('fa fa-plus')->setStyle('btn bg-olive');

        $actionButtons[] = $btnNovo;

        $paginacao = null;
        $tabela = null;

        $tableData = $this->perfilRepository->paginateRequest($request->all());

        if ($tableData->count()) {
            $tabela = $tableData->columns(array(
                'prf_id' => '#',
                'prf_nome' => 'Perfil',
                'prf_descricao' => 'Descrição',
                'prf_mod_id' => 'Módulo',
                'prf_action' => 'Ações'
            ))
            ->modify('prf_mod_id', function ($obj) {
                return $obj->modulo->mod_nome;
            })
            ->modifyCell('prf_action', function () {
                return array('style' => 'width: 140px;');
            })
            ->means('prf_action', 'prf_id')
            ->modify('prf_action', function ($id) {
                return ActionButton::grid([
                    'type' => 'SELECT',
                    'config' => [
                        'classButton' => 'btn-default',
                        'label' => 'Selecione'
                    ],
                    'buttons' => [
                        [
                            'classButton' => 'text-blue',
                            'icon' => 'fa fa-check-square-o',
                            'route' => 'seguranca.perfis.atribuirpermissoes',
                            'parameters' => ['id' => $id],
                            'label' => 'Permissões',
                            'method' => 'get'
                        ],
                        [
                            'classButton' => '',
                            'icon' => 'fa fa-pencil',
                            'route' => 'seguranca.perfis.edit',
                            'parameters' => ['id' => $id],
                            'label' => 'Editar',
                            'method' => 'get'
                        ],
                        [
                            'classButton' => 'btn-delete text-red',
                            'icon' => 'fa fa-trash',
                            'route' =>  'seguranca.perfis.delete',
                            'id' => $id,
                            'label' => 'Excluir',
                            'method' => 'post'
                        ]
                    ]
                ]);
            })
            ->sortable(array('prf_id', 'prf_nome'));
            $paginacao = $tableData->appends($request->except('page'));
        }

        // dd($tabela);

        return view('Seguranca::perfis.index', ['tabela' => $tabela, 'paginacao' => $paginacao, 'actionButton' => $actionButtons]);
    }
}
