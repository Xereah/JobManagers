@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        <!-- <b> {{ trans('cruds.job.title_singular') }} {{ trans('global.list') }}</b> -->
        <b> Widok wyszukiwania filtrów</b>
        @can('job_create')

        <!-- <a class="btn btn-dark float-right" href="{{ route('admin.jobs.create') }}"><i class="fa fa-plus"></i>
            {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
        </a> -->
        <!-- <button type="button" class="btn btn-demo btn-dark btn-demo float-right" data-toggle="modal"
            data-target="#myModal2"><i class="fa fa-filter"></i> Filtry </button> -->
        @endcan
    </div>


    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" style="position: fixed;margin: auto;width:100%;height: 100%;right: 0px;"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title " id="exampleModalLabel">Filtry</h5>
                    <button type="button" class="close" data-dismiss="modal" class="btn-close btn-close-white"
                        aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="GET" action="{{ url('/job/search') }}">
                        <div class="form-floating ">
                            <div class="col">
                                <label for="task_name" style="display:block;">{{ trans('cruds.job.fields.task_name') }}</label>                         
                                <select class="form-control" style="width:100%;" id="task_name" name="task_name">
                                    <option value="" >-----{{ trans('cruds.job.fields.choose') }}-----</option>
                                    @foreach($filter_task_name as $task_name)
                                        <option value="{{ $task_name->id }}">{{ $task_name->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-floating ">
                            <div class="col"> <label for="task"
                                    style="display:block;">{{ trans('cruds.job.fields.task') }}</label>
                                <select
                                    class="form-control" style="width:100%;" id="task" name="task">
                                    <option value="">-----{{ trans('cruds.job.fields.choose') }}-----</option>
                                    @foreach($filter_task as $task)
                                    <option value="{{ $task ->id }}">{{ $task-> name }} </option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="form-floating  ">
                            <div class="col"> <label for="company"
                                    style="display:block;">{{ trans('cruds.job.fields.company') }}</label>
                                <select
                                    class="form-control select2" style="width:100%;" id="company" name="company">
                                    <option value="">-----{{ trans('cruds.job.fields.choose') }}-----</option>
                                    @foreach($filter_company as $filter_companys)
                                    <option value="{{ $filter_companys ->id }}">{{ $filter_companys-> kontrahent_kod }}
                                    </option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="form-floating ">
                            <div class="col"> <label for="fk_contracts"
                                    style="display:block;">{{ trans('cruds.company.fields.contract') }}</label> 
                                <select
                                    class="form-control" style="width:100%;" id="contract_filter"
                                    name="contract_filter">
                                    <option value="">-----{{ trans('cruds.job.fields.choose') }}-----</option>
                                    @foreach($filter_contracts as $contracts)
                                    <option value="{{ $contracts ->contract_name }}">{{ $contracts-> contract_name }} </option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="form-floating  ">
                            <div class="col"> <label for="performed"
                                    style="display:block;">{{ trans('cruds.job.fields.performed') }}</label> 
                                <select
                                    class="form-control" style="width:100%;" id="users" name="users">
                                    <option value="">-----{{ trans('cruds.job.fields.choose') }}-----</option>
                                    @foreach($filter_user as $users)
                                    <option value="{{ $users ->id }}">{{ $users-> name }} {{ $users-> surname }}
                                    </option>
                                    @endforeach
                                </select></div>
                        </div>
                                        
                        <div class="row mx-auto">
                                <div class="col">
                                    <label for="start_date_filter" style="display:block;">
                                        {{ trans('cruds.job.fields.beginning') }}</label>
                                        <input type="date" class="form-control" id="start_date_filter"
                                        name="start_date_filter" value="{{ date('Y-m-d', strtotime('-1 week')) }}">
                                </div>
                                <div class="col">
                                    <label for="end_date_filter" style="display:block;">
                                        {{ trans('cruds.job.fields.end') }}</label>
                                    <input type="date" class="form-control" id="end_date_filter" name="end_date_filter"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                     
                            <div class="row mx-auto">
                                <div class="col">
                                <label for="paid_filter"
                                style="display:block;">{{ trans('cruds.job.fields.paid') }}</label> <select
                                class="form-control" style="width:100%;" id="paid" name="paid_filter">
                                <option value="1">{{ trans('global.free') }}</option>
                                <option value="2">{{ trans('global.paid') }}</option>

                            </select>
                                </div>
                                <div class="col">
                                <label for="rns_filter" style="display:block;"> {{ trans('cruds.job.fields.rns') }}</label>
                                <input type="text" class="form-control" width="10px;" id="rns" 
                                    name="rns_filter">
                                </div>
                            </div>
                        <div class="form-floating  mb-2">
                            <div class="col">
                                <label for="descriptions_filter" style="display:block;">
                                    {{ trans('cruds.job.fields.description') }}</label>
                                <input type="text" class="form-control" style="height:90px;" id="descriptions"
                                     name="descriptions_filter">
                            </div>
                        </div>
                        <div class="form-floating  mb-2">
                            <div class="col">
                                <label for="comments_filter" style="display:block;">
                                    {{ trans('cruds.job.fields.comments') }}</label>
                                <input type="text" class="form-control" style="height:90px;" id="comments"
                                     name="comments_filter">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('global.close') }}</button>
                            <button type="submit" class="btn btn-primary ">{{ trans('global.search') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="card-body ">
        <div class="table-responsive">

            <table class="table table-bordered table-hover datatable " id="example" style="text-align:center;">
                <thead class="table-auto ">
                    <tr>

                        <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch"><i
                                    class="fa fa-trash"></i></button></th>
                        <th><input id="filtr_nazw" class="form-control" /></th>
                        <th><input id="filtr_zadan" class="form-control" /></th>
                        <th><input id="filtr_zlecen" class="form-control" /></th>
                        <th><input id="filtr_firm" class="form-control" /></th>
                        <th><input id="filtr_pracownikow" class="form-control" /></th>
                        <th></th>
                        <th><input name="min" id="min" type="text" class="form-control"></th>
                        <th><input name="max" id="max" type="text" class="form-control"></th>
                        <th><input id="filtr_rns" class="form-control" /></th>
                        <th><input id="filtr_opisu" class="form-control" /></th>
                        <th><input id="filtr_uwagi" class="form-control" /></th>
                    </tr>
                    <tr>
                        <th >
                            {{ trans('cruds.company.fields.lp') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.task_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.task') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.performed') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.beginning') }}
                        </th>
                        <th >
                            {{ trans('cruds.job.fields.end') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.rns') }}
                        </th>
                        <th >
                            {{ trans('cruds.job.fields.description') }}
                        </th>
                        <th >
                            {{ trans('cruds.job.fields.comments') }}
                        </th>
                        <!-- <th>
                            {{ trans('cruds.company.fields.action') }}
                        </th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $key => $job)
                    <!-- ->unique('order') -->
                    <tr data-entry-id="{{ $job->id }}">
                        <td>

                        </td>
                        <td>
                         <?php
                          $order_querry="SRW/";
                          $pos = strpos($job->order, $order_querry);
                         ?>
                        
                            @if($pos === false)
                                <a class="text-success" href="{{ route('admin.jobs.edit', $job->id) }}">
                                {{ $job->type_task->name ?? '' }}
                            </a>                                
                                @else 
                                    <a class="text-info" href="{{ route('admin.ConfirmSystem.edit', $job->id) }}" class="nav-link">
                                {{ $job->type_task->name ?? '' }}
                            </a>                                
                            @endif

                        </td>
                        <td>

                            {{ $job->task_type->name ?? '' }}
                        </td>
                        <td>
                        @if($pos === false)
                            <a class="text-success" href="{{ route('admin.jobs.edit', $job->id) }}">
                                {{ $job->order ?? '' }}
                            </a>
                            @else 
                            <a class="text-info" href="{{ route('admin.ConfirmSystem.edit', $job->id) }}" class="nav-link">
                                {{ $job->order ?? '' }}
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $job->company -> kontrahent_kod ?? '' }}

                        </td>
                        <td>
                        <?php
                        $zmienna1=$job->user->name;
                        $zmienna2=$job->user->surname;
                        $firstLetter1 = substr($zmienna1, 0, 1);
                        $firstLetter2 = substr($zmienna2, 0, 1);
                        ?>
                            {{ $firstLetter1  ?? '' }}{{ $firstLetter2 ?? '' }}
                        </td>
                        <td style="font-weight:bold;">                           
                            @if(!(is_null($job->time)))
                            {{ date('G:i', strtotime($job->time)) }}
                            @else                            
                            @endif
                        </td>
                        <td>
                            <?php
                            $poczatek = $job->start_date.' ' .$job->start;
                            $koniec = $job->end_date.' ' .$job->end;
                            ?>
                            @if(!(is_null($job->time)))
                            {{ date('Y-m-d G:i', strtotime($poczatek)) }}
                            @else
                            {{ $job->start_date ?? '' }}
                            @endif
                           
                        </td>
                        <td>
                            @if(!(is_null($job->time)))
                            {{ date('Y-m-d G:i', strtotime($koniec)) }}
                            @else
                            {{ $job->end_date ?? '' }}
                            @endif


                        </td>
                        <td>
                            <p style="text-align:center;"> {{ $job->rns ?? '' }}
                            <p>
                        </td>
                        <td>
                            <div style="overflow-y: auto; max-height:100px;text-align:left;">
                                
                                @if(!(is_null($job->description)))
                                {{ $job->description ?? '' }}
                                @elseif(!(is_null($job->description_goods)))
                                {{ $job->description_goods ?? '' }}
                                @else
                                {{ $job->repeq->eq_number ?? '' }} {{ $job->repeq->eq_name ?? '' }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="overflow-y: auto; max-height:100px;text-align:left;">
                                {{ $job->comments ?? '' }}
                            </div>
                        </td>
                         <!-- <td>
                            @can('job_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.jobs.show', $job->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('job_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.jobs.edit', $job->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('job_delete')
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

                        </td>   -->

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade bd-example-modal-lg fade right" id="mediumModal" role="dialog"
        aria-labelledby="mediumModalLabel" aria-hidden="true">
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
</div>


@endsection

@section('scripts')

@parent
 
  
    <script>
   $(document).ready(function() {

var table =  $('#example').DataTable({
    "ordering": false,
    columnDefs: [ 
	{visible: false, targets: [11]},
	{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    },
],
    colReorder: true,
    stateSave: true,
    footerCallback: function ( row, data, start, end, display ) {
    var api = this.api(), data;
    var currentPosition = api.colReorder.transpose( 6 );
     pageTotal_Duration = api.column(currentPosition, { page: 'current'} ).data().reduce( function (a, b) {
        return moment.duration(a).asMilliseconds() + moment.duration(b).asMilliseconds();
    }, 0 );
       $( api.column(currentPosition).footer()).html(
        moment.utc(pageTotal_Duration).format("HH:mm")
    );
    
}

});

});  
</script>

<script>
    jQuery.fn.extend({
	printElem: function() {
		var cloned = this.clone();
    var printSection = $('#printSection');
    if (printSection.length == 0) {
    	printSection = $('<div id="printSection"></div>')
    	$('body').append(printSection);
    }
    printSection.append(cloned);
    var toggleBody = $('body *:visible');
    toggleBody.hide();
    $('#printSection, #printSection *').show();
    window.print();
    printSection.remove();
    toggleBody.show();
	}
});

$(document).ready(function(){
	$(document).on('click', '#btnPrint', function(){
  	$('.printMe').printElem();
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

    <script>
$(document).ready( function () {

var tableId = 'example', table;

function loadDataTable() {
    // Adjust any columnDef widths set by the user
    setUserColumnsDefWidths();  
    table = $('#' + tableId).DataTable({
        destroy: true,
        autoWidth: false,

        initComplete: function (settings) {            
            //Add JQueryUI resizable functionality to each th in the ScrollHead table
            $('#' + tableId + '_wrapper .dataTables_scrollHead thead th').resizable({
                handles: "e",
                alsoResize: '#' + tableId + '_wrapper .dataTables_scrollHead table', //Not essential but makes the resizing smoother
                stop: function () {
                    saveColumnSettings();
                    loadDataTable();
                }
            });
        },
    });

}


function setUserColumnsDefWidths() {

    var userColumnDef;
    // Get the settings for this table from localStorage
    var userColumnDefs = JSON.parse(localStorage.getItem(tableId)) || [];
    if (userColumnDefs.length === 0 ) return;
    columnDefs.forEach( function(columnDef) {
        // Check if there is a width specified for this column
        userColumnDef = userColumnDefs.find( function(column) {
            return column.targets === columnDef.targets;
        });
        // If there is, set the width of this columnDef in px
        if ( userColumnDef ) {
            columnDef.width = userColumnDef.width + 'px';
        }
    });
}


function saveColumnSettings() {

    var userColumnDefs = JSON.parse(localStorage.getItem(tableId)) || [];
    var width, header, existingSetting; 
    table.columns().every( function ( targets ) {
        // Check if there is a setting for this column in localStorage
        existingSetting = userColumnDefs.findIndex( function(column) { return column.targets === targets;});            
        // Get the width of this column
        header = this.header();
        width = $(header).width();
        if ( existingSetting !== -1 ) {
            // Update the width
            userColumnDefs[existingSetting].width = width;
        } else {
            // Add the width for this column
            userColumnDefs.push({
                targets: targets,
                width:  width,
            });
        }
    });
    // Save (or update) the settings in localStorage
    localStorage.setItem(tableId, JSON.stringify(userColumnDefs));
}
});
        </script>
        
<script>
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         if ($('#min').val() != '') {
           var min = new Date($('#min').val());
           console.log(min);
         } else {
           var min = null;
         }
         if ($('#max').val() != '') {
           var max = new Date($('#max').val());
           max.setHours(23);
         } else {
           var max = null;
         }
         var date = new Date( data[7] );
         console.log(date);
        
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );

$(document).ready(function() {
$('#example').DataTable();
minDate = new DateTime($('#min'), {
         format: 'YYYY-MM-DD'
        });
maxDate = new DateTime($('#max'), {
         format: 'YYYY-MM-DD'
        });
var table = $('#example').DataTable();

    $('#filtr_nazw').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_zadan').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_zlecen').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_firm').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_pracownikow').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_rns').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_opisu').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_uwagi').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#min, #max').on('change', function () {    
    table.draw();
    });
    $('#btnSearch').click(function (){
        table.columns([1,2,3,4,5,7,9,10,11]).search('').draw();
       });

 
});
</script>
@endsection 

