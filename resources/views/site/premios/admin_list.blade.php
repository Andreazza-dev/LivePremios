@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Prêmios</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Prêmio</th>
                                <th>Usuário / ID</th>
                                <th>Status</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="text-muted"></span></td>
                                <td><a href="invoice.html" class="text-inherit">Ebook Casa do Código</a></td>
                                <td>
                                    DSHYTV (12322544)
                                </td>

                                <td>
                                    <span class="status-icon bg-success"></span> Recebido<br>
                                    <span class="status-icon bg-warning"></span> Aguardando Retirada<br>
                                    <span class="status-icon bg-gray"></span> Cancelado<br>
                                    <span class="status-icon bg-orange"></span> Aguarde Liberação<br>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0)" class="btn btn-twitch btn-sm">Pegar Prêmio</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
