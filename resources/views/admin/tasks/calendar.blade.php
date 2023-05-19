@extends('layouts.admin2')
<style>
  #calendar {
    background-color: #f2f2f2;
  }
  
</style>
@section('content')

<div class="container">
    <div id='calendar'></div>
</div>
<div class="modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Dodaj zadanie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="taskTitle">Tytuł zadania:</label>
                    <input type="text" class="form-control" id="taskTitle" placeholder="Tytuł zadania">
                </div>
                <div class="form-group">
                    <label for="companySelect">Wybierz kontrahenta:</label>
                    <select name="fk_company" id="fk_company" class="form-control select2" required>
                        
                        @foreach($companies as $company)
                        <option value="{{ $company->kontrahent_id }}">{{ $company -> kontrahent_kod }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addTaskBtn">Dodaj zadanie</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="button" class="btn btn-danger" id="deleteEventBtn">Usuń</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@parent
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/pl.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script type="text/javascript">
$(document).ready(function() {
    var SITEURL = "{{ url('/') }}";
    var clickedDate;

    $.fullCalendar.locale('pl');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        backgroundColor: 'red',
        slotDuration: '00:20:00',
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        selectable: true,
        selectHelper: true,
        hiddenDays: [0, 6],
        columnFormat: 'dddd',
        defaultView: 'agendaWeek',
        minTime: '08:00',
        maxTime: '16:00',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        views: {
            settimana: {
                type: 'agendaWeek',
                duration: {
                    days: 7
                },
                title: 'Apertura',
                columnFormat: 'dddd',
                hiddenDays: [0, 6]
            }
        },
        defaultView: 'settimana',

        select: function(start, end, allDay) {
            $('#taskTitle').val('');
            $('#fk_company').val('').trigger('change');
            $('#taskModal').modal('show');
        },

        eventDrop: function(event) {
            var start = event.start.format("Y-MM-DD HH:mm:ss");
            var end = event.end.format("Y-MM-DD HH:mm:ss");

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: end,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function(response) {
                    displayMessage("Pomyślnie edytowano zadanie");
                }
            });
        },

        eventResize: function(event, delta)
        {
            var start = event.start.format("Y-MM-DD HH:mm:ss");
            var end = event.end.format("Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick: function(event) {
            $('#deleteEventBtn').data('event', event); // Przekazanie informacji o wydarzeniu do przycisku Delete w modalu

            $('#deleteEventBtn').on('click', function() {
                var event = $(this).data('event');
                var deleteMsg = confirm("Naprawdę chcesz usunąć wpis?");

                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            id: event.id,
                            type: 'delete'
                        },
                        success: function(response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage("Wpis pomyślnie usunięty");
                        }
                    });
                }

                $('#taskModal').modal('hide');
            });

            // Pozostała część kodu...
            
            $('#taskModal').modal('show');
        },

        dayClick: function(date, jsEvent, view) {
            clickedDate = date.format("YYYY-MM-DD HH:mm:ss");
            endDateTime = date.clone().add(20, 'minutes').format("YYYY-MM-DD HH:mm:ss"); // Dodaj 20 minut do daty początkowej, aby uzyskać datę końcową
            $('#taskModal').data('clickedDate', clickedDate);
            $('#taskModal').data('endDateTime', endDateTime); // Przekaż datę końcową do modala
            $('#taskModal').modal('show');
        }
    });

    $('#addTaskBtn').on('click', function () {
        var title = $('#taskTitle').val();
        var fk_company = $('#fk_company').val();
        var start = clickedDate;
        var end = endDateTime;

        if (title && fk_company && start && end) {
            $.ajax({
                url: SITEURL + "/fullcalenderAjax",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    fk_company: fk_company,
                    type: 'add'
                },
                type: "POST",
                success: function (data) {
                    displayMessage("Pomyślnie dodano zadanie");
                    var eventData = {
                        id: data.id,
                        title: title,
                        start: start,
                        end: end,
                        allDay: false
                    };
                    calendar.fullCalendar('renderEvent', eventData, true);
                    calendar.fullCalendar('unselect');
                    $('#taskModal').modal('hide');
                    calendar.fullCalendar('refetchEvents');
                }
            });
        } else {
            alert("Uzupełnij wszystkie pola");
        }
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
});
</script>



@endsection
