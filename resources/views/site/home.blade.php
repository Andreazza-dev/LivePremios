@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    Seja bem vindo a primeira versão do nosso servidor de homologação!<br>
                    Fique a vontate para realisar quaisquer tipos de testes!

                    @guest
                    <div class="d-flex justify-content-center mt-5">
                        <a href="/twitch" class="btn btn-twitch">Login com Twitch</a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
