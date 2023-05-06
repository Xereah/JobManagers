@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('global.list') }} {{ trans('cruds.miasta.title_one') }}

        <a class="btn btn-dark float-right" href="{{ route("admin.miasta.create") }}">
            <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.miasta.title_two') }}
        </a>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Role" id="example">
                <thead align="center">
                <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_miast" class="form-control" /></th>
                        <th><input id="filtr_kod" class="form-control" /></th>
                        <th><input id="filtr_dystans" class="form-control" /></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th width="10">
                            {{ trans('global.lp') }}
                        </th>

                        <th>
                            {{ trans('cruds.miasta.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.miasta.fields.zipcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.miasta.fields.distance') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach($miasta as $key => $miasto)
                    <tr data-entry-id="{{ $miasto->id }}">
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            {{ $miasto->kontrahent_miasto ?? '' }}
                        </td>
                        <td>
                            {{ $miasto->kontrahent_kodpocztowy ?? '' }}
                        </td>
                        <td>
                            {{ $miasto->kontrahent_odleglosc ?? '' }}km
                        </td>
                        <td width="10">
                            <div class="btn-group" role="group">

                                <a class="btn btn-info" title="{{ trans('global.edit') }}"
                                    href="{{ route('admin.miasta.edit', $miasto->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{  route('admin.miasta.destroy', $miasto->id) }}" method="POST"
                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                    style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn  btn-danger" title="{{ trans('global.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

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
$('#btnSearch').click(function () {
    $('#filtr_miast, #filtr_kod, #filtr_dystans').val('');
    table.columns([1, 2, 3, 4, 5]).search('').draw();
    });
    $('#filtr_miast').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_kod').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_dystans').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
});

</script>

@endsection