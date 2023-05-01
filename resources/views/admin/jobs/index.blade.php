@extends('layouts.admin')
@section('content')
<style>
.dataTables_processing {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
<!-- Nagłówek -->
<div class="card">
    <div class="card-header bg-dark">
   {{ trans('global.list') }} {{ trans('cruds.job.title_plural') }} 

        @can('job_create')
        <!-- <a class="btn btn-dark float-right" data-attr="{{ route('admin.jobs.create') }}" ddata-toggle="modal" id="mediumButton" data-target="#mediumModal"><i -->
        <a class="btn btn-dark float-right" href="{{ route('admin.jobs.create') }}"><i
        class="fa fa-plus"></i>
            {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
        </a>
        <button type="button" class="btn btn-demo btn-dark btn-demo float-right" data-toggle="modal"
            data-target="#myModal2"><i class="fa fa-filter"></i> {{ trans('cruds.job.fields.filtrs') }} </button>
        @endcan

        <div class="form-check p-1 float-right"  id="filtr_platnosci">
            <input class="form-check-input" type="checkbox" id="paid-checkbox" value="2">
            <label class="form-check-label" for="paid-checkbox">{{ trans('cruds.job.fields.paid_singular') }}</label>
        </div>

        <div class="form float-right" style="margin-right: 2%; text-align: center;" >
    <select class="form-control" style="display: inline-block;" id="filtr_umow">
        <option value="">-------- {{ trans('cruds.job.fields.contracts') }} --------</option>
        @foreach($filter_contracts as $contracts)
        <option value="{{ $contracts ->id }}" style="text-align: center;">{{ $contracts-> contract_name }} </option>
        @endforeach
    </select>
</div>


    
   </div>

<!-- Filtry -->



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

<!-- Body -->
    <div class="card-body ">
        <div class="table-responsive" >
            <table class=" table yajra-datatable table-hover datatable" style="text-align:center;widht:100%;"
                id="example" >
                <thead >
                <tr>

                    <th> <button class="btn btn-danger" id="btnSearch" name="btnSearch">
                         <i class="fa fa-trash"></i></button></th>
                         <th><select class="form-control" id="filtr_nazw">
                        <option> </option>
                                @foreach($filter_typetask as $key => $filter_typetasks)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_typetasks }} </option>
                                @endforeach
                            </select></th>
                    <th><select class="form-control" id="filtr_zadan">
                        <option> </option>
                                @foreach($filter_tasktype as $key => $filter_tasktypes)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_tasktypes }} </option>
                                @endforeach
                            </select></th>
                    <th><input id="filtr_zlecen" class="form-control" /></th>
                    <th><select class="form-control select2"  id="filtr_firm" >
                        <option> </option>
                                @foreach($filter_company as $key => $filter_companys)
                               
                                <option value="{{$filter_companys->kontrahent_id}}">{{ $filter_companys->kontrahent_kod }} </option>
                                @endforeach
                            </select></th>
                    <th><select class="form-control"  id="filtr_pracownikow" >
                               <option> </option>
                                @foreach($filter_user as $key => $filter_users)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_users->name }} {{ $filter_users->surname }} </option>
                                @endforeach
                            </select></th>
                    <th></th>
                    <th><input name="min" id="min" type="date" class="form-control"></th>
                    <th><input name="max" id="max" type="date" class="form-control"></th>
                    <th><input id="filtr_rns" class="form-control" /></th>
                    <th><input id="filtr_opisu" class="form-control" /></th>
                    <th><input id="filtr_uwag" class="form-control" /></th>
                    <th></th>
        
                        <th></th>
                    </tr>

                    <tr >
                         <th style="width: 1%;" >
                            {{ trans('global.lp') }}
                        </th> 
                        <th style="width: 1%;" >
                            {{ trans('cruds.job.fields.task_name') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.task') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.order') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.company') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.performed') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.time') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.beginning') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.end') }}
                        </th>
                        <th style="width: 1%;">
                            {{ trans('cruds.job.fields.rns') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.description') }}
                        </th>
                        <th >
                            {{ trans('cruds.job.fields.comments') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.contracts') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
               
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
                        <th></th>
                        <th></th>
                       
                    </tr>
                </tfoot>
            </table>
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
</div>

@endsection

@section('scripts')

@parent

<script type="text/javascript">
  $(function () {
  
    
    var table = $('.yajra-datatable').DataTable({
        serverSide: true,
        paging: true,
        processing:true,
        language: {
        processing: '<i class="fa fa-spinner fa-spin fa-5x fa-fw"></i>'
                    },
                    
        orderClasses: false,
        responsive: true,
        deferRender: true,
        autoWidth: false,
        renderer: "bootstrap",
        colReorder:true,
        "orderable":false,
        search: {
            return: true,
        },
        stateSave: true,
        deferRender: true,
      
        ajax: "{{ route('admin.jobs.index') }}",
        columnDefs: [ {
                "targets": 6,
                "orderable": false,
                "searchable": false,
                },

                {
                "targets": [1,2,3,4,5, 7, 8, 9, 10,11,12,13],
                "orderable": false,
                },
                
                {visible: false, targets: [11,12,13]},
                {
                "orderable": false,
                "className": 'select-checkbox',
                "targets": 0
                 }, ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fk_typetask', name: 'fk_typetask'},
            {data: 'fk_tasktype', name: 'fk_tasktype'},
            {data: 'order', name: 'order'},
            {data: 'fk_company', name: 'fk_company'},
            {data: 'fk_user', name: 'fk_user'},
            {data: 'time', name:'time'},
            {data: 'start_date',name: 'start_date'},                
            {data: 'end_date',name: 'end_date'},               
            {data: 'rns', name: 'rns'},
            {data: 'description', name: 'description'}, 
            {data: 'comments', name: 'comments'},  
            {data: 'paid', name: 'paid'},  
            {data: 'fk_contract', name: 'fk_contract'},       
           
        ],
        initComplete: function () {
        var table = $('#example').DataTable();
        table.on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('.dataTables_processing').show();
            } else {
                $('.dataTables_processing').hide();
            }
        });
    },
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
    

    minDate = new DateTime($('#min').val(), {
    format: 'YYYY-MM-DD'
});
maxDate = new DateTime($('#max').val(), {
    format: 'YYYY-MM-DD'
});

var table = $('#example').DataTable();
    $('#btnSearch').click(function () {
    $('#filtr_nazw, #filtr_zadan, #filtr_zlecen, #filtr_firm, #filtr_pracownikow, #filtr_rns, #filtr_opisu, #filtr_uwag, #filtr_umow').val('');
    $('#min').val('').data('date', null);
    $('#max').val('').data('date', null);
    $('#filtr_firm').val(null).trigger('change');
    table.columns([1, 2, 3, 4, 5, 7, 9, 10, 11, 12, 13]).search('').draw();
    });
    $('#filtr_nazw').on( 'change', function () {      
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_zadan').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_zlecen').on('change', function () {
    table.columns($(this).parent().index() + ':visible').search('^' + this.value + '$', true, false).draw();
    } );
    $('#filtr_firm').on('change', function () {
    table.columns($(this).parent().index() + ':visible').search('^' + this.value + '$', true, false).draw();
    } );
    $('#filtr_pracownikow').on('change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_rns').on( 'change', function () {
        table.columns($(this).parent().index() + ':visible').search('^' + this.value + '$', true, false).draw();
    } );
    $('#filtr_opisu').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_uwag').on( 'change', function () {
    table.columns( $(this).parent().index()+':visible' ).search( this.value ).draw();
    } );
    $('#filtr_umow').on( 'change', function () {
        table.column(13).search( this.value ).draw();
    } );
    $('#filtr_platnosci input[type="checkbox"]').on('change', function () {
    var checkedBoxes = $('#filtr_platnosci input[type="checkbox"]:checked');
    var values = [];
    $.each(checkedBoxes, function (index, element) {
        values.push($(element).val());
    });
    table.column(12).search(values.join('|'), true, false).draw();
     });
    $('#min, #max').on('change', function () {
  var minDate = $('#min').val().split('/').reverse().join('-'); // Konwertuj datę minimalną na format "yyyy-mm-dd"
  var maxDate = $('#max').val().split('/').reverse().join('-'); // Konwertuj datę maksymalną na format "yyyy-mm-dd"
  var dates = [];

  // Iteruj po wszystkich datach między minimalną i maksymalną datą
  for (var d = new Date(minDate); d <= new Date(maxDate); d.setDate(d.getDate() + 1)) {
    var date = d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
    dates.push(date);
  }

  // Dodaj filtr po stronie serwera do parametrów wyszukiwania DataTables
  table.column(7).search(dates.join('|'), true, false).draw();
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

<!-- <script>
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

    </script> -->

@endsection