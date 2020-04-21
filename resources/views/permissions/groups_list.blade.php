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
                    <table class="table">
                        <thead>
                            <th width="10%">NO.</th>
                            <th>Grupo</th>
                            <th width="30%">Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr>
                                <td>{{$group->id}}</td>
                                <td>{{$group->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-warning btn-sm">Edit Group</a>
                                    <a href="{{route('permissions.group.members.edit', $group->id)}}" class="btn btn-outline-success btn-sm">Permissions</a>
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
