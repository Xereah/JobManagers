@extends('layouts.admin')
@section('content')
@can('car_create')
@endcan 
<div class="card">
    <div class="card-header bg-dark">
    {{ trans('global.list') }} {{ trans('cruds.cars.title_plural') }}

        <a class="btn btn-dark float-right" href="{{ route("admin.car.create") }}">
        <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.cars.title_singular') }}
        </a>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table  table-hover datatable" id="example">
                <thead>
                    <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i
                                    class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_marka" class="form-control" /></th>
                        <th><input id="filtr_model" class="form-control" /></th>
                        <th><input id="filtr_rejestracja" class="form-control" /></th>
                        <th></th>
                
                    </tr> 
                    <tr>
                        <th width="10">
                        {{ trans('global.lp') }}
                        </th>

                        <th>
                        {{ trans('cruds.cars.fields.mark') }}
                        </th>
                        <th>
                        {{ trans('cruds.cars.fields.model') }}
                        </th>
                        <th>
                        {{ trans('cruds.cars.fields.plates') }}
                        </th>
                     
                        <th>
                           
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($car as $key => $cars)
                    <tr data-entry-id="{{ $cars->id }}">
                        <td>
                            <!-- {{ $cars->id }} -->
                        </td>
                        <td>
                            {{$cars->car_mark}}
                        </td>
                        <td>
                            {{$cars->car_model}}
                        </td>
                        <td>
                            {{$cars->car_plates}}
                        </td>
                                              
                      
                        <td width="10">
                   
                        <div class="btn-group" role="group">
                                @can('car_edit')
                                    <a class="btn  btn-info" href="{{  route('admin.car.edit', $cars->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('car_delete')
                                <form action="{{ route('admin.car.destroy', $cars->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn  btn-danger" title="{{ trans('global.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                                </div>

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

    $('#filtr_marka').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_model').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_rejestracja').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
 
    $('#btnSearch').click(function (){
        table.columns([1,2,3]).search('').draw();
       });

 
});
</script>
@endsection

