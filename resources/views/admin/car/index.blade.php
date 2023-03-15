@extends('layouts.admin')
@section('content')
@can('car_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.car.create") }}">
            {{ trans('global.add') }} Sprzęt
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-hover datatable" id="example">
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
                            {{ trans('cruds.company.fields.lp') }}
                        </th>

                        <th>
                            Marka
                        </th>
                        <th>
                           Model
                        </th>
                        <th>
                           Numer rejestracyjny
                        </th>
                     
                        <th>
                            {{ trans('cruds.company.fields.action') }}
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
                                              
                      
                        <td>
                        @can('car_edit')
                            <a class="btn btn-xs col-md-12  btn-info"
                                href="{{ route('admin.car.edit', $cars->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('car_delete')
                            <form action="{{ route('admin.car.destroy', $cars->id) }}" class="col-md-12 " method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_method"
                                    value="DELETE">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_token"
                                    value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs col-md-12 btn-danger"
                                    value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
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

