@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('global.list') }} {{ trans('cruds.rep_eq.title_plural') }}
        @can('equipment_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.repequipment.create") }}">
            <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.rep_eq.title') }}
        </a>
        @endcan
        <div class="form-check p-2 float-right" id="filtr_statusu">
    <input class="form-check-input" type="checkbox" id="paid-checkbox" value="Aktywny">
    <label class="form-check-label" for="paid-checkbox">Aktywne</label>
</div>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-hover datatable" id="example">
                <thead>
                    <tr>
                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i
                                    class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_numer" class="form-control" /></th>
                        <th><input id="filtr_urzadzen" class="form-control" /></th>
                        <th><input id="filtr_kategorii" class="form-control" /></th>
                        <th><input id="filtr_statusu" class="form-control" /></th>
                        <th><input id="filtr_miejsca" class="form-control" /></th>
                        <th><input id="filtr_daty" class="form-control" /></th>
                        <th><input id="filtr_param" type="text" class="form-control"></th>
                        <th><input id="filtr_uwagi" type="text" class="form-control"></th>
                        <th></th>


                    </tr>
                    <tr>
                        <th width="10">
                            {{ trans('global.lp') }}
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.number') }}
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.device_name') }}
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.place') }}
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.entry_date') }}
                        </th>
                        <th>
                            Parametry
                        </th>
                        <th>
                            {{ trans('cruds.rep_eq.fields.comments') }}
                        </th>
                        <th>

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

                            <a class="text-success" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                data-attr="{{ route('admin.repequipment.show', $RepEquipments->id) }}">
                                {{$RepEquipments->eq_number}}
                            </a>
                        </td>
                        <td>
                            {{$RepEquipments->EqCategory->category_name}}
                        </td>
                        <td>
                            {{$RepEquipments->eq_name}}
                        </td>
                        <td>
                            <span style="color: {{ $RepEquipments->eq_active == 0 ? 'green' : 'red' }}">
                                {{ $RepEquipments->eq_active == 0 ? 'Aktywny' : 'Wycofany' }}
                            </span>
                        </td>

                        <td>
                            @if(!empty($RepEquipments->company->kontrahent_kod))
                            {{$RepEquipments->company->kontrahent_kod}}
                            @else
                            @endif
                        </td>
                        <td>
                            {{$RepEquipments->entry_date}}
                        </td>
                        <td>
                            {{$RepEquipments->eq_specification}}
                        </td>
                        <td>
                            {{$RepEquipments->comments}}
                        </td>
                        <td>
                            <!-- @can('equipment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.repequipment.show', $RepEquipments->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan   -->

                            <div class="btn-group" role="group">
                                @can('equipment_edit')
                                <a class="btn  btn-info"
                                    href="{{ route('admin.repequipment.edit', $RepEquipments->id) }}"
                                    title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan

                                @can('equipment_edit')
                                @if ($RepEquipments->company_place != '2')
                                <a class="btn  btn-success" title="zwrot towaru"
                                    href="{{ url('/is_loan', $RepEquipments->id) }}">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                @endif
                                @endcan

                                @can('equipment_delete')
                                <form action="{{  route('admin.repequipment.destroy', $RepEquipments->id) }}"
                                    method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                    style="display: inline-block;">
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

    $('#filtr_numer').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_urzadzen').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_kategorii').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_statusu').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_miejsca').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_daty').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_uwagi').on('change', function() {
        table.columns($(this).parent().index() + ':visible').search(this.value).draw();
    });
    $('#filtr_statusu input[type="checkbox"]').prop('checked', true);
    function applyFilter() {
        var checkedBoxes = $('#filtr_statusu input[type="checkbox"]:checked');
        var values = [];
        $.each(checkedBoxes, function (index, element) {
            values.push($(element).val());
        });
        table.column(4).search(values.join('|'), true, false).draw();
    }

    applyFilter(); // Wywołaj funkcję filtrującą od razu po załadowaniu strony

    $('#filtr_statusu input[type="checkbox"]').on('change', applyFilter);

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