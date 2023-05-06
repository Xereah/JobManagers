@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        Lista sprzętu
        @can('company_create')
        <!-- <a class="btn btn-dark float-right" href="{{ route("admin.inventory.create") }}">
            <i class="fa fa-plus"></i> {{ trans('global.add') }} sprzęt</a> -->

        <div class="btn-group dropleft  float-right">
            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                {{ trans('global.add') }} sprzęt
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item"  href="{{ url('/inventory/drukarki') }}">Drukarki</a>
                <a class="dropdown-item"  href="{{ url('/inventory/fiskalne') }}">Fiskalne</a>
                <a class="dropdown-item"  href="{{ url('/inventory/komputery') }}">Komputery</a>
                <a class="dropdown-item"  href="{{ url('/inventory/monitory') }}">Monitory</a>
                <a class="dropdown-item"  href="{{ url('/inventory/notebooki') }}">Notebooki</a>
                <a class="dropdown-item"  href="{{ url('/inventory/ups') }}">UPS</a>
                <a class="dropdown-item"  href="{{ url('/inventory/siec') }}">Sieć</a>
                <a class="dropdown-item"  href="{{ url('/inventory/pozostale') }}">Pozostałe</a>
            </div>
        </div>

        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable yajra-datatable" id="example">
                <thead>
                    <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_code" class="form-control" /></th>
                        <th><input id="filtr_nazwa" class="form-control" /></th>
                        <th><input id="filtr_kontrahent" class="form-control" /></th>
                        <th><input id="filtr_rodzaj" class="form-control" /></th>
                        <th></th>
                    </tr>
                    <tr align="center">
                        <th>
                            {{ trans('cruds.company.fields.lp') }}
                        </th>

                        <th>
                            Kod
                        </th>
                        <th>
                            Nazwa
                        </th>
                        <th>
                            Kontrahent
                        </th>
                        <th>
                            Rodzaj
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody align="center">
                @foreach($computers as $key => $computer)
                    <tr data-entry-id="{{ $computer->id }}">
                        <td>
                            <!-- {{ $computer->id }} -->
                        </td>
                        <td data-toggle="tooltip" @if($computer->eq_type == 1 ||$computer->eq_type == 6)
                            title="{{ $computer->ram }}GB Ram, Procesor {{ $computer->processor }}, Dysk {{ $computer->hard_drive }} {{ $computer->hard_drive_capacity }} @endif">
                            {{$computer->code}}
                        </td>
                        <td>
                            {{$computer->mark}} {{$computer->model}}
                        </td>
                        <td>
                            {{$computer->company->shortcode}}
                        </td>
                        
                        <td>
                            {{$computer->EqCategory->category_name}}
                        </td>                
                        <td>
                            <!-- @can('equipment_show')
                            <a class="btn  btn-warning" href="{{ route('admin.inventory.show', $computer->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-eye"></i>
                                    </a>
                                @endcan  -->
                         
                            <div class="btn-group" role="group">
                                @can('equipment_edit')
                                    @if($computer->eq_type == 1 ||$computer->eq_type == 6)
                                    <a class="btn  btn-info" href="{{ url('job/edit_pc', $computer->id) }}" title="{{ trans('global.edit') }}">
                                     @else   
                                    <a class="btn  btn-info" href="{{ route('admin.inventory.edit', $computer->id) }}" title="{{ trans('global.edit') }}">
                                     @endif   
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                 @can('equipment_delete')
                                <form action="{{  route('admin.inventory.destroy', $computer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
$('#btnSearch').click(function (){
        table.columns([1,2,3,4]).search('').draw();
       });
    $('#filtr_code').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_nazwa').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_kontrahent').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_rodzaj').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
});

</script>

@endsection