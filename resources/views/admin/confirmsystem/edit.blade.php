@extends('layouts.admin')
@section('content')
<style>
.card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
</style>
<div class="card-header bg-dark col-md-8 mx-auto">
    System Potwierdzeń
</div>
<form action="{{ route("admin.ConfirmSystem.update", [$job->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card col-md-8 mx-auto">
        <div class="card-horizontal">
            <ul class="list-group py-3">
                <li class="list-group-item"><input type="button"
                        class="btn btn-dark float-left btn-floating add col-md-12 addzadanie_pill"
                        value="Dodaj zadanie"></li>
                <li class="list-group-item"><input type="button"
                        class="btn btn-danger float-left btn-floating addtowar col-md-12 addtowar_pill"
                        value="Dodaj towary"></li>
                <li class="list-group-item"><input type="button"
                        class="btn btn-primary float-left btn-floating addsprzet col-md-12 addsprzet_pill"
                        value="Dodaj sprzęt zastępczy">
                </li>
                <li class="list-group-item"><input class="btn btn-success float-right col-md-12 " type="submit"
                        value="{{ trans('global.update') }}">
                </li>
            </ul>
            <div class="card-body">
                <div class="card ">
                    <div class="container py-2">
                        <div class="row ">
                            <div class="col">
                                <label for="fk_company">{{ trans('cruds.job.fields.company') }}</label>
                                <select name="fk_company" id="fk_company" class="form-control select2" required>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($company->id == $job->fk_company)
                                        selected="selected" @endif>{{ $company -> shortcode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="car">Samochód</label>
                                <select name="fk_car" id="fk_car" class="form-control select2" required>
                                    @foreach($car as $cars)
                                    <option value="{{ $cars->id }}" @if($cars->id == $job->fk_car)
                                        selected="selected" @endif>{{ $cars ->car_mark }} {{ $cars ->car_model }}
                                        {{ $cars ->car_plates }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col"> <label for="default-picker">Wyjazd</label>
                                <input type="time" id="start_car" name="start_car"
                                    value="{{ old('start_car', isset($job) ? $job->start_car : '') }}"
                                    class="form-control">
                            </div>
                            <div class="col"><label for="default-picker">Przyjazd</label>
                                <input type="time" id="end_car" name="end_car"
                                    value="{{ old('end_car', isset($job) ? $job->end_car : '') }}" class="form-control">
                            </div>
                            <div class="w-100"></div>
                            <div class="col"> <label for="paid">{{ trans('cruds.job.fields.paid') }}</label>
                                <select id="paid" name="paid" class="form-control select2">
                                    @if($job->paid==1)
                                    <option value="{{$job->paid}}">{{ trans('global.free') }}</option>
                                    @else
                                    <option value="{{$job->paid}}">{{ trans('global.paid') }}</option>
                                    @endif
                                    <option value="1">{{ trans('global.free') }}</option>
                                    <option value="2">{{ trans('global.paid') }}</option>

                                </select>
                            </div>
                            <div class="col"> <label for="start_date">Data usługi</label>
                                <input type='date' id="start_date" name="start_date"
                                    class="form-control input-group-addon"
                                    value="{{ old('start_date', isset($job) ? $job->start_date : '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end py-2">
            <!-- <input class="btn bg-danger float-right" href="{{ url('/SendMail') }}" type="submit" value="Wyślij"> -->

            <a href="{{ url('/SendMail', [$job->id]) }}">
                <input class="btn bg-success  float-right" onclick="return confirm('{{ trans('global.areYouSure') }}');"
                    type="button" value="Wyślij Mail"></a>

            <a href="{{ route('admin.ConfirmSystem.show', $job->id) }}">
                <input class="btn bg-success  float-right" type="button" value="{{ trans('global.datatables.print') }}">

            </a>
        </div>

    </div>
    <!-- Opis -->
    <ul class="nav nav-tabs col-md-8 mx-auto" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Zadanie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-uwagi-tab" data-toggle="pill" href="#pills-uwagi" role="tab"
                aria-controls="pills-uwagi" aria-selected="false">Uwagi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-towary-tab" data-toggle="pill" href="#pills-towary" role="tab"
                aria-controls="pills-towary" aria-selected="false">Towary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-equipment-tab" data-toggle="pill" href="#pills-equipment" role="tab"
                aria-controls="pills-equipment" aria-selected="false">Sprzęt zastępczy</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="pills-equipment_loan-tab" data-toggle="pill" href="#pills-equipment_loan" role="tab"
                aria-controls="pills-equipment_loan" aria-selected="false">Sprzęt zastępczy u klienta</a>
        </li>

    </ul>

    <div class="tab-content col-md-8 mx-auto" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            @foreach($jobs as $id => $job)
            <div class="card">
                <div>
                    <div class="container py-2">
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
                                        <input name="id_opis[]" hidden class="form-control"
                                            value="{{ old('id', isset($job) ? $job->id : '') }}">
                                        <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                                        <input type="time" id="start" name="start[]" class="form-control"
                                            value="{{ old('start', isset($job) ? $job->start : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                                        <input type="time" id="end" name="end[]" class="form-control"
                                            value="{{ old('end', isset($job) ? $job->end : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="fk_typetask">{{ trans('cruds.job.fields.task_name') }}</label>
                                        <select name="fk_typetask[]" id="fk_typetask" class="form-control select2"
                                            required>
                                            @foreach($TypeTask as $TypeTasks)
                                            <option value="{{ $TypeTasks->id }}" @if($TypeTasks->id ==
                                                $job->fk_typetask) selected="selected" @endif>{{ $TypeTasks->name }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="default-picker">Wykonujący</label>
                                        <select id="fk_user" name="fk_user" class="form-control select2 ">
                                            @foreach($user_all as $users)
                                            <option value="{{ $users ->id }}" @if($users ->id == $job->fk_user)
                                                selected="selected" @endif>{{ $users->name }} {{ $users->surname }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                                        <textarea class="form-control" name="description[]" id="comments"
                                            rows="5">{{$job->description}}</textarea>

                                    </div>
                                   
                                    <div class="col-md-12">
                                        <input name="order" hidden class="form-control" value="{{ $job->order }}">
                                    </div>
                                    <div class="col-md-12">
                                        <input name="user_order" hidden class="form-control"
                                            value="{{ $job->fk_user }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @can('job_delete')
                    <a class="btn btn-xs col-md-1 float-right  btn-danger" href="{{ url('/eq_delete', $job->id) }}"
                        onclick="return confirm('{{ trans('global.areYouSure') }}');">
                        Usuń
                    </a>
                    @endcan
                </div>
            </div>
            @endforeach
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
                                            <label for="description">Uwagi do wizyty</label>
                                            <textarea class="form-control" name="comments[]" id="comments"
                                                rows="3">{{$job->comments}}</textarea>
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
            @foreach($jobs_towary as $id => $jobs_towarys)
            <div class="card mx-auto">
                <div>
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-md-1 bg-danger">
                                <p style="text-align:center;">
                                    <span></span><br>
                                    <span>T</span><br>
                                    <span>O</span><br>
                                    <span>W</span><br>
                                    <span>A</span><br>
                                    <span>R</span><br>
                                    <span>Y</span><br>
                                </p>
                            </div>

                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="default-picker">Pozostawiono towar</label>
                                        <input name="id_towar[]" hidden class="form-control"
                                            value="{{ old('id', isset($jobs_towarys) ? $jobs_towarys->id : '') }}">
                                        <textarea class="form-control" name="description_goods[]"
                                            id="description_goods[]"
                                            rows="3">{{$jobs_towarys->description_goods}}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @can('job_delete')
                    <a class="btn btn-xs col-md-1 float-right  btn-danger"
                        href="{{ url('/eq_delete', $jobs_towarys->id) }}"
                        onclick="return confirm('{{ trans('global.areYouSure') }}');">
                        Usuń
                    </a>
                    @endcan
                </div>
            </div>
            @endforeach
            <div class="resultbody_towar"></div>
        </div>

        <div class="tab-pane fade" id="pills-equipment" role="tabpanel" aria-labelledby="pills-equipment-tab">
            @foreach($jobs_sprzetzast as $id => $jobs_sprzetzasts)
            <div class="card mx-auto">

                <div>
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-md-1 bg-info">
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
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">Pozostawiono sprzęt</label>
                                        <input name="id_sprzet[]" id="id_sprzet[]" hidden class="form-control"
                                            value="{{ old('id', isset($jobs_sprzetzasts) ? $jobs_sprzetzasts->id : '') }}">
                                        <select name="fk_rep_eq[]" id="fk_rep_eq[]" required disabled
                                            class="form-control select2" required>

                                            @foreach($repEquipment as $repEquipments)

                                            <option value="{{ $repEquipments->id }}" disabled @if($repEquipments->id ==
                                                $jobs_sprzetzasts->fk_rep_eq)
                                                selected="selected" @endif>{{ $repEquipments -> eq_number }}
                                                {{ $repEquipments -> eq_name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="description">Opis</label>
                                        <textarea required class="form-control" required disabled
                                            name="description_eq[]" id="description_eq[]"
                                            rows="3">{{$jobs_sprzetzasts->description_eq}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @can('job_delete')
                    <a class="btn btn-xs col-md-1 float-right  btn-danger"
                        href="{{ url('/is_loan_delete', $jobs_sprzetzasts->id) }}"
                        onclick="return confirm('{{ trans('global.areYouSure') }}');">
                        Usuń
                    </a>
                    @endcan
                </div>
            </div>
            @endforeach
            <div class="resultbody_sprzet "></div>
        </div>



        <div class="tab-pane fade" id="pills-equipment_loan" role="tabpanel" aria-labelledby="pills-equipment_loan-tab">
            <table class=" table table-bordered table-hover datatable" id="example">
                <thead>
                    <tr>

                        <th>
                            Numer
                        </th>
                        <th>
                            Kategoria
                        </th>
                        <th>
                            Nazwa urządzenia
                        </th>
                        <th>
                            Data montażu u klienta
                        </th>
                        <th>
                            Uwagi
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repEquipment_loan as $key => $RepEquipments)
                    <tr data-entry-id="{{ $RepEquipments->id }}">
                        <td>
                            {{$RepEquipments->eq_number}}
                        </td>
                        <td>
                            {{$RepEquipments->EqCategory->category_name}}
                        </td>
                        <td>
                            {{$RepEquipments->eq_name}}
                        </td>

                        <td>
                            {{$RepEquipments->entry_date}}
                        </td>
                        <td>
                            {{$RepEquipments->comments}}
                        </td>
                        <td>


                            @can('equipment_edit')
                            <a class="btn btn-xs col-md-12  btn-success"
                                href="{{ url('/is_loan', $RepEquipments->id) }}"
                                onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                Zwrot
                            </a>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                                        '<label for="default-picker">Wykonujący</label>'+
                                        '<select id="fk_user" name="fk_user[]" class="form-control select2">'+
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
                                        '<textarea class="form-control" name="description[]" id="description" rows="3"></textarea>'+
                                    '</div>'+
                                    '<div class="col-md-12">'+
                                        '<label for="description">Uwagi</label>'+
                                        '<textarea class="form-control" name="comments[]" id="comments" rows="3"></textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<button type="button" style="margin-left:90%;" class="btn btn-dark float-right btn-sm col-md-1 delete">'+
                      'Anuluj</i>'+
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
                                    '<div class="row">'+
                                        '<div>'+
                                            '<label for="description_goods">Pozostawiono towar</label>'+
                                            '<textarea class="form-control" name="description_goods[]"  id="description_goods[]" rows="3"></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                           '</div>'+
                        '</div>'+
                    '</div>'+
                    '<button type="button" style="margin-left:95%;" class="btn btn-dark float-right btn-sm col-md-1 delete_towar">'+
                      'Anuluj</i>'+
                    '</button>'+  
                '</div>'+
            '</div>'+
        '</div>';
        $('.resultbody_towar').append(tr);
    });
    $('.resultbody_towar').delegate('.delete_towar', 'click', function() {
        $(this).closest('.card').remove();
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
                                '<div class="row">'+
                                    '<div>'+
                                        '<label for="description">Pozostawiono sprzęt</label>'+
                                        '<select name="fk_rep_eq[]" id="fk_rep_eq[]" class="form-control select2"required>'+
                                            '<option value=""></option>'+
                                            '@foreach($repEquipment_loan_add as $repEquipments)'+
                                            '<option value="{{ $repEquipments->id }}">{{ $repEquipments -> eq_number }}'+
                                                '{{ $repEquipments -> eq_name }}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                    '<div>'+
                                        '<label for="description">Opis</label>'+
                                        '<textarea class="form-control" name="description_eq[]" id="description_eq[]" rows="3"></textarea>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<button type="button" style="margin-left:95%;" class="btn btn-dark float-right btn-sm col-md-1 delete3">'+
                     'Anuluj</i>'+
                    '</button>'+  
                '</div>'+
            '</div>';
        $('.resultbody_sprzet').append(tr);
    });
    $('.resultbody_sprzet').delegate('.delete3', 'click', function() {
        $(this).closest('.card').remove();
    });
});
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
        $(document).ready(function(){
            var tab_init = sessionStorage.getItem('activeTab');
            if (tab_init) {
                $('#myTab a[href="' + tab_init + '"]').tab('show');
            } else {
                $('#myTab a[class="nav-link active"]').tab('show');
            }
            $('#myTab a').on('shown.bs.tab', function(e){
                sessionStorage.setItem('activeTab', $(e.target).attr('href'));
            });
        });
    </script>

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


@endsection