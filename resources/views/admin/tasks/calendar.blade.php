@extends('layouts.admin2')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script type="text/javascript">
$(document).ready(function() {
    var SITEURL = "{{ url('/') }}";
    var clickedDate; // Deklaracja zmiennej clickedDate na poziomie globalnym

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        selectable: true,
        selectHelper: true,
        defaultView: 'agendaWeek',
        minTime: '08:00', // Początek przedziału godzinowego
        maxTime: '16:00', // Koniec przedziału godzinowego

        select: function(start, end, allDay) {
            $('#taskTitle').val('');
            $('#fk_company').val('').trigger('change');
            $('#taskModal').modal('show');
        },

        eventDrop: function(event) {
            var start = event.start.format("YYYY-MM-DD");
           
            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: start,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function(response) {
                    displayMessage("Pomyślnie edytowano zadanie");
                }
            });
        },

        eventClick: function(event) {
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
        },

        dayClick: function(date, jsEvent, view) {
            clickedDate = date.format("YYYY-MM-DD"); // Aktualizacja wartości zmiennej clickedDate
            $('#taskModal').data('clickedDate', clickedDate);
            $('#taskModal').modal('show');
        }
    });

    $('#addTaskBtn').on('click', function () {
        var title = $('#taskTitle').val();
        var fk_company = $('#fk_company').val();
        var start = clickedDate;
        var end = clickedDate;

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
                        allDay: true
                    };
                    calendar.fullCalendar('renderEvent', eventData, true);
                    calendar.fullCalendar('unselect');
                }
            });
            $('#taskModal').modal('hide');
        } else {
            alert("Uzupełnij reszte pól");
        }
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
});
</script>

@endsection
