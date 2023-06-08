@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
    {{ trans('global.list') }} {{ trans('cruds.task.title_singular') }} 
    <div class="float-right">
        @if(Request::is('admin/tasks/completed'))
            <a href="{{ route('admin.tasks.index') }}" class="link-info"><strong>Przejdź Do Nie Wykonanych</strong></a>
        @else
            <a href="{{ url('/admin/tasks/completed') }}" class="link-info"><strong>Przejdź Do Wykonanych</strong></a>
        @endif
        </div><br>
        @can('company_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.tasks.create") }}">
        <i class="fa fa-plus"></i>  {{ trans('global.add') }} {{ trans('cruds.task.title_plural') }}
            </a>
        @endcan

        
        <div class="form-check p-1 float-right" id="filtr_kontrahent">
            <input class="form-check-input" type="checkbox" id="medycyna-checkbox" value="[5,6]" style="margin-right: 10px;">
            <label class="form-check-label" for="medycyna-checkbox" style="padding-right: 30px;">Medycyna</label>
            
            <input class="form-check-input" type="checkbox" id="farmacja-checkbox" value="[2,3]" style="margin-right: 10px;">
            <label class="form-check-label" for="farmacja-checkbox" style="padding-right: 30px;">Farmacja</label>
            
            <input class="form-check-input" type="checkbox" id="przedsiebiorstwa-checkbox" value="[7,8]" style="margin-right: 10px;">
            <label class="form-check-label" for="przedsiebiorstwa-checkbox">Przedsiębiorstwa</label><br>
        </div>
      
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable yajra-datatable" id="example">
                <thead>
                <tr>
               
               <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
               <th><input id="filtr_akronim" class="form-control" /></th>
               <th><input id="filtr_nazwa" class="form-control" /></th>              
               <th><input id="filtr_wykonujacy" class="form-control" /></th>
               <th><input id="filtr_data_wpisu" type="date" class="form-control"></th>
               <th><input id="filtr_wykonujacy_zadanie" class="form-control" /></th>
               <th><input id="filtr_data_wykonania" type="date" class="form-control"></th>          
               <th><input id="filtr_postep" class="form-control" /></th>
               <th></th>
              
          
           </tr>
                    <tr>
                        <th width="15">
                        {{ trans('global.lp') }}
                        </th>
                       
                        <th width="10" >
                        {{ trans('cruds.company.title_singular') }}
                        </th>
                        <th>
                        {{ trans('cruds.task.title_plural') }}
                        </th>
                       
                        <th width="10">
                        {{ trans('cruds.task.fields.typing') }}
                        </th>
                        <th width="10">
                        {{ trans('cruds.task.fields.typing_date') }}
                        </th>
                        <th width="10">
                        {{ trans('cruds.task.fields.performed') }}
                        </th>
                        <th width="10">
                        {{ trans('cruds.task.fields.typing_finish') }}
                        </th>
                        <th width="10">
                        {{ trans('cruds.task.fields.progress') }}
                        </th>
                        <th width="10">                          
                        </th>
                        <th width="10" hidden>
                        {{ trans('cruds.job.fields.contracts') }}                   
                        </th>

                      
                    </tr>
                </thead>
                <tbody align="center">
                @foreach($tasks as $key => $task)
                    <tr data-entry-id="{{ $task->id }}">
                        <td>
                            <!-- {{ $task->id }} -->
                        </td>
                        <td>
                            {{$task->company->kontrahent_kod}}
                           
                        </td>
                        <td style="text-align:left">
                             {{$task->title}}
                           
                        </td>
                     
                        <td>

                        <?php
                        $zmienna1=$task->users->name;
                        $zmienna2=$task->users->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                                ?>
                        {{$firstLetter1}}{{$firstLetter2}}
                        </td>
                        <td>
                        {{$task->start}}
                      
                        </td>
                        <td>

                        <?php
                        $zmienna3=$task->users_exec->name;
                        $zmienna4=$task->users_exec->surname;
                        $firstLetter3 = substr($zmienna3, 0, 1);
                        $firstLetter4 = substr($zmienna4, 0, 1);
                                ?>
                        {{$firstLetter3}}{{$firstLetter4}}
                        </td>
                        <td>
                        {{$task->execution_date}}
                        </td>

                        <td>
                        @if($task->completed == 0)
                           <p  style="color:red;font-size: 1,5em;font-weight: bold;" > X </p>
                            @else
                           <p style="color:green;font-size: 2em;font-weight: bold;" > + </p>
                            @endif
                        </td>
                        <td>                          

                            <div class="btn-group" role="group">
                                @can('job_edit')
                                    <a class="btn  btn-info" href="{{ route('admin.tasks.edit', $task->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('job_edit')
                                @if($task->completed !=1)
                                <a class="btn  btn-success" title="Wykonane"
                                href="{{ url('/is_done', $task->id) }}">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                                @endif
                                @endcan
                                @can('job_delete')
                                <form action="{{  route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn  btn-danger" title="{{ trans('global.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                                </div>

                        </td>
                        <td hidden>
                        {{$task->fk_contract}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>


    </div>
</div>


@endsection
@section('scripts')

@parent


<script>
$(document).ready(function() {
$('#example').DataTable();
minDate = new DateTime($('#min'), {
         format: 'YYYY-MM-DD'
        });
maxDate = new DateTime($('#max'), {
         format: 'YYYY-MM-DD'
        });
var table = $('#example').DataTable();

    $('#filtr_akronim').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_nazwa').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_uwagi').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_wykonujacy').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_wykonujacy_zadanie').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_postep').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_data_wpisu').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_data_wykonania').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
 
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,6]).search('').draw();
       });

     $('#filtr_kontrahent input[type="checkbox"]').on('change', function () {
    var checkedBoxes = $('#filtr_kontrahent input[type="checkbox"]:checked');
    var values = [];
    $.each(checkedBoxes, function (index, element) {
        values.push($(element).val());
    });
    table.column(9).search(values.join('|'), true, false).draw();
        });


});

</script>


@endsection
