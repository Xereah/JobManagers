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

        select: function(start, end, allDay) {
            $('#taskTitle').val('');
            $('#fk_company').val('').trigger('change');
            $('#taskModal').modal('show');
        },

        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
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
            console.log("Clicked date:", clickedDate);
            $('#taskModal').data('clickedDate', clickedDate);
            $('#taskModal').modal('show');
        }
    });

    $('#addTaskBtn').on('click', function () {
        var title = $('#taskTitle').val();
        var company = $('#fk_company').val();
        var start = clickedDate;
        var end = clickedDate;

        if (title && company && start && end) {
            $.ajax({
                url: SITEURL + "/fullcalenderAjax",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    company: company,
                    type: 'add'
                },
                type: "POST",
                success: function (data) {
                    displayMessage("Event Created Successfully");
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
            alert("Please fill all the fields");
        }
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
});
</script>