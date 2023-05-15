@extends('layouts.admin')
@section('content')
<style>
.card {
    flex-direction: row;
}

.card img {
    width: 30%;
}

.list-group {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: stretch;
}
</style>

<div class="card-header bg-dark col-md-8 mx-auto">
    {{ trans('cruds.job.fields.about') }}
</div>


<form action="{{ route("admin.jobs.update", [$job->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card col-md-8 mx-auto" style="background-color:#F2F2F2; ">
        <div class="nav flex-column nav-pills py-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" href="#Zlecenie" data-toggle="tab">Zlecenia</a>
            <a class="nav-link" href="#Uwagi" data-toggle="tab">Uwagi</a>
            <a class="nav-link" href="#Historia" data-toggle="tab">Historia</a>

        </div>
        <div class="card-body col-md-12 mx-auto">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fk_company" style="margin-top:1%;">{{ trans('cruds.job.fields.company') }}
                    </label>
                    <select name="fk_company" id="fk_company" class="form-control select2" required>
                        @foreach($companies as $company)
                        <option value="{{ $company->kontrahent_id }}" @if($company->kontrahent_id == $job->fk_company)
                            selected="selected" @endif>{{ $company -> kontrahent_kod }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="fk_user" style="margin-top:1%;">Odpowiedzialny</label>
                    <select id="fk_user" name="fk_user" class="form-control select2 ">
                        @foreach($user_all as $users)
                        <option value="{{ $users ->id }}" @if($users ->id == $job->fk_user)
                            selected="selected" @endif>{{ $users->name }} {{ $users->surname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="button" class="btn btn-dark float-left btn-floating add col-md-2 resultbody"
                value="{{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}">
            <input class="btn btn-success float-right col-md-2" type="submit" value="{{ trans('global.save') }}">
            <a href="{{ route('admin.jobs.show', $job->id) }}">
                <input class="btn btn-info col-md-2  float-right" type="button"
                    value="{{ trans('global.datatables.print') }}"></a>
        </div>
    </div>


    <div class="tab-content col-md-8 mx-auto" style="background-color:#F2F2F2; ">
        <div class="active tab-pane" id="Zlecenie">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                @foreach($jobs as $job)
                <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="job-{{ $job->id }}-tab" data-toggle="pill"
                        href="#job-{{ $job->id }}" role="tab" aria-controls="job-{{ $job->id }}"
                        aria-selected="@if($loop->first) true @else false @endif">{{ trans('cruds.job.title_singular') }}
                        {{ $loop->iteration }}</a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content " id="pills-tabContent" style="background-color:#F2F2F2; ">
                @foreach($jobs as $job)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="job-{{ $job->id }}" role="tabpanel"
                    aria-labelledby="job-{{ $job->id }}-tab">
                    <div class="card-body">
                        <div class="form-row ">
                            <input name="id_opis[]" hidden class="form-control"
                                value="{{ old('id', isset($job) ? $job->id : '') }}">
                            <div class="form-group col-md-4">
                                <label for="start_date">{{ trans('cruds.job.fields.startdate') }}</label>
                                <input type='date' id="start_date" name="start_date[]"
                                    value="{{ old('start_date', isset($job) ? $job->start_date : '') }}"
                                    class="form-control input-group-addon" />
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_date">{{ trans('cruds.job.fields.enddate') }}</label>
                                <input type='date' id="end_date[]" name="end_date[]"
                                    value="{{ old('end_date', isset($job) ? $job->end_date : '') }}"
                                    class="form-control input-group-addon" />
                                @if($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rns">{{ trans('cruds.job.fields.rns') }}</label>
                                <input type="number" id="rns" name="rns[]" class="form-control"
                                    value="{{ old('rns', isset($job) ? $job->rns : '') }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                                <input type="time" id="start" name="start[]" class="form-control"
                                    value="{{ old('start', isset($job) ? $job->start : '') }}"
                                    placeholder="Select time">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                                <input type="time" id="end" name="end[]" class="form-control"
                                    value="{{ old('end', isset($job) ? $job->end : '') }}" placeholder="Select time">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="paid">{{ trans('cruds.job.fields.paid') }}</label>
                                <select id="paid" name="paid[]" class="form-control select2">
                                    @if($job->paid==1)
                                    <option value="{{$job->paid}}">{{ trans('global.free') }}</option>
                                    @else
                                    <option value="{{$job->paid}}">{{ trans('global.paid') }}</option>
                                    @endif
                                    <option value="1">{{ trans('global.free') }}</option>
                                    <option value="2">{{ trans('global.paid') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fk_tasktype">{{ trans('cruds.job.fields.task') }}</label>
                                <select name="fk_tasktype[]" id="fk_tasktype" class="form-control " autocomplete="off" required>

                                    @foreach($TaskType as $id => $TaskTypes)
                                    <option value="{{ $TaskTypes->id }}"  @if($TaskTypes->id == $job->fk_tasktype)
                                        selected="selected" @endif>{{ $TaskTypes->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php
                            $type_task_id=$job->fk_tasktype;  
                            $list = DB::select( DB::raw("SELECT type_task.id, type_task.name FROM task_type_type_task INNER JOIN type_task 
                            ON task_type_type_task.type_task_id = type_task.id WHERE task_type_id = '$type_task_id'") ); 
                            ?>

                            <div class="form-group col-md-6">
                                <label for="fk_typetask">
                                    {{ trans('cruds.job.fields.task_name') }}</label>
                                <select name="fk_typetask[]" id="fk_typetask" class="form-control " autocomplete="off" required>
                                    @foreach($list as $lists)
                                    <option value="{{ $lists->id }}" @if($lists->id ==
                                        $job->fk_typetask) selected="selected" @endif>{{ $lists->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                                <textarea class="form-control" name="description[]"  id="description[]"
                                    rows="3">{{$job->description}}</textarea>
                            </div>
                        </div>
                        <div>
                        @can('job_delete')
                    <a class="btn btn-xs col-md-1 float-right  btn-danger" href="{{ url('/job_delete', $job->id) }}"
                        onclick="return confirm('{{ trans('global.areYouSure') }}');">
                        Usuń
                    </a>
                    @endcan
                </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="pills-towary" role="tabpanel" aria-labelledby="pills-towary-tab">
                <div class="resultbody"> </div>
            </div>


</form>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="Uwagi">
@if(!empty($job->comments))
    
    <td>{{$job->comments}}</td>
    @else
    <td> Brak Uwag</td>
    @endif
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="Historia">

    @if($Notification->isNotEmpty())
    @foreach($Notification as $Notifications)
    <td>Użytkownik {{$Notifications->NotificationUser->name}} {{$Notifications->NotificationUser->surname}}
        modyfikował rekord {{$Notifications->date}}
    </td>
    <hr>
    @endforeach
    @else
    <td> Dawno dawno temu....</td>
    @endif
</div>
<!-- /.tab-pane -->
</div>
@endsection

@section('scripts')

@parent
 <script type="text/javascript">
      $(".date").datepicker({
        format: "yyyy-mm-dd",
      });
    </script>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreJobRequest') !!}
<script type='text/javascript'>
$(document).on('change', '#fk_tasktype', function() {
  // Department id
  var id = $(this).val();
  var SITEURL = "{{ url('/') }}";

  // Empty the dropdown
  $(this).closest('.form-row').find('#fk_typetask').empty();

  // AJAX request 
  $.ajax({
       // url: SITEURL + '/getTask/' + id,
    url: SITEURL + '/getTask/' + id,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {
          var id = response['data'][i].id;
          var name = response['data'][i].name;
          var option = "<option value='" + id + "'>" + name + "</option>";
          $(this).closest('.form-row').find("#fk_typetask").append(option);
        }

        // Remove selected value from localStorage
        localStorage.removeItem('selectedTaskType');
        localStorage.removeItem('selectedTask');
      }
    }.bind(this)
  });
});
</script>

<script>
    $(document).ready(function() {
        $('.add').click(function() {
            var form = 
            '<div class="card-body">'+
                '<div class="form-row ">'+
                    '<div class="form-group col-md-4">'+
                        '<label for="start_date">{{ trans('cruds.job.fields.startdate') }}</label>'+
                        '<input type="date" id="start_date[]" name="start_date_new[]" class="form-control input-group-addon" value="{{ date("Y-m-d") }}" />'+
                        '</span>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="end_date">{{ trans('cruds.job.fields.enddate') }}</label>'+
                        '<input type="date" id="end_date[]" name="end_date_new[]" class="form-control input-group-addon" value="{{ date("Y-m-d") }}" />'+
                        '@if($errors->has("end_date"))'+
                        '<span class="text-danger">{{ $errors->first("end_date") }}</span>'+
                        '@endif'+
                        '</span>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="rns">{{ trans('cruds.job.fields.rns') }}</label>'+
                        '<input type="number" name="rns_new[]" class="form-control">'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>'+
                        '<input type="time" id="start[]" name="start_new[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>'+
                        '<input type="time" id="end[]" name="end_new[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="paid">{{ trans('cruds.job.fields.paid') }}</label>'+
                        '<select id="paid" name="paid_new[]" class="form-control ">'+
                            '<option value="1">{{ trans('global.free') }}</option>'+
                            '<option value="2">{{ trans('global.paid') }}</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                    '<div class="form-row">'+
                        '<div class="form-group col-md-6">'+
                            '<label for="fk_tasktype">{{ trans('cruds.job.fields.task') }}</label>'+
                            '<select name="fk_tasktype_new[]" id="fk_tasktype" class="form-control" required>'+
                               '@foreach($TaskType as $TaskTypes)'+
                                    '<option value="{{ $TaskTypes->id }}">{{ $TaskTypes->name }}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<div class="form-group col-md-6">'+
                            '<label for="fk_typetask">{{ trans('cruds.job.fields.task_name') }}</label>'+
                            '<select id="fk_typetask" name="fk_typetask_new[]" class="form-control" required>'+
                            '@foreach($list as $lists)'+
                                '<option value="{{ $lists->id }}" >{{ $lists->name }}'+
                                '</option>'+
                            '@endforeach'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '<div class="form-row">'+
                    '<div class="form-group col-md-12">'+
                        '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
                        '<textarea class="form-control" name="description_new[]" id="description_new[]" required rows="3"></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>';
            var title = 'Nowe Zlecenie';
            var tabId = 'tab-' + new Date().getTime();
            
            // dodanie zakładki do listy
            $('.nav-tabs').append('<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#' + tabId + '">' + title + ' <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></a></li>');
            
            // dodanie formularza do nowej zakładki
            $('.tab-content').append('<div class="tab-pane fade" id="' + tabId + '">' + form + '</div>');
            
            // ukrycie pustych zakładek
            $('.tab-pane:empty').each(function() {
                $(this).closest('.nav-item').hide();
            });
             // przejście do nowej zakładki
             $('.nav-item:last-child a').tab('show');
        });
        
        // obsługa kliknięcia przycisku anulowania
        $(document).on('click', '.close', function() {
            var tabId = $(this).closest('a').attr('href');
            $(this).closest('li').remove();
            $(tabId).remove();
        });
       

        $(document).on('click', '.close', function() {
            $('#job-{{ $job->id }}-tab').tab('show');
        });

    });
</script>

@endsection