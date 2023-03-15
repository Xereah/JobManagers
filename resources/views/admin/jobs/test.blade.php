@extends('layouts.admin3')
@section('content')
<div class="card">
    <div class="card-header bg-dark">
        {{ trans('cruds.job.title_singular') }} {{ trans('global.list') }}

        @can('job_create')

        <a class="btn btn-dark float-right" data-attr="{{ route('admin.jobs.create') }}" ddata-toggle="modal" id="mediumButton" data-target="#mediumModal"><i
                class="fa fa-plus"></i>
            {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
        </a>
@endcan
    </div>
    <div class="card-body ">
        <div class="table-responsive" >
            <table class=" table yajra-datatable table-striped table-hover datatable datatable-Job display "
                id="example" >
                <thead >
                    <tr>
                        <!-- <th width="10">
                            {{ trans('cruds.company.fields.lp') }}
                        </th> -->
                        <th width="10%;" >
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
                        <th>
                            {{ trans('cruds.job.fields.end') }}
                        </th>
                        <th width="3%;">
                            {{ trans('cruds.job.fields.rns') }}
                        </th>
                        <th width="35%;">
                            {{ trans('cruds.job.fields.description') }}
                        </th>
                        <!-- <th>
                            {{ trans('cruds.company.fields.action') }}
                        </th> -->
                    </tr>
                </thead>
                <tbody>
               
                </tbody>
                <tfoot>
            <tr>
                <th><input id="filter_tasktype" class="form-control" /></th>
                <th><select class="form-control" id="filter_typetask">
                        <option> </option>
                                @foreach($filter_tasktype as $key => $filter_tasktypes)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_tasktypes }} </option>
                                @endforeach
                            </select></th>
             
                <th><input class="form-control"  id="filter_order" /></th>
                <th><select class="form-control "  id="filter_company" >
                        <option> </option>
                                @foreach($filter_company as $key => $filter_companys)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_companys }} </option>
                                @endforeach
                            </select></th>
                <th><select class="form-control"  id="filter_user" >
                               <option> </option>
                                @foreach($filter_user as $key => $filter_users)
                                <?php
                                    $key =$key+1;
                                ?>
                                <option value="{{$key}}">{{ $filter_users->name }} {{ $filter_users->surname }} </option>
                                @endforeach
                            </select></th>
                <th></th>
                <th><input name="min" id="min" type="text"  class="form-control"></th>
                <th><input name="max" id="max" type="text"  class="form-control"></th>
                <th><input id="filter_rns"  class="form-control" /></th>
                <th><input id="filter_decription" class="form-control" /></th>
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
        orderClasses: false,
        responsive: true,
        deferRender: true,
        renderer: "bootstrap",
        colReorder:true,
       
        search: {
            return: true,
        },
        stateSave: true,
        deferRender: true,
      
        ajax: "{{ url('test') }}",
        columnDefs: [ {
                "targets": 5,
                "orderable": false,
                "searchable": false,
                } ],
        columns: [
            {data: 'fk_typetask', name: 'fk_typetask'},
            {data: 'fk_tasktype', name: 'fk_tasktype'},
            {data: 'order', name: 'order'},
            {data: 'fk_company', name: 'fk_company'},
            {data: 'fk_user', name: 'fk_user'},
            { data: null,
                render: function (data, type, row) {
                var duration = moment.duration(moment(data.end, "HH:mm").diff(moment(data.start, "HH:mm")));
                //return duration.get("hours") +":"+ duration.get("minutes") +":"+ duration.get("seconds");
                return moment.utc(duration.asMilliseconds()).format("HH:mm");
                }  
            },
            {data: 'start_date',name: 'start_date'},                
            {data: 'end_date',name: 'end_date'},               
            {data: 'rns', name: 'rns'},
            {data: 'description', name: 'description'},          
           
        ],
        
    });

    $('#filter_tasktype').on( 'keyup', function () {      
    table.columns(0).search( this.value ).draw();
    } );
    $('#filter_typetask').on('change', function () {
    table.columns(1).search( this.value ).draw();
    } );
    $('#filter_order').on('keyup', function () {
    table.columns(2).search( this.value ).draw();
    } );
    $('#filter_company').on('change', function () {
    table.columns(3).search( this.value ).draw();
    } );
    $('#filter_user').on('change', function () {
    table.columns(4).search( this.value ).draw();
    } );
    $('#filter_decription').on( 'keyup', function () {
    table.columns(9).search( this.value ).draw();
    } );
    $('#filter_rns').on( 'keyup', function () {
    table.columns(8).search( this.value ).draw();
    } );
 
    
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
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         if ($('#min').val() != '') {
           var min = new Date($('#min').val());
         } else {
           var min = null;
         }
         if ($('#max').val() != '') {
           var max = new Date($('#max').val());
         } else {
           var max = null;
         }
         var date = new Date( data[6] );
  
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
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'YYYY-MM-DD'
        });
        maxDate = new DateTime($('#max'), {
         format: 'YYYY-MM-DD'
        });
  
     // DataTables initialisation
     var table = $('#example').DataTable();
  
     // Refilter the table
   // Refilter the table
   $('#min, #max').on('change', function () {
      
       table.columns(6).draw();
    });

 });
    </script>







   

    


@endsection