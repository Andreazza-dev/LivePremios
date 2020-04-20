@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12">
        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success pull-right mb-3">Vincular novo ganhador</button>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>User</th>
                            <th>Status</th>
                            <th class="text-center">Vinculado por</th>
                            <th>Retirado em</th>
                            <th class="text-center">xx</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $dado)
                        <tr>
                            <td class="text-center">
                                <div class="avatar d-block" style="background-image: url('{{$dado['avatar']}}')">
                                </div>
                            </td>
                            <td>
                                <div>{{$dado['name']}}</div>
                                <div class="small text-muted">
                                    Registrado em:
                                    {{$dado['registred']}}
                                </div>
                            </td>
                            <td>
                                @if($dado['status'] == 0)
                                <span class="status-icon bg-green"></span>Disponível

                                @elseif($dado['status'] == 1)
                                <span class="status-icon bg-purple"></span>Aguardando retirada

                                @elseif($dado['status'] == 2)
                                <span class="status-icon bg-gray"></span>Retirado
                                <div class="small text-muted"><strong>{{$dado['retirado_data']}}</strong></div>

                                @elseif($dado['status'] == 3)

                                @endif


                                {{-- <span class="tag tag-rounded tag-purple">Aguardando Retirada</span>
                                <span class="tag tag-rounded tag-orange">Aguardando Moderação</span> --}}
                            </td>
                            <td class="text-center">
                                <a href="#" class="text-purple"><strong>{{$dado['vinculado_por']}}</strong></a>
                                <div>{{$dado['vinculado_data']}}</div>
                            </td>
                            <td>
                                <div class="small text-muted">{{$dado['retirado']}}</div>
                                <div>{{$dado['retirado_data']}}</div>
                            </td>
                            <td class="text-center">
                                <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3"
                                    data-color="blue"><canvas width="40" height="40"></canvas>
                                    <div class="chart-circle-value">42%</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                            class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="javascript:void(0)" class="dropdown-item"><i
                                                class="dropdown-icon fe fe-tag"></i> Action </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i
                                                class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i
                                                class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:void(0)" class="dropdown-item"><i
                                                class="dropdown-icon fe fe-link"></i> Separated link</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Vincular um novo usuário!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <form action="{{route('store.vincular')}}" method="POST">
            <div class="modal-body">
                {{-- <div class="dimmer active" id="modal_loader">
                    <div class="loader"></div>
                    <div class="dimmer-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                    </div>
                    <p style="text-align:center"> Carregando... Aguarde. </p>
                </div> --}}

                @csrf
                <label for="nick">Digite o nick ou URL do canal do ganhador!</label>
                <input type="text" name="nick" class="form-control form-control-lg" style="text-align:center" id="nick">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="submit" class="btn btn-twitch">Confirmar Vínculo</button>
            </div>
        </form>

      </div>
    </div>
  </div>
@endsection
