@extends('layouts.seguranca')

@section('title')
    Módulo de Monitoramento
@stop

@section('subtitle')
    Módulo de Monitoramento
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>R$ {{  number_format($creditos, 2, ',', '.') }}</h3>
                        <p>Quantidade de Crédito carteira</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
