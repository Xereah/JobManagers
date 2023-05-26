@extends('layouts.admin2')
<style>
#calendar {
    background-color: #f2f2f2;
}

.fc-slats tbody tr {
    height: 35px;
    color: black;
}

.fc-slats tbody tr[data-time="16:00"],
.fc-slats tbody tr[data-time="17:00"],
.fc-slats tbody tr[data-time="18:00"],
.fc-slats tbody tr[data-time="19:00"],
.fc-slats tbody tr[data-time="20:00"],
.fc-slats tbody tr[data-time="21:00"],
.fc-slats tbody tr[data-time="22:00"],
.fc-slats tbody tr[data-time="23:00"] {
    display: none;
}
.modal-header{
    background-color:#f2f2f5;
}
.fc-recurring-event {
    position: absolute;
    top: 2px;
    right: 5px;
    font-weight: bold;

 
    font-size: 10px;
    padding: 2px 4px;
    border-radius: 3px;
}
</style>

@section('content')

<div id='calendar'></div>

<div class="modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Dodaj zadanie</h5>
                <div class="text-right ml-auto">
                    <select name="category_color" id="category_color" class="form-control text-center">
                        <option value="">Kategoria</option>
                        <option value="#008000" style="background-color:#008000;color:black;">Na miejscu</option>
                        <option value="#FFFF00" style="background-color:#FFFF00;color:black;">Inne</option>
                        <option value="#800080" style="background-color:#800080;color:black;">Urlop</option>
                        <option value="#FF0000" style="background-color:#FF0000;color:black;">Ważne</option>
                        <option value="#0000FF" style="background-color:#0000FF;color:black;">Zdalne</option>
                        <option value="#FFA500" style="background-color:#FFA500;color:black;">Wyjazd</option>
                    </select>

                </div>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="taskTitle">Temat:</label>
                    <input type="text" class="form-control" autocomplete="off" id="taskTitle">
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label for="companySelect">Kontrahent:</label>
                        <select name="fk_company" id="fk_company" class="form-control select2" required>
                            @foreach($companies as $company)
                            <option value="{{ $company->kontrahent_id }}">{{ $company->kontrahent_kod }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm">
                        <label for="taskDateTime">Czas rozpoczęcia:</label>
                        <input type="datetime-local" class="form-control" id="taskDateTime"
                            placeholder="Wybierz datę i godzinę">
                    </div>
                    <div class="col-sm">
                        <label for="taskDateTime">Czas zakończenia:</label>
                        <input type="datetime-local" class="form-control" id="taskDateTimeEnd"
                            placeholder="Wybierz datę i godzinę">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="taskTitle">Treść:</label>
                    <textarea class="form-control" name="description" id="description" autocomplete="off" required
                        rows="5"></textarea>
                </div>
                <label for="taskRecurring">Zadanie cykliczne:</label>
                <input type="checkbox" id="taskRecurring"  autocomplete="off">
                <div id="recurringOptions" style="display: none;">
                    <label for="taskFrequency">Częstotliwość:</label>
                    <select id="taskFrequency">
                        <option value="daily">Codziennie</option>
                        <option value="weekly">Co tydzień</option>
                        <option value="monthly">Co miesiąc</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addTaskBtn">Zapisz</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/pl.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script>
$(document).ready(function() {
    var SITEURL = "{{ url('/') }}";
    var clickedDate;
    var endDateTime;
    var clickedDateTime;
    var clickedEvent;

    $.fullCalendar.locale('pl');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Funkcja pobierająca listę kontrahentów z serwera
    function fetchContractors() {

        var companyId = $('#fk_company').val(); // Get the selected company ID

        $.ajax({
            url: SITEURL + '/fetchContractors/' +
                companyId, // Pass the company ID as a parameter in the URL
            type: 'GET',
            success: function(response) {
                var contractors = response;

                // Clear existing options in the select field
                $('#fk_company').empty();

                // Add new options to the select field
                for (var i = 0; i < contractors.length; i++) {
                    var contractor = contractors[i];
                    $('#fk_company').append('<option value="' + contractor.id + '">' + contractor
                        .name + '</option>');
                }
            }
        });
    }
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        slotDuration: '00:20:00',
        events: SITEURL + "/fullcalender",
        displayEventTime: true,
        selectable: true,
        selectHelper: true,
        hiddenDays: [0, 6],
        slotEventOverlap: false,
        columnFormat: 'DD.MM dddd',
        defaultView: 'agendaWeek',
        minTime: '08:00',
        maxTime: '17:00',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,list'
        },
        views: {
            settimana: {
                type: 'agendaWeek',
            }
        },
        defaultView: 'settimana',

        eventRender: function(event, element) {
             if (event.recurring) {
                element.find('.fc-title').prepend('<span class="fc-recurring-event">[C]</span>');
            }
            element.css('background-color', event.category_color);
            element.css('color', 'black');
        },


        select: function(start, end, allDay) {
            var taskDateTime = start.format("Y-MM-DD HH:mm");
            var taskDateTimeEnd = end.format("Y-MM-DD HH:mm");

            $('#taskDateTime').val(taskDateTime);
            $('#taskDateTimeEnd').val(taskDateTimeEnd);
            $('#taskTitle').val('');
            $('#description').val('');
            $('#category_color').val('');
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
                    fk_company: event.fk_company,
                    description: event.description,
                    category_color: event.category_color,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function(response) {
                    displayMessage("Pomyślnie edytowano zadanie");
                }
            });
        },

        eventResize: function(event, delta) {
            var start = event.start.format("Y-MM-DD HH:mm:ss");
            var end = event.end.format("Y-MM-DD HH:mm:ss");
            var title = event.title;
            var fk_company = event.fk_company;
            var category_color = event.category_color;
            var description = event.description;
            var id = event.id;
            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                type: "POST",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    fk_company: fk_company,
                    description: description,
                    category_color: category_color,                  
                    id: id,
                    type: 'update'
                },
                success: function(response) {
                    calendar.fullCalendar('refetchEvents');
                    displayMessage(
                        "Pomyślnie zaktualizowano wydarzenie");
                }
            })
        },

        eventClick: function(event) {
            clickedEvent = event;
            var eventDateTime = moment(event.start).format("Y-MM-DD HH:mm");
            var eventDateTimeEnd = moment(event.end).format("Y-MM-DD HH:mm");
            clickedDateTime = eventDateTime;
            clickedDateTimeEnd = eventDateTimeEnd;
            $('#taskDateTime').val(clickedDateTime);
            $('#taskDateTimeEnd').val(clickedDateTimeEnd);
            $('#taskTitle').val(event.title);
            $('#description').val(event.description);
            $('#category_color').val(event.category_color);
            $('#fk_company').val(event.fk_company).trigger('change');
            $('#deleteEventBtn').data('event', event);

            fetchContractors();

            $('#deleteEventBtn').off('click').on('click', function() {
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

            $('#addTaskBtn').off('click').on('click', function() {
                var taskTitle = $('#taskTitle').val();
                var fkCompany = $('#fk_company').val();
                var desc = $('#description').val();
                var color = $('#category_color').val();
                var taskDateTime = $('#taskDateTime').val();
                var taskDateTimeEnd = $('#taskDateTimeEnd').val();

                if (clickedEvent) {
                    clickedEvent.title = taskTitle;
                    clickedEvent.fk_company = fkCompany;
                    clickedEvent.start = taskDateTime;
                    clickedEvent.end = taskDateTimeEnd;
                    clickedEvent.description = desc;
                    clickedEvent.category_color = color;

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            id: clickedEvent.id,
                            title: taskTitle,
                            start: taskDateTime,
                            end: taskDateTimeEnd,
                            fk_company: fkCompany,
                            description: desc,
                            category_color: color,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            calendar.fullCalendar('updateEvent', clickedEvent);
                            displayMessage(
                                "Pomyślnie zaktualizowano wydarzenie");
                        }
                    });
                } else {
                    var newEvent = {
                        title: taskTitle,
                        fk_company: fkCompany,
                        description: desc,
                        category_color: color,
                        start: taskDateTime,
                        end: taskDateTimeEnd
                    };

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: taskTitle,
                            start: taskDateTime,
                            end: taskDateTimeEnd,
                            fk_company: fkCompany,
                            category_color: color,
                            description: desc,
                            type: 'add'
                        },
                        type: "POST",
                        success: function(response) {
                            newEvent.id = response.event_id;
                            calendar.fullCalendar('renderEvent', newEvent);
                            displayMessage("Pomyślnie dodano wydarzenie");
                        }
                    });
                }

                $('#taskModal').modal('hide');
            });

            $('#taskModal').modal('show');
        },

        dayClick: function(date, jsEvent, view) {
            var taskDateTime = date.format("Y-MM-DD HH:mm");
            var taskDateTimeEnd = date.format("Y-MM-DD HH:mm");
            $('#taskDateTime').val(taskDateTime);
            $('#taskDateTimeEnd').val(taskDateTimeEnd);
            $('#taskTitle').val('');
            $('#description').val('');
            $('#category_color').val('');
            $('#fk_company').val('').trigger('change');
            $('#taskModal').modal('show');
        }
    });

    $('#addTaskBtn').click(function() {
        var taskTitle = $('#taskTitle').val();
    var fk_company = $('#fk_company').val();
    var description = $('#description').val();
    var taskDateTime = moment($('#taskDateTime').val(), 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm:ss');
    var taskDateTimeEnd = moment($('#taskDateTimeEnd').val(), 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm:ss');
    var category_color = $('#category_color').val();
    var recurring = $('#taskRecurring').is(':checked');
    var recurringFrequency = $('#taskFrequency').val();

    if (!recurring) {
        $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: taskTitle,
                start: taskDateTime,
                end: taskDateTimeEnd,
                description: description,
                category_color: category_color,
                fk_company: fk_company,
                recurring: 0,
                type: 'add'
            },
            type: "POST",
            success: function(response) {
                $('#taskModal').modal('hide');
                calendar.fullCalendar('refetchEvents');
                displayMessage("Pomyślnie dodano wydarzenie");
            }
        });
    }
   else if (recurringFrequency === 'daily')  {
        for (var i = 1; i <= 30; i++) {
         var start = moment(taskDateTime, 'Y-MM-DD HH:mm').add(i, 'days').format('Y-MM-DD HH:mm');
         var end = moment(taskDateTimeEnd, 'Y-MM-DD HH:mm').add(i, 'days').format('Y-MM-DD HH:mm');
        $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: taskTitle,
                start: start,
                end: end,
                description: description,
                category_color: category_color,
                fk_company: fk_company,
                recurring:1,
                type: 'add'
            },
        
            type: "POST",
            success: function(response) {
                $('#taskModal').modal('hide');
                calendar.fullCalendar('refetchEvents');
                displayMessage("Pomyślnie dodano wydarzenie");
            }
        });
    }
}

else if (recurringFrequency === 'weekly') {
    // Add weekly recurring events
    for (var i = 0; i <= 3; i++) { // Dodawanie co tydzień przez 4 tygodnie
        var start = moment(taskDateTime, 'Y-MM-DD HH:mm').add(i, 'weeks').format('Y-MM-DD HH:mm');
        var end = moment(taskDateTimeEnd, 'Y-MM-DD HH:mm').add(i, 'weeks').format('Y-MM-DD HH:mm');
        $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: taskTitle,
                start: start,
                end: end,
                description: description,
                category_color: category_color,
                fk_company: fk_company,
                recurring:1,
                type: 'add'
            },
            type: "POST",
            success: function(response) {
                $('#taskModal').modal('hide');
                calendar.fullCalendar('refetchEvents');
                displayMessage("Pomyślnie dodano wydarzenie");
            }
        });
    }
}

else if (recurringFrequency === 'monthly') {
    var startDate = moment(taskDateTime, 'Y-MM-DD HH:mm'); // Początkowa data
    // Add monthly recurring events
    for (var i = 0; i <= 11; i++) { // Dodawanie co miesiąc przez 4 miesiące
        var start = startDate.clone().add(i, 'months').format('Y-MM-DD HH:mm');
        var end = startDate.clone().add(i, 'months').add(1, 'hour').format('Y-MM-DD HH:mm');
        $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            data: {
                title: taskTitle,
                start: start,
                end: end,
                description: description,
                category_color: category_color,
                fk_company: fk_company,
                recurring:1,
                type: 'add'
            },
            type: "POST",
            success: function(response) {
                $('#taskModal').modal('hide');
                calendar.fullCalendar('refetchEvents');
                displayMessage("Pomyślnie dodano wydarzenie");
            }
        });
    }
}


});
    function displayMessage(message) {
        toastr.success(message, 'Sukces');
    }

    $('#taskRecurring').change(function() {
            if ($(this).is(':checked')) {
                $('#recurringOptions').show();
            } else {
                $('#recurringOptions').hide();
            }
        });
});
</script>
@endsection