@extends('permissions.base')
@section('permission_content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Lista de Grupos</span>

                    <div class="col">
                        {{-- <a href="" class="btn btn-success pull-right btn-sm">Novo
                            Grupo</a> --}}
                    </div>

                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="row addremove-multiselect">
                            <div class="col-lg-5 col-sm-5 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Inativos</div>
                                    <div class="panel-body">
                                        <select name="inativos[]" id="available-select" class="multiselect available form-control"
                                            size="8" multiple="multiple">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="multiselect-controls col-lg-2 col-sm-2 col-xs-12">
                                <button type="button" id="rightall" class="rightall btn btn-block"><i
                                        class="fe fe-chevrons-right"></i></button>
                                <button type="button" id="right" class="right btn btn-block"><i
                                        class="fe fe-arrow-right"></i></button>
                                <button type="button" id="left" class="left btn btn-block"><i
                                        class="fe fe-arrow-left"></i></button>
                                <button type="button" id="leftall" class="leftall btn btn-block"><i
                                        class="fe fe-chevrons-left"></i></button>
                            </div>

                            <div class="col-lg-5 col-sm-5 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Ativos</div>
                                    <div class="panel-body">
                                        <select name="ativos[]" id="selected-select" class="multiselect selected form-control" size="8"
                                            multiple="multiple">
                                            @foreach ($membros as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success pull-right" id="save">Savar</button>
                                <a href="{{route('permissions.group.list')}}"
                                    class="btn btn-link pull-left">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('permission_scripts')
<script>
$(function () {

$('#save').click(function() {
    $('#available-select option').prop('selected', true);
    $('#selected-select option').prop('selected', true);
    $('form').submit();
});

  function moveItems(origin, dest) {
      $(origin).find(':selected').appendTo(dest);
      $(dest).find(':selected').removeAttr("selected");
      $(dest).sort_select_box();
  }

  function moveAllItems(origin, dest) {
      $(origin).children("option:visible").appendTo(dest);
      $(dest).find(':selected').removeAttr("selected");
      $(dest).sort_select_box();
  }

  $('.left').on('click', function () {
      var container = $(this).closest('.addremove-multiselect');
      moveItems($(container).find('select.multiselect.selected'), $(container).find('select.multiselect.available'));
  });

  $('.right').on('click', function () {
      var container = $(this).closest('.addremove-multiselect');
      moveItems($(container).find('select.multiselect.available'), $(container).find('select.multiselect.selected'));
  });

  $('.leftall').on('click', function () {
      var container = $(this).closest('.addremove-multiselect');
      moveAllItems($(container).find('select.multiselect.selected'), $(container).find('select.multiselect.available'));
  });

  $('.rightall').on('click', function () {
      var container = $(this).closest('.addremove-multiselect');
      moveAllItems($(container).find('select.multiselect.available'), $(container).find('select.multiselect.selected'));
  });

  $('select.multiselect.selected').on('dblclick keyup',function(e){
      if(e.which == 13 || e.type == 'dblclick') {
        var container = $(this).closest('.addremove-multiselect');
        moveItems($(container).find('select.multiselect.selected'), $(container).find('select.multiselect.available'));
      }
  });

  $('select.multiselect.available').on('dblclick keyup',function(e){
      if(e.which == 13 || e.type == 'dblclick') {
          var container = $(this).closest('.addremove-multiselect');
          moveItems($(container).find('select.multiselect.available'), $(container).find('select.multiselect.selected'));
      }
  });


});

$.fn.sort_select_box = function(){
  // Get options from select box
  var my_options =$(this).children('option');
  // sort alphabetically
  my_options.sort(function(a,b) {
      if (a.text > b.text) return 1;
      else if (a.text < b.text) return -1;
      else return 0
  })
 //replace with sorted my_options;
 $(this).empty().append( my_options );

 // clearing any selections
 $("#"+this.attr('id')+" option").attr('selected', false);
}
</script>
@endsection
