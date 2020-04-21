@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{route('store.codigos')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                Cadastrar códigos
                <div class="col">
                    <a href="{{route('cadastrar.codigos.csv')}}" class="btn btn-success pull-right btn-sm">Importar Via Lista</a>
                </div>
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
                            <tr>
                                <td><input name="array[0][codigo]" type="text" class="form-control"
                                        placeholder="Insira o código do ebook"></td>
                                <td style="aling-rigth"></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <input type="button" class="mt-3 btn btn-sm btn-outline-success ml-5" id="addrow"
                    value="Adicionar mais um código" />
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right">Salvar</button>
                <a href="/dashboard/rewards" class="btn btn-secondary pull-left">Cancelar</a>
            </div>
        </div>
    </form>
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
        cols += '<td style="aling-rigth"><a class="icon ibtnDel" href="#" value="Delete"> <i class="fe fe-trash" style="color: #cd201f"></i> </a></td>';
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
