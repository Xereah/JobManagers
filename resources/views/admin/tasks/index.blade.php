@extends('layouts.admin')
@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tasks.create") }}">
                {{ trans('global.add') }} Zadanie
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Lista Zadań
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Company" id="example">
                <thead>
                <tr>
               
               <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
               <th><input id="filtr_akronim" class="form-control" /></th>
               <th><input id="filtr_nazwa" class="form-control" /></th>
               <th><input id="filtr_uwagi" class="form-control" /></th>
               <th><input id="filtr_wykonujacy" class="form-control" /></th>
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
                        <th width="250">
                            Uwagi
                        </th>
                        <th width="10">
                          Wykonujący
                        </th>
                        <th width="10">
                           Postęp
                        </th>
                        <th width="10">
                           Action
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
                        <td>
                             {{$task->task_title}}
                           
                        </td>
                        <td>
                        {{$task->task_description}}
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
                        @if($task->completed == 0)
                           <p  style="color:red;font-size: 1,5em;font-weight: bold;" > X </p>
                            @else
                           <p style="color:green;font-size: 2em;font-weight: bold;" > + </p>
                            @endif
                        </td>
                        <td>

                            <a class="btn btn-xs col-md-12  btn-info" title="edycja"
                                href="{{ route('admin.tasks.edit', $task->id) }}">
                                {{ trans('global.edit') }}
                            </a>                    
                        
                            @if($task->completed == 0)
                            <a class="btn btn-xs col-md-12  btn-success" title="Ustaw wykonanie"
                                href="{{ url('/is_done', $task->id) }}" onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                Wykonaj
                            </a>
                            @endif                       

                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" class="col-md-12 " method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_method"
                                    value="DELETE">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_token"
                                    value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs col-md-12 btn-danger" title="usuń"
                                    value="{{ trans('global.delete') }}">
                            </form>
                           

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
