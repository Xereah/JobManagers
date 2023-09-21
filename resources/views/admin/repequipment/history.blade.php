@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        Historia Sprzętu
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-hover datatable" id="example">
                <thead>
                    <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i
                                    class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_sprzętu" class="form-control" /></th>
                        <th><input id="filtr_firm" class="form-control" /></th>
                        <th><input id="filtr_uzytkownika" class="form-control" /></th>
                        <th><input id="filtr_wydania" class="form-control" /></th>
                        <th><input id="filtr_zwrotu" class="form-control" /></th>
                        <th><input id="filtr_uwag" class="form-control" /></th>
                        <!-- <th></th> -->



                    </tr>
                    <tr>
                        <th width="10">
                            {{ trans('global.lp') }}
                        </th>
                        <th>
                            Sprzęt
                        </th>
                        <th>
                            Firma
                        </th>
                        <th>
                            Osoby wydająca
                        </th>
                        <th>
                            Data wydania
                        </th>
                        <th>
                            Data zwrotu
                        </th>
                        <th>
                           Uwagi
                        </th>
                        <!-- <th>

                        </th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($RepEquipment_history as $key => $RepEquipments)
                    <tr data-entry-id="{{ $RepEquipments->id }}">
                        <td>
                            <!-- {{ $RepEquipments->id }} -->
                        </td>
                        <td>
                            {{$RepEquipments->EqCategory->eq_number ?? ''}}

                        </td>
                        <td>
                            {{$RepEquipments->company->kontrahent_kod ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->UserCategory->name ?? ''}}  {{$RepEquipments->UserCategory->surname ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->rental_date ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->return_date ?? ''}}
                        </td>
                        <td>
                            {{$RepEquipments->description ?? ''}}
                        </td>
                        <!-- <th>
                        @can('equipment_edit')
                        @if (is_null($RepEquipments->return_date))
                                <a class="btn xs btn-success" title="zwrot towaru"
                                    href="{{ url('/is_loan', $RepEquipments->id) }}">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                @endif
                                @endcan
                        </th> -->

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- medium modal -->
<div class="modal fade bd-example-modal-lg fade right" id="mediumModal" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">
        <div class="modal-content bg-light">
            <div class="modal-body" id="mediumBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
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

    $('#filtr_sprzętu').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_firm').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_uzytkownika').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_wydania').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_zwrotu').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_uwag').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
  
    $('#btnSearch').click(function() {
        table.columns([1, 2, 3, 4, 5, 6, 7]).search('').draw();
    });


});
</script>

<script>
// display a modal (medium modal)
$(document).on('click', '#mediumButton', function(event) {
    event.preventDefault();
    let href = $(this).attr('data-attr');
    $.ajax({
        url: href,
        beforeSend: function() {
            $('#loader').show();
        },
        // return the result
        success: function(result) {
            $('#mediumModal').modal("show");
            $('#mediumBody').html(result).show();
        },
        complete: function() {
            $('#loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    })
});
</script>
@endsection