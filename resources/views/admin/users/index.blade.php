@extends('layouts.admin')

@section('styles')
<style>
    div.dt-buttons {
        float: left;
        margin-right: 1em;
    }

    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
    }

    table.dataTable th,
    table.dataTable td {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-dark">
    {{ trans('global.list') }} {{ trans('cruds.user.title_plural') }}
        @can('user_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.users.create") }}">
        <i class="fa fa-plus"></i>  {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatable datatable-User" style="width:100%">
           
                <thead>
                    <tr>
                        <th width="10">
                        {{ trans('global.lp') }}
                        </th>
                        &nbsp;
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <!-- <td>
                                {{ $user->id ?? '' }}
                            </td> -->
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->surname ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                {{ $item->title }}
                                @endforeach
                            </td>
                            <td width="10">                                                       
                            
                                <div class="btn-group" role="group">
                                @can('user_edit')
                                    <a class="btn btn-info" title="{{ trans('global.edit') }}" href="{{ route('admin.users.edit', $user->id) }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('user_delete')
                                <form action="{{  route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>


@endsection