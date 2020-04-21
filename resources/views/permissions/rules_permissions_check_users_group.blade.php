@extends('permissions.base')
@section('permission_content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Editar permissões</span>

                    <div class="col">
                    {{-- <a href="{{route('permissions.rules.create')}}" class="btn btn-success pull-right btn-sm">Novo Grupo</a> --}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="tipo" value="individual">
                                <button type="submit" value="individual" class="btn btn-success btn-block btn-lg"> Por Usuário </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="tipo" value="grupo">
                                <button type="submit" value="grupo" class="btn btn-primary btn-block btn-lg"> Por Grupo </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('permission_scripts')

@endsection
