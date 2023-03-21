@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('cruds.tasktype.title_singular') }} {{ trans('global.list') }}
        @can('TaskType_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.tasktype.create") }}">
        <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.tasktype.title_singular') }}
            </a>
        @endcan

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tasktype.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tasktype.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($TaskType as $key => $Tasktypes)
                        <tr data-entry-id="{{ $Tasktypes->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $Tasktypes->id ?? '' }}
                            </td>
                            <td>
                                {{ $Tasktypes->name ?? '' }}
                            </td>
                            <td>
                                @foreach($Tasktypes->TypeTask as $key => $item)
                                   {{ $item->name }},
                                @endforeach
                            </td>
                            <td width="10">
                                <!-- @can('TaskType_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tasktype.show', $Tasktypes->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan -->

                                <div class="btn-group" role="group">
                                @can('permission_edit')
                                    <a class="btn  btn-info" href="{{ route('admin.tasktype.edit', $Tasktypes->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('permission_delete')
                                <form action="{{ route('admin.tasktype.destroy', $Tasktypes->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('TaskType_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasktype.massDestroy') }}",
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
    pageLength: 100,
  });
  $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection