@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        Lista Zadań
        @can('company_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.tasks.create") }}">
        <i class="fa fa-plus"></i>  {{ trans('global.add') }} Zadanie
            </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-tasks" id="example">
                <thead>
                <tr>
               
               <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
               <th><input id="filtr_akronim" class="form-control" /></th>
               <th><input id="filtr_nazwa" class="form-control" /></th>
              
               <th><input id="filtr_wykonujacy" class="form-control" /></th>
               <th><input id="filtr_dat" class="form-control" /></th>
               <th><input id="filtr_dat" class="form-control" /></th>
               <th><input id="filtr_postep" class="form-control" /></th>
               <th><input id="filtr_postep" class="form-control" /></th>
               <th></th>
              
          
           </tr>
                    <tr>
                        <th width="15">
                        {{ trans('cruds.company.fields.lp') }}
                        </th>
                       
                        <th width="10" >
                            Kontrahent
                        </th>
                        <th>
                           Zadanie
                        </th>
                       
                        <th width="10">
                          Wpisujący
                        </th>
                        <th width="10">
                         Data wpisu
                        </th>
                        <th width="10">
                          Wykonujący
                        </th>
                        <th width="10">
                         Data wykonania
                        </th>
                        <th width="10">
                           Postęp
                        </th>
                        <th width="10">                          
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
                            {{$task->company->shortcode}}
                           
                        </td>
                        <td style="text-align:left">
                             {{$task->task_title}}
                           
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
                        {{$task->created_at}}
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
                                <a class="btn  btn-success" title="Wykonane"
                                href="{{ url('/is_done', $task->id) }}">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
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
    $('#filtr_postep').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
 
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,6]).search('').draw();
       });


});
</script>
@endsection
