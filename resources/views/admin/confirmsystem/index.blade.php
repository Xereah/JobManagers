@extends('layouts.admin')
@section('content')
<style>
.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
</style>
<div class="card-header bg-dark col-md-8 mx-auto">
{{ trans('cruds.confirm_system.title') }}
</div>
<form action="{{ route("admin.ConfirmSystem.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card col-md-8 mx-auto">
        <div class="card-horizontal">
            <ul class="list-group">
                <li class="list-group-item"><input type="button"
                        class="btn btn-dark float-left btn-floating add col-md-12 addzadanie_pill" value="{{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}"></li>
                <li class="list-group-item" ><input type="button"
                        class="btn btn-danger float-left btn-floating addtowar addtowar_pill col-md-12" value="{{ trans('global.add') }} {{ trans('cruds.confirm_system.fields.goods') }}"></li>
                <li class="list-group-item"><input type="button"
                        class="btn btn-primary float-left btn-floating addsprzet col-md-12 addsprzet_pill"  value="{{ trans('global.add') }} {{ trans('cruds.rep_eq.title') }}">
                </li>
                <li class="list-group-item"><input class="btn btn-success float-right col-md-12" type="submit"
                        value="{{ trans('global.save') }}"></li>
            </ul>
            <div class="card-body">
                <div class="card ">
                    <div class="container py-2">
                        <div class="row ">
                            <div class="col">
                                <label for="fk_company">{{ trans('cruds.job.fields.company') }}</label>
                                <select name="fk_company" id="fk_company" class="form-control select2" required>
                                    <option value=""></option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company -> shortcode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="car">{{ trans('cruds.cars.title_singular') }}</label>
                                <select name="fk_car" id="fk_car" class="form-control" required>
                                    <option></option>
                                    @foreach($car as $cars)
                                    <option value="{{ $cars->id }}">{{ $cars ->car_mark }} {{ $cars ->car_model }}
                                        {{ $cars ->car_plates }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col"> <label for="default-picker">{{ trans('cruds.cars.fields.out') }}</label>
                                <input type="time" id="start_car" name="start_car" class="form-control"
                                    placeholder="Select time" required>
                            </div>
                            <div class="col"><label for="default-picker">{{ trans('cruds.cars.fields.come') }}</label>
                            <input type="time" id="end_car" name="end_car" class="form-control"
                                placeholder="Select time" required>
                            </div>
                            <div class="w-100"></div>
                            <div class="col"> <label for="paid">{{ trans('cruds.job.fields.paid') }}</label>
                                <select id="paid" name="paid" class="form-control ">
                                    <option value="1">{{ trans('global.free') }}</option>
                                    <option value="2">{{ trans('global.paid') }}</option>
                                </select>
                            </div>
                            <div class="col"> <label for="start_date">{{ trans('cruds.confirm_system.fields.task_date') }}</label>
                                <input type='date' id="start_date" name="start_date"
                                    class="form-control input-group-addon" value="{{ date("Y-m-d") }}" />
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>



    <ul class="nav nav-tabs col-md-8 mx-auto" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active"  id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">{{ trans('cruds.job.title_singular') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-uwagi-tab" data-toggle="pill" href="#pills-uwagi" role="tab"
                aria-controls="pills-uwagi" aria-selected="false">{{ trans('cruds.job.fields.comments') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-towary-tab" data-toggle="pill" href="#pills-towary" role="tab"
                aria-controls="pills-towary" aria-selected="false">{{ trans('cruds.confirm_system.fields.goods') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-equipment-tab" data-toggle="pill" href="#pills-equipment" role="tab"
                aria-controls="pills-equipment" aria-selected="false">{{ trans('cruds.rep_eq.title') }}</a>
        </li>
    </ul>

    <div class="tab-content col-md-8 mx-auto" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1 bg-dark">
                                <p style="text-align:center;">
                                    <span></span><br>
                                    <span></span><br>
                                    <span></span><br>
                                    <span>O</span><br>
                                    <span>P</span><br>
                                    <span>I</span><br>
                                    <span>S</span><br>
                                </p>
                            </div>
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                                        <input type="time" id="start[]" name="start[]" class="form-control"
                                             placeholder="Select time" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                                        <input type="time" id="end[]" name="end[]" class="form-control"
                                            placeholder="Select time" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="fk_typetask">{{ trans('cruds.job.fields.task_name') }}</label>
                                        <select name="fk_typetask[]" id="fk_typetask" class="form-control select2"
                                            required>
                                            @foreach($TypeTask as $TypeTasks)
                                            <option value="{{ $TypeTasks->id }}">{{ $TypeTasks -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="default-picker">{{ trans('cruds.job.fields.performed_singular') }}</label>
                                        <select id="fk_user" name="fk_user" class="form-control select2">
                                            <option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}
                                            </option>
                                            @foreach($user_all as $users)
                                            <option value="{{ $users->id }}">{{ $users->name }} {{ $users->surname }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                                        <textarea class="form-control" name="description[]" id="description" required
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="resultbody "></div>
        </div>


        <div class="tab-pane fade" id="pills-uwagi" role="tabpanel" aria-labelledby="pills-uwagi-tab">
            <div class="card">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1 bg-success">
                                <p style="text-align:center;">
                                    <span></span><br>
                                    <span>U</span><br>
                                    <span>W</span><br>
                                    <span>A</span><br>
                                    <span>G</span><br>
                                    <span>I</span><br>
                                    <span></span><br>
                                </p>
                            </div>
                            <div class="col-md-11">
                                <div class="col-md-11 py-2">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">{{ trans('cruds.job.fields.comments') }}</label>
                                        <textarea class="form-control" name="comments[]" id="comments"
                                            rows="5"></textarea>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>


        <div class="tab-pane fade" id="pills-towary" role="tabpanel" aria-labelledby="pills-towary-tab">
            <!-- <div class="card">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1 bg-danger">
                                <p style="text-align:center;">
                                    <span></span><br>
                                    <span>T</span><br>
                                    <span>0</span><br>
                                    <span>W</span><br>
                                    <span>A</span><br>
                                    <span>R</span><br>
                                    <span>Y</span><br>
                                </p>
                            </div>
                            <div class="col-md-11">
                                <div class="col-md-11 py-2">
                                    <div class="row">
                                        <div>
                                            <label for="description_goods">Pozostawiono towar</label>
                                            <textarea class="form-control" name="description_goods[]"
                                                id="description_goods[]" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="resultbody_towar "></div>
        </div>
        
        <div class="tab-pane fade" id="pills-equipment" role="tabpanel" aria-labelledby="pills-equipment-tab">
            <!-- <div class="card">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-1 bg-primary">
                                <p style="text-align:center;">
                                    <span></span><br>
                                    <span>S</span><br>
                                    <span>P</span><br>
                                    <span>R</span><br>
                                    <span>Z</span><br>
                                    <span>Ę</span><br>
                                    <span>T</span><br>
                                </p>
                            </div>
                            <div class="col-md-11 py-2">
                                <div class="row">
                                    <div>
                                        <label for="description">Pozostawiono sprzęt</label>
                                        <select name="fk_rep_eq[]" id="fk_rep_eq[]" class="form-control select2"
                                            required>
                                            <option value=""></option>
                                            @foreach($repEquipment as $repEquipments)
                                            <option value="{{ $repEquipments->id }}">{{ $repEquipments -> eq_number }}
                                                {{ $repEquipments -> eq_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="description">Opis</label>
                                        <textarea class="form-control" name="description_eq[]" id="description_eq[]"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="resultbody_sprzet "></div>
        </div>

</form>

@endsection
@section('scripts')
<script type='text/javascript'>
$(document).ready(function(){

  // Department Change
  $('#fk_company').change(function(){

     // Department id
     var id = $(this).val();

     // Empty the dropdown
     $('#distance').find('input').not(':first').remove();

     // AJAX request 
     $.ajax({
       url: 'getEmployees/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){

         var len = 0;
         if(response['data'] != null){
            len = response['data'].length;
         }

         if(len > 0){
            // Read data and create <option >
            for(var i=0; i<len; i++){

               var id = response['data'][i].id;
               var distance = response['data'][i].distance;
                              
            
               $("#distance").val(distance); 
            }
         }

       }
     });
  });
});
</script>
<script type="text/javascript">
$(function() {
    $('.add').click(function() {
        var n = ($('.resultbody'));
        var tr =        
        '<div class="card">'+
                '<div>'+
                    '<div class="container">'+
                        '<div class="row">'+
                            '<div class="col-md-1 bg-dark">'+
                                '<p style="text-align:center;">'+
                                    '<span></span><br>'+
                                    '<span></span><br>'+
                                    '<span></span><br>'+
                                    '<span>O</span><br>'+
                                    '<span>P</span><br>'+
                                    '<span>I</span><br>'+
                                    '<span>S</span><br>'+
                                '</p>'+
                            '</div>'+
                            '<div class="col-md-11">'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>'+
                                        '<input type="time" id="start[]" name="start[]" class="form-control">'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>'+
                                        '<input type="time" id="end[]" name="end[]" class="form-control">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<label for="fk_typetask">{{ trans('cruds.job.fields.task_name') }}</label>'+
                                        '<select name="fk_typetask[]" id="fk_typetask" class="form-control select2" required>'+
                                            '@foreach($TypeTask as $TypeTasks)'+
                                            '<option value="{{ $TypeTasks->id }}">{{ $TypeTasks -> name }}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<label for="default-picker">{{ trans('cruds.job.fields.performed_singular') }}</label>'+
                                        '<select id="fk_user" name="fk_user" class="form-control select2">'+
                                            '<option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}'+
                                            '</option>'+
                                            '@foreach($user_all as $users)'+
                                            '<option value="{{ $users->id }}">{{ $users->name }} {{ $users->surname }}'+
                                            '</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
                                        '<textarea class="form-control" name="description[]" id="description" rows="5"></textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<button type="button" style="margin-left:95%;" class="btn btn-dark float-right btn-sm col-md-1 delete">'+
                      '{{ trans('global.cancel') }}</i>'+
                    '</button>'+  
            '</div>';
        $('.resultbody').append(tr);
    });
    $('.resultbody').delegate('.delete', 'click', function() {
        $(this).parent().remove();
    });
});
</script>


<script type="text/javascript">
$(function() {
    $('.addtowar').click(function() {
        var n = ($('.resultbody_towar'));
        var tr =       
        '<div class="card">'+
                '<div>'+
                    '<div class="container">'+
                        '<div class="row">'+
                            '<div class="col-md-1 bg-danger">'+
                                '<p style="text-align:center;">'+
                                    '<span></span><br>'+
                                    '<span>T</span><br>'+
                                    '<span>0</span><br>'+
                                    '<span>W</span><br>'+
                                    '<span>A</span><br>'+
                                    '<span>R</span><br>'+
                                    '<span>Y</span><br>'+
                                '</p>'+
                            '</div>'+
                            '<div class="col-md-11">'+
                                '<div class="col-md-11 py-2">'+
                                    '<div>'+
                                        '<div>'+
                                            '<label for="description_goods">{{ trans('cruds.confirm_system.fields.goods_left') }}</label>'+
                                            '<textarea class="form-control" name="description_goods[]"  id="description_goods[]" rows="3"></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                           '</div>'+
                        '</div>'+
                    '</div>'+
                    '<button type="button" style="margin-left:95%;" class="btn btn-dark float-right btn-sm col-md-1 delete_towar">'+
                    '{{ trans('global.cancel') }}</i>'+
                    '</button>'+  
                '</div>'+
            '</div>'+
        '</div>';
        $('.resultbody_towar').append(tr);
    });
    $('.resultbody_towar').delegate('.delete_towar', 'click', function() {
        $(this).closest('.card').remove();
        //sprawdź czy zakładka ze sprzętem zastępczym jest pusta
        if ($('.resultbody_towar').is(':empty')) {
            //jeśli tak, przejdź do zakładki home
            $('#pills-home-tab').tab('show');
            const equipmentTab = $('#pills-towary-tab');
            // ukryj zakładkę ze sprzętem zastępczym
            equipmentTab.hide();
        }
    });
});

$(document).ready(function() {
  // znajdź przycisk dodawania sprzętu zastępczego
  const addButton = $('.addtowar_pill');
  // znajdź zakładkę ze sprzętem zastępczym
  const equipmentTab = $('#pills-towary-tab');
  // ukryj zakładkę ze sprzętem zastępczym
  equipmentTab.hide();
  
  // dodaj nasłuchiwanie na kliknięcie przycisku
  addButton.click(function() {
    // sprawdź, czy zakładka nie jest pusta
    if($('.resultbody_towar').is(':empty')){
        // jeżeli jest pusta, przejdź do zakładki home
        $('#pills-home-tab').tab('show');
    } else {
        // jeżeli nie jest pusta, pokaż zakładkę ze sprzętem zastępczym i aktywuj ją
        equipmentTab.show();
        equipmentTab.tab('show');
    }
  });
});
</script>

<script type="text/javascript">
$(function() {
    $('.addsprzet').click(function() {
        var n = ($('.resultbody_sprzet'));
        var tr =       
        '<div class="card">'+
                '<div>'+
                    '<div class="container">'+
                        '<div class="row">'+
                            '<div class="col-md-1 bg-primary">'+
                                '<p style="text-align:center;">'+
                                    '<span></span><br>'+
                                    '<span>S</span><br>'+
                                    '<span>P</span><br>'+
                                    '<span>R</span><br>'+
                                    '<span>Z</span><br>'+
                                    '<span>Ę</span><br>'+
                                    '<span>T</span><br>'+
                                '</p>'+
                            '</div>'+
                            '<div class="col-md-11 py-2">'+
                                '<div >'+
                                    '<div>'+
                                        '<label for="description">{{ trans('cruds.confirm_system.fields.rep_eq_left') }}</label>'+
                                        '<select name="fk_rep_eq[]" id="fk_rep_eq[]" class="form-control select2"required>'+
                                            '<option value=""></option>'+
                                            '@foreach($repEquipment as $repEquipments)'+
                                            '<option value="{{ $repEquipments->id }}">{{ $repEquipments -> eq_number }}'+
                                                '{{ $repEquipments -> eq_name }}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                    '<div>'+
                                        '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
                                        '<textarea class="form-control" name="description_eq[]" id="description_eq[]" rows="3"></textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<button type="button" style="margin-left:95%;" class="btn btn-dark float-right btn-sm col-md-1 delete3">'+
                    '{{ trans('global.cancel') }}</i>'+
                    '</button>'+  
                '</div>'+
            '</div>';
        $('.resultbody_sprzet').append(tr);
    });
    $('.resultbody_sprzet').delegate('.delete3', 'click', function() {
        $(this).closest('.card').remove();
        //sprawdź czy zakładka ze sprzętem zastępczym jest pusta
        if ($('.resultbody_sprzet').is(':empty')) {
            //jeśli tak, przejdź do zakładki home
            $('#pills-home-tab').tab('show');
            const equipmentTab = $('#pills-equipment-tab');
            // ukryj zakładkę ze sprzętem zastępczym
            equipmentTab.hide();
        }
    });
});

$(document).ready(function() {
  // znajdź przycisk dodawania sprzętu zastępczego
  const addButton = $('.addsprzet_pill');
  // znajdź zakładkę ze sprzętem zastępczym
  const equipmentTab = $('#pills-equipment-tab');
  // ukryj zakładkę ze sprzętem zastępczym
  equipmentTab.hide();
  
  // dodaj nasłuchiwanie na kliknięcie przycisku
  addButton.click(function() {
    // sprawdź, czy zakładka nie jest pusta
    if($('.resultbody_sprzet').is(':empty')){
        // jeżeli jest pusta, przejdź do zakładki home
        $('#pills-home-tab').tab('show');
    } else {
        // jeżeli nie jest pusta, pokaż zakładkę ze sprzętem zastępczym i aktywuj ją
        equipmentTab.show();
        equipmentTab.tab('show');
    }
  });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreConfirmSystem') !!}

<script>
$('.addtowar_pill').click(function(){
    $('#myTab a[href="#pills-towary"]').tab('show');
});
</script>

<script>
$('.addzadanie_pill').click(function(){
    $('#myTab a[href="#pills-home"]').tab('show');
});
</script>

<script>
$('.addsprzet_pill').click(function(){
    $('#myTab a[href="#pills-equipment"]').tab('show');
});
</script>

<script>
    document.getElementById('end_car').addEventListener('change', function (e) {
        document.getElementById('start[]').value = e.target.value;
    });
</script>

@endsection
