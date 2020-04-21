@extends('permissions.base')
@section('permission_content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Lista de Grupos</span>

                    <div class="col">
                    <a href="{{route('permissions.group.create')}}" class="btn btn-success pull-right btn-sm">Novo Grupo</a>
                    </div>

                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="name">Nome do grupo</label>
                        <input type="text" name="name" class="form-control" placeholder="Moderadores">
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success pull-right">Savar</button>
                    <a href="{{route('permissions.group.list')}}" class="btn btn-link pull-left">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('permission_scripts')

@endsection
