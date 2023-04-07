<!DOCTYPE html>
<html>

<head>
    <script src="{{ asset('js/main.js') }}"></script>

</head>

<body>
    <div class="">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#Zlecenie" data-toggle="tab">Zlecasdaenie</a></li>
            <li class="nav-item"><a class="nav-link" href="#Uwagi" data-toggle="tab">Uwagi</a></li>
            <li class="nav-item"><a class="nav-link" href="#Historia" data-toggle="tab">Historia</a></li>
        </ul>
    </div><!-- /.card-header -->

    <div class="tab-content">
        <div class="active tab-pane" id="Zlecenie">


            <form action="{{ route("admin.jobs.update", [$job->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ABOUT -->
                <div class="card">
                    <h5 class="card-header bg-dark">{{ trans('cruds.job.fields.about') }}

                    </h5>

                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="fk_company" style="margin-top:1%;">{{ trans('cruds.job.fields.company') }}
                            </label>
                            <select name="fk_company" id="fk_company" class="form-control select2" required>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($company->id == $job->fk_company)
                                    selected="selected" @endif>{{ $company -> shortcode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="rns" style="margin-top:1%;">Miejsce wykonania</label>
                            <select name="location" id="myText" class="form-control select2" required>
                                <option value="{{$job->location}}">

                                    {{$job->new_location->name}}

                                </option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company -> name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="fk_tasktype" style="margin-top:1%;">{{ trans('cruds.job.fields.task') }}
                                Type</label>
                            <select name="fk_tasktype" id="fk_tasktype" class="form-control select2" required>

                                @foreach($TaskType as $id => $TaskTypes)
                                <option value="{{ $TaskTypes->id }}" @if($TaskTypes->id == $job->fk_tasktype)
                                    selected="selected" @endif>{{ $TaskTypes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="paid" style="margin-top:1%;">{{ trans('cruds.job.fields.paid') }}</label>
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

                    </div>


                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="fk_user" style="margin-top:1%;">Odpowiedzialny</label>
                            <select id="fk_user" name="fk_user" class="form-control select2 ">
                                @foreach($user_all as $users)
                                <option value="{{ $users ->id }}" @if($users ->id == $job->fk_user)
                                    selected="selected" @endif>{{ $users->name }} {{ $users->surname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="rns" style="margin-top:1%;">RNS</label>
                            <input type="number" id="rns" name="rns" class="form-control"
                                value="{{ old('rns', isset($job) ? $job->rns : '') }}" required>
                        </div>
                    </div>

                </div>

                <!-- Description -->
                
                <div class="card ">
                    <h5 class="card-header bg-dark"> {{ $job->type_task->name }}

                    </h5>
                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="start_date"
                                style="margin-top:1%;">{{ trans('cruds.job.fields.startdate') }}</label>

                            <input type='date' id="start_date" name="start_date[]"
                                value="{{ old('start_date', isset($job) ? $job->start_date : '') }}"
                                class="form-control input-group-addon" />
                            </span>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_date" style="margin-top:1%;">{{ trans('cruds.job.fields.enddate') }}</label>

                            <input type='date' id="end_date" name="end_date[]"
                                value="{{ old('end_date', isset($job) ? $job->end_date : '') }}"
                                class="form-control input-group-addon" />
                            </span>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                            <input type="time" id="start" name="start[]" class="form-control"
                                value="{{ old('start', isset($job) ? $job->start : '') }}" placeholder="Select time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                            <input type="time" id="end" name="end[]" class="form-control"
                                value="{{ old('end', isset($job) ? $job->end : '') }}" placeholder="Select time">
                        </div>
                    </div>
                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="fk_typetask">
                                {{ trans('cruds.job.fields.task_name') }}</label>
                            <select name="fk_typetask[]" id="fk_typetask" class="form-control select2" required>
                                @foreach($list as $lists)
                                <option value="{{ $lists->type_task_id }}" @if($lists->type_task_id ==
                                    $job->fk_typetask) selected="selected" @endif>{{ $lists->TaskId->name }}
                                </option>
                                @endforeach

                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="comments">{{ trans('cruds.job.fields.value') }}</label>
                            <input type="number" class="form-control" name="value[]" id="value"
                                value="{{ old('value', isset($job) ? $job->value : '') }}">
                        </div>

                    </div>

                    <div class="form-row" style="margin-left:1%;margin-right:1%;">
                        <div class="form-group col-md-6">
                            <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                            <textarea class="form-control" name="description[]" id="comments"
                                rows="3">{{$job->description}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" name="comments[]" id="comments"
                                rows="3">{{$job->comments}}</textarea>
                        </div>

                    </div>
                    <div class="form-group col-md-6" style="display:none">
                        <label for="id" style="margin-top:1%;">RNS</label>
                        <input type="number" id="id" name="id[]" class="form-control"
                            value="{{ old('id', isset($job) ? $job->id : '') }}" required>
                    </div>


                </div>
              
                <div class="resultbody "></div>
                <div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="button" class="btn btn-dark float-left btn-floating add"
                            value="Dodaj nowe zadanie">
                    </div>
                    <div class="col">
                        <input class="btn btn-success float-right " type="submit" value="{{ trans('global.save') }}">
                        <a href="{{ route('admin.jobs.show', $job->id) }}">
                            <input class="btn btn-info  float-right" type="button"
                                value="{{ trans('global.datatables.print') }}">

                        </a>
                    </div>
                </div>





            </form>



        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="Uwagi">
            Brak uwag
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="Historia">
            
        @if(!empty($Notification))
        @foreach($Notification as $Notifications)
        <td>Użytkownik {{$Notifications->NotificationUser->name}} {{$Notifications->NotificationUser->surname}}
            modyfikował rekord {{$Notifications->date}}
        </td><hr>
        @endforeach
        @else
        <td> Dawno dawno temu....</td>
       @endif      
        </div>
        <!-- /.tab-pane -->
    </div>


</body>

</html>


<script type="text/javascript">
$(function() {
    $('.add').click(function() {
        var n = ($('.resultbody'));
        var tr =

        '<div class="card">'+
            '<h5 class="card-header bg-dark">{{ trans('cruds.job.fields.description') }}</h5>'+
            ' <button type="button" style="margin-left:91%;" class="btn btn-dark float-right btn-sm col-md-1 delete">'+
                      'X</i>'+
                    '</button>'+
            
            '<div class="form-row " style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.startdate') }}</label>'+
                       '<input type="date" id="startdate" name="start_date_new[]" class="form-control input-group-addon" value="{{ date("Y-m-d") }}">'+
                       '</div>'+
                   
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.enddate') }}</label>'+
                       '<input type="date" id="enddate" name="end_date_new[]" class="form-control" value="{{ date("Y-m-d") }}">'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>'+
                       '<input type="time" id="start" name="start_new[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>'+
                        '<input type="time" id="end" name="end_new[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                '</div>'+
                '<div class="form-row " style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-6">'+
            '<label for="fk_typetask" >{{ trans('cruds.job.fields.task_name') }}</label>'+
            '<select name="fk_typetask_new[]" id="fk_typetask" class="form-control select2" required>'+                       
                                '@foreach($list as $lists)'+
                                '<option value="{{ $lists->type_task_id }}" @if($lists->type_task_id ==$job->fk_typetask) selected="selected" @endif>{{ $lists->TaskId->name }}'+
                               '</option>'+
                                '@endforeach'+
                 '</select>'+
            '</div>'+
            '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.value') }}</label>'+
                       '<input type="number" id="value" name="value_new[]" class="form-control" >'+
                    '</div>'+
                    '</div>'+
            '<div class="form-row" style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-6">'+
            '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
            '<textarea class="form-control" name="description_new[]" id="description" rows="3"></textarea>'+
            '</div>'+
            '<div class="form-group col-md-6">'+
            '<label for="description">Comments</label>'+
            '<textarea class="form-control" name="comments_new[]" id="comments" rows="3"></textarea>'+
            '</div>'+

            '</div>'+
            
            '</div>';



        $('.resultbody').append(tr);
    });
    $('.resultbody').delegate('.delete', 'click', function() {
        $(this).parent().remove();
    });
});
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UpdateJobRequest') !!}

<script type='text/javascript'>
   $(document).ready(function(){

      // Department Change
      $('#fk_tasktype').change(function(){

         // Department id
         var id = $(this).val();
         
         // Empty the dropdown
         $('#fk_typetask').find('option').remove();        
         // AJAX request 
         $.ajax({
           url: 'getTask/'+id,
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
                   var name = response['data'][i].name;

                   var option = "<option value='"+id+"'>"+name+"</option>";

                   $("#fk_typetask").append(option); 
                  
                }
             }

           }
         });
      });
   });
   </script>