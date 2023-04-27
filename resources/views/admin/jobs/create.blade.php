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


<form action="{{ url('/job/store/add/new') }}" method="post">
    @csrf
    <div class="card col-md-8 mx-auto" style="background-color:#F2F2F2; ">
        <!-- <ul class="list-group">
            <li class="list-group-item" style="background-color:#F2F2F2; "><input type="button"
                    class="btn btn-dark float-left btn-floating add col-md-12 resultbody"
                    value="{{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}"></li>
            <li class="list-group-item" style="background-color:#F2F2F2; "><input
                    class="btn btn-success float-right col-md-12" type="submit" value="{{ trans('global.save') }}"></li>
        </ul> -->
        <div class="card-body col-md-12 mx-auto">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fk_company">{{ trans('cruds.job.fields.company') }}
                    </label>
                    <select name="fk_company" id="fk_company" class="form-control select2" required>
                        <option value=""></option>
                        @foreach($companies as $company)
                        <option value="{{ $company->kontrahent_id }}">{{ $company -> kontrahent_kod }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="fk_user">{{ trans('cruds.job.fields.performed_singular') }}</label>
                    <select id="fk_user" name="fk_user" class="form-control ">
                        <option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}
                        </option>
                        @foreach($user_all as $users)
                        <option value="{{ $users->id }}">{{ $users->name }} {{ $users->surname }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="button" class="btn btn-dark float-left btn-floating add col-md-2 resultbody"
                    value="{{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}">
            <input class="btn btn-success float-right col-md-2" type="submit" value="{{ trans('global.save') }}">
            
        </div>
    </div>



    <ul class="nav nav-tabs col-md-8 mx-auto" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">{{ trans('cruds.job.title_singular') }} </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" id="pills-towary-tab" data-toggle="pill" href="#pills-towary" role="tab"
                aria-controls="pills-towary" aria-selected="false">Zadanie 2</a>
        </li> -->

    </ul>

    <div class="tab-content col-md-8 mx-auto" id="pills-tabContent" style="background-color:#F2F2F2; ">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" >
            <div class="card-body" >
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label for="start_date">{{ trans('cruds.job.fields.startdate') }}</label>
                        <input type='date' id="start_date[]" name="start_date[]" required class="form-control input-group-addon"
                            value="{{ date("Y-m-d") }}" />
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_date">{{ trans('cruds.job.fields.enddate') }}</label>
                        <input type='date' id="end_date[]" name="end_date[]" required class="form-control input-group-addon"
                            value="{{ date("Y-m-d") }}" />
                        @if($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                        @endif
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rns">{{ trans('cruds.job.fields.rns') }}</label>
                        <input type="number" name="rns[]" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                        <input type="time" id="start[]" name="start[]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                        <input type="time" id="end[]" name="end[]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="paid">{{ trans('cruds.job.fields.paid') }}</label>
                        <select id="paid" name="paid[]" class="form-control " required>
                            <option value="1">{{ trans('global.free') }}</option>
                            <option value="2">{{ trans('global.paid') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fk_tasktype">{{ trans('cruds.job.fields.task') }}</label>
                        <select name="fk_tasktype[]" id="fk_tasktype" class="form-control " autocomplete="off" required>
                            @foreach($TaskType as $TaskTypes)
                            <option value='{{ $TaskTypes->id }}'>{{ $TaskTypes->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fk_typetask">
                            {{ trans('cruds.job.fields.task_name') }}</label>
                        <select id='fk_typetask' name='fk_typetask[]' class="form-control " autocomplete="off" required>
                                @foreach($list as $lists)
                                <option value="{{ $lists->type_task_id }}" >{{ $lists->TaskId->name }}
                                </option>
                                @endforeach  
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                        <textarea class="form-control" name="description[]" id="comments[]" rows="3" required></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-towary" role="tabpanel" aria-labelledby="pills-towary-tab">
            <div class="resultbody"> </div>
        </div>


</form>

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

  // Empty the dropdown
  $(this).closest('.form-row').find('#fk_typetask').find('option').remove();

  // AJAX request 
  $.ajax({
    url: '/jobmanager/public/getTask/' + id,
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

        // Store selected value in localStorage
        localStorage.setItem('selectedTaskType', id);
        var selectedTask = $(this).closest('.form-row').find('#fk_typetask').val();
        localStorage.setItem('selectedTask', selectedTask);
      }
    }.bind(this)
  });
});

// // Get stored values from localStorage and set them as selected
// $(document).ready(function() {
//   var selectedTaskType = localStorage.getItem('selectedTaskType');
//   var selectedTask = localStorage.getItem('selectedTask');
//   $('#fk_tasktype').val(selectedTask).trigger('change');
// });
</script>




<script>
    $(document).ready(function() {
        $('.add').click(function() {
            var form = 
            '<div class="card-body">'+
                '<div class="form-row ">'+
                    '<div class="form-group col-md-4">'+
                        '<label for="start_date">{{ trans('cruds.job.fields.startdate') }}</label>'+
                        '<input type="date" id="start_date[]" name="start_date[]" class="form-control input-group-addon" required value="{{ date("Y-m-d") }}" />'+
                        '</span>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="end_date">{{ trans('cruds.job.fields.enddate') }}</label>'+
                        '<input type="date" id="end_date[]" name="end_date[]" class="form-control input-group-addon" required value="{{ date("Y-m-d") }}" />'+
                        '@if($errors->has("end_date"))'+
                        '<span class="text-danger">{{ $errors->first("end_date") }}</span>'+
                        '@endif'+
                        '</span>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="rns">{{ trans('cruds.job.fields.rns') }}</label>'+
                        '<input type="number" name="rns[]" class="form-control">'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>'+
                        '<input type="time" id="start[]" name="start[]" class="form-control" required>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>'+
                        '<input type="time" id="end[]" name="end[]" class="form-control" required>'+
                    '</div>'+
                    '<div class="form-group col-md-4">'+
                        '<label for="paid">{{ trans('cruds.job.fields.paid') }}</label>'+
                        '<select id="paid" name="paid[]" class="form-control " required>'+
                            '<option value="1">{{ trans('global.free') }}</option>'+
                            '<option value="2">{{ trans('global.paid') }}</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                    '<div class="form-row">'+
                        '<div class="form-group col-md-6">'+
                            '<label for="fk_tasktype">{{ trans('cruds.job.fields.task') }}</label>'+
                            '<select name="fk_tasktype[]" id="fk_tasktype" class="form-control" required>'+
                               '@foreach($TaskType as $TaskTypes)'+
                                    '<option value="{{ $TaskTypes->id }}">{{ $TaskTypes->name }}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<div class="form-group col-md-6">'+
                            '<label for="fk_typetask">{{ trans('cruds.job.fields.task_name') }}</label>'+
                            '<select id="fk_typetask" name="fk_typetask[]" class="form-control" required>'+
                            '@foreach($list as $lists)'+
                                '<option value="{{ $lists->type_task_id }}" >{{ $lists->TaskId->name }}'+
                                '</option>'+
                            '@endforeach'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                '<div class="form-row">'+
                    '<div class="form-group col-md-12">'+
                        '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
                        '<textarea class="form-control" name="description[]" id="comments[]" rows="3" required></textarea>'+
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
            $('#pills-home-tab').tab('show');
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $('form').validate();
</script>


@endsection