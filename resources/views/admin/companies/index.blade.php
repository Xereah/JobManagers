@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
        @can('company_create')
        <a class="btn btn-dark float-right" href="{{ route("admin.companies.create") }}">
        <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
            </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Company" id="example">
                <thead>
                <tr>
               
               <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i class="fa fa-trash"></i></button></th>
               <th><input id="filtr_akronim" class="form-control" /></th>
               <th><input id="filtr_nazwa" class="form-control" /></th>
               <th><input id="filtr_ulica" class="form-control" /></th>
               <th><input id="filtr_umowa" class="form-control" /></th>
               <th><input id="filtr_kod" class="form-control" /></th>
               <th><input id="filtr_miasto" class="form-control" /></th>
               <th><input id="filtr_telefon" class="form-control" /></th>
               <th><input id="filtr_email" class="form-control" /></th>
               <th><input id="filtr_odleglosc" class="form-control" /></th>
               <th></th>
              
          
           </tr>
                    <tr>
                        <th width="10">
                        {{ trans('cruds.company.fields.lp') }}
                        </th>
                       
                        <th >
                            {{ trans('cruds.company.fields.shortcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.street') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.contract') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.zipcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.phonenumber') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.company.fields.distance') }}
                        </th>                          
                        
                        <th>
                        {{ trans('cruds.company.fields.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $key => $company)
                        <tr data-entry-id="{{ $company->id }}">
                            <td>

                            </td>                            
                            <td>
                                {{ $company->shortcode ?? '' }}
                            </td>
                            <td>
                                {{ $company->name ?? '' }}
                            </td>
                            <td>
                                {{ $company->street ?? '' }}
                            </td>    
                            <td>
                                {{ $company->contract->contract_name ?? '' }}
                            </td>               
                            <td>
                                {{ $company->zipcode ?? '' }}
                            </td> 
                            <td>
                                {{ $company->location ?? '' }}
                            </td>  
                            <td>
                                {{ $company->phonenumber ?? '' }}
                            </td>   
                            <td>
                                {{ $company->email ?? '' }}
                            </td>  
                            <td>
                                {{ $company->distance ?? '' }}
                            </td> 
                            <td width="10">
                                <!-- @can('company_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.companies.show', $company->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan -->
                                <div class="btn-group" role="group">
                                @can('company_edit')
                                    <a class="btn  btn-info" href="{{ route('admin.companies.edit', $company->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('company_delete')
                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies.massDestroy') }}",
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
  $('.datatable-Company:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>

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
    $('#filtr_akronim').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_nazwa').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_ulica').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_umowa').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_kod').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_miasto').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_telefon').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_email').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_odleglosc').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,7,9,10]).search('').draw();
       });

 
});
</script>

@endsection
