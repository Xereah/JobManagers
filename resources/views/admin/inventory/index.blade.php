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
                        <th><input id="" class="form-control" /></th>
                        <th><input id="" class="form-control" /></th>
                        <th><input id="" class="form-control" /></th>
                        <th><input id="" class="form-control" /></th>
                        <th></th>
                    </tr>
                    <tr>
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

});

</script>

@endsection