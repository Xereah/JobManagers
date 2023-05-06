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
            <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                <thead align="center">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('role_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.roles.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection