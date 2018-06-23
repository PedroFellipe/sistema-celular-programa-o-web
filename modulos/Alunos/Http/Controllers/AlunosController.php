<?php

namespace Modulos\Alunos\Http\Controllers;

use App\Http\Controllers\Controller;
use Modulos\Alunos\Repositories\AlunosRepository;

class AlunosController extends Controller
{

  public function __construct(AlunosRepository $alunosRepository)
    {
        $this->alunosRepository = $alunosRepository;

    }

    public function index()
    {
      $creditos = $this->alunosRepository->getCreditos();
      // dd($creditos);

        return view('Alunos::index.index', [
            'creditos' => $creditos
        ]);
    }
}
