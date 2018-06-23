<?php

namespace Modulos\Seguranca\Http\Controllers;



use Modulos\Seguranca\Providers\ActionButton\Facades\ActionButton;
use Modulos\Seguranca\Providers\ActionButton\TButton;
use Modulos\Core\Http\Controller\BaseController;
use Illuminate\Http\Request;
use Modulos\Seguranca\Repositories\ModulosRepository;
use Modulos\Seguranca\Repositories\PerfilRepository;
use Flash;

class PerfisController extends BaseController
{
    protected $perfilRepository;
    protected $moduloRepository;

    public function __construct(PerfilRepository $perfilRepository, ModulosRepository $moduloRepository)
    {
        $this->perfilRepository = $perfilRepository;
        $this->moduloRepository = $moduloRepository;
    }

    public function index(Request $request)
    {
        $btnNovo = new TButton();
        $btnNovo->setName('Novo')->setRoute('seguranca.perfis.create')->setIcon('fa fa-plus')->setStyle('btn bg-olive');

        $actionButtons[] = $btnNovo;

        $paginacao = null;
        $tabela = null;

        $tableData = $this->perfilRepository->paginateRequest($request->all());

        if ($tableData->count()) {
            $tabela = $tableData->columns(array(
                'id' => '#',
                'nome' => 'Perfil',
                'descricao' => 'Descrição',
                'modulos_id' => 'Módulo',
                'prf_action' => 'Ações'
            ))
            ->modify('prf_mod_id', function ($obj) {
                return $obj->modulo->nome;
            })
            ->modifyCell('prf_action', function () {
                return array('style' => 'width: 140px;');
            })
            ->means('prf_action', 'id')
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

    public function getAtribuirpermissoes($perfilId)
    {
        $perfil = $this->perfilRepository->find($perfilId);

        if (!sizeof($perfil)) {
            flash()->error('Perfil não existe.');
            return redirect()->route('seguranca.perfis.index');
        }

        $permissoes = $this->perfilRepository->getPerfilModulo($perfil);

        return view('Seguranca::perfis.atribuirpermissoes', compact('perfil', 'permissoes'));
    }

    public function postAtribuirpermissoes($id, Request $request)
    {
        try {
            $perfilId = $request->id;

            if ($request->input('permissao') == "") {
                $permissoes = [];
                $this->perfilRepository->sincronizarPermissoes($perfilId, $permissoes);

                Flash::success('Permissões atribuídas com sucesso.');
                return redirect('seguranca/perfis/atribuirpermissoes/'.$perfilId);
            }

            $permissoes = explode(',', $request->input('permissao'));

            $this->perfilRepository->sincronizarPermissoes($perfilId, $permissoes);


              Flash::success('Permissões atribuídas com sucesso.');

            return redirect('seguranca/perfis/atribuirpermissoes/'.$perfilId);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }
            flash()->error('Erro ao tentar salvar. Caso o problema persista, entre em contato com o suporte.');

            return redirect()->back();
        }
    }
}
