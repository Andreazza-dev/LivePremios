@extends('permissions.base')
@section('permission_content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Lista de Regras</span>

                    <div class="col">
                    <a href="{{route('permissions.rules.create')}}" class="btn btn-success pull-right btn-sm">Nova Regra</a>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th width="10%">NO.</th>
                            <th>Regra</th>
                            <th>Descrição</th>
                            <th width="30%">Ações</th>
                        </thead>
                        <tbody>
                            @foreach ($rules as $rule)
                            <tr>
                                <td>{{$rule->id}}</td>
                                <td>{{$rule->name}}</td>
                                <td>{{$rule->description}}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-warning btn-sm">Edit Rule</a>
                                    <a href="{{route('permissions.rules.permissions.edit', $rule->id)}}" class="btn btn-outline-success btn-sm">Permissions</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('permission_scripts')

@endsection
