<?php

namespace Modulos\Seguranca\Database\Seeds;

use Illuminate\Database\Seeder;
use Modulos\Seguranca\Models\MenuItem;
use Modulos\Seguranca\Models\Modulo;
use Modulos\Seguranca\Models\Perfil;
use Modulos\Seguranca\Models\Permissao;

class SegurancaSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersSeeder::class);

        // Criar o modulo Seguranca
        $modulo = Modulo::create([
            'nome' => 'Segurança',
            'slug' => 'seguranca',
            'icone' => 'fa fa-lock',
            'classes' => 'bg-green'
        ]);

        // Cria perfil de Administrador
        $perfil = Perfil::create([
            'modulos_id' => $modulo->id,
            'nome' => 'Administrador'
        ]);

        $arrPermissoes = [];

        // Criar permissao index do modulo Seguranca
        $permissao = Permissao::create([
            'nome' => 'index',
            'rota' => 'seguranca.index.index'
        ]);

        $arrPermissoes[] = $permissao->id;

        $permissao = Permissao::create([
            'nome' => 'index',
            'rota' => 'seguranca.modulos.index'
        ]);

        $arrPermissoes[] = $permissao->id;

        $permissao = Permissao::create([
            'nome' => 'index',
            'rota' => 'seguranca.itens.index'
        ]);

        $arrPermissoes[] = $permissao->id;

        $permissao = Permissao::create([
            'nome' => 'index',
            'rota' => 'seguranca.perfis.index'
        ]);

        $arrPermissoes[] = $permissao->id;

        // Criando itens no menu

        // Categoria Dashboard
        $dashboard = MenuItem::create([
            'modulos_id' => $modulo->id,
            'nome' => 'Dashboard',
            'icone' => 'fa fa-dashboard',
            'visivel' => 1,
            'ordem' => 1
        ]);

        $homeItem = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $dashboard->id,
            'nome' => 'Inicio',
            'icone' => 'fa fa-home',
            'rota' => 'seguranca.index.index',
            'visivel' => 1
        ]);

        // Categoria Cadastros
        $cadastro = MenuItem::create([
            'modulos_id' => $modulo->id,
            'nome' => 'Cadastros',
            'icone' => 'fa fa-plus',
            'visivel' => 1,
            'ordem' => 2
        ]);

        $moduloItem = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $cadastro->id,
            'nome' => 'Modulos',
            'icone' => 'fa fa-cubes',
            'rota' => 'seguranca.modulos.index',
            'visivel' => 1,
            'ordem' => 1
        ]);

        $perfis = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $cadastro->id,
            'nome' => 'Modulos',
            'icone' => 'fa fa-cubes',
            'rota' => 'seguranca.perfis.index',
            'visivel' => 1,
            'ordem' => 1
        ]);

        // Subcategoria Menu
        $menu = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $cadastro->id,
            'nome' => 'Menu',
            'icone' => 'fa fa-bars',
            'visivel' => 1,
            'ordem' => 2
        ]);

        // Nó da subcategoria
        $item = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $menu->id,
            'nome' => 'Itens',
            'icone' => 'fa fa-asterisk',
            'rota' => 'seguranca.itens.index',
            'visivel' => 1,
            'ordem' => 1
        ]);

        // Atribuir permissao index ao perfil de Administrador
        $perfil->permissoes()->attach($arrPermissoes);

        // Atribuir perfil de Administrador ao usuario criado
        $perfil->users()->attach(1);

        $arrPermissoes = [];

        // Criar o modulo Aluno
        $modulo = Modulo::create([
            'nome' => 'Alunos',
            'slug' => 'alunos',
            'icone' => 'fa fa-lock',
            'classes' => 'bg-blue'
        ]);

        // Cria perfil de Administrador
        $perfil = Perfil::create([
            'modulos_id' => $modulo->id,
            'nome' => 'Administrador Alunos'
        ]);


        // Criar permissao index do modulo Aluno
        $permissao = Permissao::create([
            'nome' => 'index',
            'rota' => 'alunos.index.index'
        ]);

        $arrPermissoes[] = $permissao->id;

        // Criando itens no menu

        // Categoria Dashboard
        $dashboard = MenuItem::create([
            'modulos_id' => $modulo->id,
            'nome' => 'Dashboard',
            'icone' => 'fa fa-dashboard',
            'visivel' => 1,
            'ordem' => 1
        ]);

        $homeItem = MenuItem::create([
            'modulos_id' => $modulo->id,
            'menu_itens_pai' => $dashboard->id,
            'nome' => 'Inicio',
            'icone' => 'fa fa-home',
            'rota' => 'alunos.index.index',
            'visivel' => 1
        ]);


        // Atirbuir permissao index ao perfil de Administrador
        $perfil->permissoes()->attach($arrPermissoes);

        // Atribuir perfil de Administrador ao usuario criado
        $perfil->users()->attach(1);
    }
}
