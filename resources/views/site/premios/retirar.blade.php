@extends('layouts.app')
<script src="{{asset('plugins/axios/axios.min.js')}}"></script>
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
                            @foreach ($dados as $dado)
                            <tr>
                                <td><span class="text-muted"></span></td>
                                <td><a href="#" class="text-inherit">Ebook Casa do Código</a></td>
                                <td>
                                    {{$dado['name']}}
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
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-twitch btn-sm" data-toggle="modal" data-target="#exampleModalCenter" data-premio="{{$dado['premio_id']}}" onclick="openModal(this)">Pegar Prêmio</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Confirme a retirada do seu prêmio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="dimmer active" id="modal_loader">
                <div class="loader"></div>
                <div class="dimmer-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
                </div>
                <p style="text-align:center"> Carregando... Aguarde. </p>
            </div>

          <div id="email_confirm_box">
              <label for="token_code">Digite o seu email abaixo, para confirmarmos a sua identidade!</label>
              <input type="email" name="email" class="form-control form-control-lg" style="text-align:center" id="email_verify">
          </div>

          <input type="text" name="codigo_retirada" id="codigo_retirada" class="form-control form-control-lg" style="text-align:center" readonly>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-twitch" id="SubmitConfirmEmail">Confirmar Recebimento</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#modal_loader').show();
            $('#codigo_retirada').hide();
            $('#SubmitConfirmEmail').hide();
            $('#email_confirm_box').hide();
        });
        var pid;
        function openModal(element){
            $('#modal_loader').show();
            $('#codigo_retirada').hide();
            $('#SubmitConfirmEmail').hide();
            $('#email_confirm_box').hide();

            pid = element.dataset.premio;
            axios.post('/premio-status', {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                premio_id: pid,
            })
            .then(function (response) {
                if(response.data.msg == 'confirmar_email'){
                    $('#modal_loader').hide();
                    $('#SubmitConfirmEmail').show();
                    $('#email_confirm_box').show();
                }
                if(response.data.msg == 'premio_codigo'){
                    $('#modal_loader').hide();
                    $('#codigo_retirada').val(response.data.codigo).show();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }

        $('#SubmitConfirmEmail').on('click', function(){
            $('#SubmitConfirmEmail').hide();
            $('#email_confirm_box').hide();
            $('#modal_loader').show();

            axios.post('/confirmar-email', {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                email:  $('#email_verify').val(),
                premio_id: pid
            })
            .then(function (response) {
                if(response.data.status == 'erro'){
                    $('#modal_loader').hide();
                    $('#SubmitConfirmEmail').show();
                    $('#email_confirm_box').show()
                    $('#email_verify').addClass('is-invalid');
                }
                if(response.data.status == 'OK'){
                    $('#modal_loader').hide();
                    $('#codigo_retirada').val(response.data.codigo).show();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
