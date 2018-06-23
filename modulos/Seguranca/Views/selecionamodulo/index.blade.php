@extends('layouts.clean')

@section('title')
    Selecione o Módulo
@stop

@section('content')
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row-fluid">
                                <div class="row">
                                    @if($modulos->count())
                                        @foreach($modulos as $modulo)
                                            <div class="col-lg-12 col-xs-12">
                                                <div class="small-box {{$modulo->classes}}">
                                                    <div class="inner">
                                                        <h3 style="margin-bottom:0px;font-weight:200;">{{$modulo->nome}}</h3>
                                                        <p>{{$modulo->descricao}}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="{{$modulo->icone}}"></i>
                                                    </div>
                                                    <a href="{{ route($modulo->slug.'.index.index') }}" style="padding-top:15px;padding-bottom:15px" class="small-box-footer">
                                                        Acessar <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h3 style="color:#c3c3c3;padding-top:170px;margin-top:0px" class="text-center">
                                            Nenhum módulo disponível para seu usuário
                                        </h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="box box-default">
                        <div class="box-body" style="min-height:702px">
                            <ul class="timeline">
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>

                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Bem Vindo =)</a></h3>

                                        <div class="timeline-body">
                                            Para começar, selecione o módulo que deseja utilizar ao lado
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header no-border"><a href="#">Consulta de saldo</a> na nossa plataforma você pode visualizar seu saldo atualizado a qualquer momento :)</h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Facilidade e comodidade</a> </h3>
                                        <div class="timeline-body">
                                            Em nossa plataforma, você não precisa mais enfrentar fila para colocar créditos em sua carteira :D
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-book bg-purple"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Manuais</a> disponíveis para download</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
