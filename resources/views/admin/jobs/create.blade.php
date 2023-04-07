<!DOCTYPE html>
<html>

<head>
    <script src="{{ asset('js/main.js') }}"></script>

</head>

<body>

    <div class="card-body">
        <form action="{{ url('/job/store/add/new') }}" method="post">
            @csrf


            <div class="card">
                <h5 class="card-header bg-dark">{{ trans('cruds.job.fields.about') }}</h5>

                <div class="form-row" style="margin-left:1%;margin-right:1%;">
                    <div class="form-group col-md-6">
                        <label for="fk_company" style="margin-top:1%;">{{ trans('cruds.job.fields.company') }}
                        </label>
                        <select name="fk_company" id="fk_company" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($companies as $company)                           
                            <option  value="{{ $company->id }}">{{ $company -> shortcode }}</option>                        
                            @endforeach
                           
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rns" style="margin-top:1%;">{{ trans('cruds.job.fields.place') }}</label>
                        <select name="location" id="myText" class="form-control" required>
                            <option value="3">Kasper Komputer Sp. z o.o</option>
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
                        <select name="fk_tasktype" id="fk_tasktype" class="form-control " required>                        
                        @foreach($TaskType as $TaskTypes)
                            <option value='{{ $TaskTypes->id }}'>{{ $TaskTypes->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="paid" style="margin-top:1%;">{{ trans('cruds.job.fields.paid') }}</label>
                        <select id="paid" name="paid" class="form-control ">
                            <option value="1">{{ trans('global.free') }}</option>
                            <option value="2">{{ trans('global.paid') }}</option>
                        </select>
                    </div>
                 
                </div>

                <div class="form-row" style="margin-left:1%;margin-right:1%;">
                    <div class="form-group col-md-6">
                        <label for="fk_user" style="margin-top:1%;">{{ trans('cruds.job.fields.performed_singular') }}</label>
                        <select id="fk_user" name="fk_user" class="form-control ">
                            <option value="{{ $user->id}}">{{ $user->name }} {{ $user->surname }}
                            </option>
                            @foreach($user_all as $users)
                            <option value="{{ $users->id }}">{{ $users->name }} {{ $users->surname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="rns" style="margin-top:1%;">{{ trans('cruds.job.fields.rns') }}</label>
                        <input type="number" name="rns" class="form-control">
                    </div>
                </div>

            </div>

            <div class="card ">
                <h5 class="card-header bg-dark">{{ trans('cruds.job.fields.description') }}
                </h5>
            
                <div class="form-row " style="margin-left:1%;margin-right:1%;">
                <div class="form-group col-md-6">
                        <label for="start_date" >{{ trans('cruds.job.fields.startdate') }}</label>   
                                         
                            <input type='date' id="start_date[]" name="start_date[]"
                                class="form-control input-group-addon"  value="{{ date("Y-m-d") }}"/>
                            </span> 
                                           
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" >{{ trans('cruds.job.fields.enddate') }}</label>   
                                         
                            <input type='date' id="end_date[]" name="end_date[]" class="form-control input-group-addon" value="{{ date("Y-m-d") }}"/>
                            @if($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </span>     
                                              
                    </div>      
                    <div class="form-group col-md-6">
                        <label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>
                        <input type="time" id="start[]" name="start[]" class="form-control" placeholder="Select time">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>
                        <input type="time" id="end[]" name="end[]" class="form-control" placeholder="Select time">
                    </div>
                </div>
                <div class="form-row" style="margin-left:1%;margin-right:1%;">
                <div class="form-group col-md-12">
                    <label for="fk_typetask"> 
                        {{ trans('cruds.job.fields.task_name') }}</label>
                   
                    <select id='fk_typetask' name='fk_typetask[]'  class="form-control " required>  
                                @foreach($list as $lists)
                                <option value="{{ $lists->type_task_id }}" >{{ $lists->TaskId->name }}
                                </option>
                                @endforeach  
                    </select>
                  
                </div>
                    <!-- <div class="form-group col-md-6">
                        <label for="comments">{{ trans('cruds.job.fields.value') }}</label>
                        <input type="number" class="form-control" name="value[]" value="0" id="value[]"></textarea>
                    </div> -->

                </div>

                <div class="form-row" style="margin-left:1%;margin-right:1%;">
                    <div class="form-group col-md-12">
                        <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                        <textarea class="form-control" name="description[]" id="comments[]" rows="3"></textarea>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label for="comments">{{ trans('cruds.job.fields.comments') }}</label>
                        <textarea class="form-control" name="comments[]" id="comments[]" rows="3"></textarea>
                    </div> -->

                </div>
            </div>
            <div class="resultbody "></div>
            <div>
                <input class="btn btn-success float-right" type="submit" value="{{ trans('global.save') }}">
                <button type="button" class="btn btn-dark float-left btn-floating add">
                {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.job.title_singular') }}
                    </button>
        </form>


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
            '<button type="button" style="margin-left:91%;" class="btn btn-dark float-right btn-sm col-md-1 delete">'+
                'X'+
            '</button>'+
            
            '<div class="form-row " style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.startdate') }}</label>'+
                       '<input type="date" id="startdate" name="start_date[]" class="form-control input-group-addon" value="{{ date("Y-m-d") }}" >'+
                       '</div>'+
                   
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.enddate') }}</label>'+
                       '<input type="date" id="enddate" name="end_date[]" class="form-control" value="{{ date("Y-m-d") }}">'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.start') }}</label>'+
                       '<input type="time" id="start" name="start[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                        '<label for="default-picker">{{ trans('cruds.job.fields.end') }}</label>'+
                        '<input type="time" id="end" name="end[]" class="form-control" placeholder="Select time">'+
                    '</div>'+
                '</div>'+
                '<div class="form-row " style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-12">'+
            '<label for="fk_typetask" >{{ trans('cruds.job.fields.task_name') }}</label>'+
            '<select id="fk_typetask1" name="fk_typetask[]"  class="form-control " required>'+  
                                '@foreach($list as $lists)'+
                                '<option value="{{ $lists->type_task_id }}" >{{ $lists->TaskId->name }}'+
                                '</option>'+
                                '@endforeach'+  
                    '</select>'+
            '</div>'+
                    '</div>'+
            '<div class="form-row" style="margin-left:1%;margin-right:1%;">'+
            '<div class="form-group col-md-12">'+
            '<label for="description">{{ trans('cruds.job.fields.description') }}</label>'+
            '<textarea class="form-control" name="description[]" id="description" rows="3"></textarea>'+
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
 <script type="text/javascript">
      $(".date").datepicker({
        format: "yyyy-mm-dd",
      });
    </script>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\StoreJobRequest') !!}
<script type='text/javascript'>
   $(document).ready(function(){

      // Department Change
      $('#fk_tasktype').change(function(){

         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#fk_typetask').find('option').remove();
         $('#fk_typetask1').find('option').remove();

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
                   $("#fk_typetask1").append(option);
                   
                }
             }

           }
         });
      });
   });
   </script>