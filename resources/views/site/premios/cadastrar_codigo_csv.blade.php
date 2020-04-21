@extends('layouts.app')
@section('content')
<div class="container">
    @if(!isset($codigos))
    <form action="{{route('store.codigos.csv')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                Cadastrar códigos via CSV
                <div class="col">
                    <a href="https://imgur.com/a/b5pLdGb" target="_blank" class="btn btn-primary pull-right btn-sm">CSV Exemplo</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('store.codigos.csv')}}" method="POST">
                            @csrf
                            <label for="codigos">Digite os codigos em lista separados por (<span class="text-danger">, ; [Enter]</span>)</label>
                            <textarea name="codigos" id="codigos" cols="30" rows="10" class="form-control" placeholder="CF-10001, CF-10002, CF-10003"></textarea>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right">Salvar</button>
                <a href="{{route('admin.dashboard.premios')}}" class="btn btn-secondary pull-left">Cancelar</a>
            </div>
        </div>
    </form>
    @else
    <form action="{{route('store.codigos')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                Confirme os códigos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table order-list card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 90%">Código</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contagem = 1
                            @endphp
                            @foreach ($codigos as $codigo)
                            <tr>
                                <td><input name="array[{{$contagem}}][codigo]" type="text" class="form-control"
                                        placeholder="Insira o código do ebook" value="{{$codigo}}"></td>
                                <td style="aling-rigth"><a class="icon ibtnDel" href="#" value="Delete"> <i class="fe fe-trash" style="color: #cd201f"></i> </a></td>
                            </tr>
                            @php
                                $contagem = $contagem  + 1
                            @endphp
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <input type="button" class="mt-3 btn btn-sm btn-outline-success ml-5" id="addrow"
                    value="Adicionar mais um código" />
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right">Confirmar</button>
                <a href="/dashboard/rewards" class="btn btn-secondary pull-left">Cancelar</a>
            </div>
        </div>
    </form>
    @endif
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var counter = 1;
        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            var produto = "[produto]";
            var quantidade = "[quantidade]";
            var observacao = "[observacao]";
            cols += '<td><input name="array['+ counter +'][codigo]" type="text" class="form-control" placeholder="Insira o código do ebook"></td>';
            cols += '<td><a class="icon ibtnDel" href="#" value="Delete"> <i class="fe fe-trash" style="color: #cd201f"></i> </a></td>';
            newRow.append(cols);
            $("table.order-list").append(newRow);
            counter++;
        });
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });
    });
</script>
@endsection
