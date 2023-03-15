@extends('layouts.admin')
@section('content')
@can('equipment_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.repequipment.create") }}">
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
            <table class=" table table-bordered table-hover datatable table-responsive" id="example">
                <thead>
                    <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i
                                    class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_numer" class="form-control" /></th>
                        <th><input id="filtr_urzadzen" class="form-control" /></th>
                        <th><input id="filtr_kategorii" class="form-control" /></th>
                        <th><input id="filtr_seryjny" class="form-control" /></th>
                        <th><input id="filtr_miejsca" class="form-control" /></th>
                        <th><input id="filtr_daty" class="form-control" /></th>
                        <th><input id="filtr_uwagi" type="text" class="form-control"></th>
                        <th></th>
                       
                
                    </tr>
                    <tr>
                        <th width="10">
                            {{ trans('cruds.company.fields.lp') }}
                        </th>

                        <th>
                            Numer
                        </th>
                        <th>
                           Kategoria
                        </th>
                        <th>
                            Nazwa urządzenia
                        </th>
                        <th>
                            Numer seryjny
                        </th>
                        <th>
                            Miejsce przebywania
                        </th>
                        <th>
                            Data wpisu
                        </th>
                        <th>
                            Uwagi
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($RepEquipment as $key => $RepEquipments)
                    <tr data-entry-id="{{ $RepEquipments->id }}">
                        <td>
                            <!-- {{ $RepEquipments->id }} -->
                        </td>
                        <td>
                            {{$RepEquipments->eq_number}}
                        </td>
                        <td>
                            {{$RepEquipments->EqCategory->category_name}}
                        </td>
                        <td>
                            {{$RepEquipments->eq_name}}
                        </td>
                        
                        <td>
                            {{$RepEquipments->serial_number}}
                        </td>
                        <td>
                            @if(!empty($RepEquipments->company->shortcode))
                            {{$RepEquipments->company->shortcode}}
                            @else
                            @endif
                        </td>
                        <td>
                            {{$RepEquipments->entry_date}}
                        </td>
                        <td>
                            {{$RepEquipments->comments}}
                        </td>
                        <td>
                            <!-- @can('equipment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.repequipment.show', $RepEquipments->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan -->

                            @can('equipment_edit')
                            <a class="btn btn-xs col-md-12  btn-info" title="edycja"
                                href="{{ route('admin.repequipment.edit', $RepEquipments->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                        
                            @can('equipment_edit')
                            <a class="btn btn-xs col-md-12  btn-success" title="zwrot towaru"
                                href="{{ url('/is_loan', $RepEquipments->id) }}">
                                Zwrot
                            </a>
                            @endcan

                            @can('equipment_delete')
                            <form action="{{ route('admin.repequipment.destroy', $RepEquipments->id) }}" class="col-md-12 " method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_method"
                                    value="DELETE">
                                <input type="hidden" class="btn btn-xs col-md-12 btn-danger" name="_token"
                                    value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs col-md-12 btn-danger" title="usuń"
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

    $('#filtr_numer').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_urzadzen').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_kategorii').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_seryjny').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_miejsca').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_daty').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_uwagi').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
 
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,6]).search('').draw();
       });

 
});
</script>
@endsection

