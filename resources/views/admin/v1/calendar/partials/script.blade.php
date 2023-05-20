
<!-- jQuery -->
<script src="{{ asset('adminka/v1/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('adminka/v1/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('adminka/v1/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminka/v1/dist/js/adminlte.min.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('adminka/v1/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminka/v1/plugins/fullcalendar/main.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminka/v1/dist/js/demo.js') }}"></script>
<script src="{{ asset('adminka/v1/js/add_event.js') }}"></script>

<!-- Page specific script -->
<script>
    let drop_id;
    document.addEventListener('DOMContentLoaded', function() {
        $(function () {
            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {
                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()), // use the element's text as the event title
                        id: $.trim($(this).text()) // use the element's text as the event title
                    }
                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })
                })
            }
            ini_events($('#external-events div.external-event'))
            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        id: eventEl.getAttribute('data-calendar-id'),
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });
            var calendar_events =@json($calendar_events);
            console.log(calendar_events);
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title,id',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: calendar_events,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                    var event_id = info.draggedEl.getAttribute('data-event-id');
                    var data = info.dateStr;
                    //const url = '/admin/v1/page/calendar';
                    const url = '/api/v1/calendar';
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'post',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            date: data,
                            event_id: event_id,
                            _token: token
                        })
                    }).then(function (response) {
                        return response.text();
                    }).then(function (text) {
                        let response_db = JSON.parse(text);
                        let calendar_id_db = response_db.data.id;
                        console.log(response_db.data.id);
                        info.draggedEl.setAttribute('data-calendar-id', calendar_id_db);
                        calendar.render('renderEvent', {id: calendar_id_db}, true);
                        drop_id = calendar_id_db;
                        //calendar.refetchEvents();
                        calendar.render();
                        console.log(calendar.getEvents());

                    }).then((data) => {
                    }).catch(function (error) {
                        console.log(error);
                    });
                    calendar.render();

                },
                eventDidMount: function (info) {
                    console.log("info.event.id_eventDidMount = " + info.event.id);
                     info.el.setAttribute("data-event-id", info.event.id);
                     info.el.setAttribute("data-calendar-id", info.event.id);
                },
                eventDrop: function (info) {
                    var start_date = moment(info.event.start).format('YYYY-MM-DD');
                    //console.log(start_date);
                    console.log(info);
                    console.log(info.event.parentNode);

                    let calendar_id;
                    if(info.event.id === true){
                        console.log("info.event.id_eventDrop_not_null = " + info.event.id);
                        calendar_id = info.event.id;
                    }else if(drop_id){
                        console.log("drop_id_not_undefined = " + drop_id);
                        calendar_id = drop_id;
                    }else if(info.el.getAttribute('data-calendar-id')){
                        console.log("data-calendar-id_not_undefined = " + info.el.getAttribute('data-calendar-id'));
                        calendar_id = info.el.getAttribute('data-calendar-id');
                    }
                    //let url = '/admin/v1/page/calendar/update/' + calendar_id;
                    let url = '/api/v1/calendar/' + calendar_id;
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'put',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            date: start_date,
                            _token: token
                        })
                    }).then(function (response) {
                        return response.text();
                    }).then(function (text) {
                        let response_db = JSON.parse(text);
                        let calendar_id_db = response_db.data.id;
                         console.log("response_db.calendar_id_update = " + calendar_id_db);
                         //info.el.setAttribute('data-calendar-id', calendar_id_db);
                    }).then((data) => {
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            });
            calendar.render();

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()

                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }
                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)

                let add_event_id = add_event(event.text(val), currColor);
                let event_id;
                console.log(add_event_id);
                add_event_id.then(function (val) {
                    event_id = val;
                    event.attr('id', 'event-' + event_id);
                    event.attr('data-event-id', event_id);
                    // console.log('add_event_id = ' + event_id);
                });
                    $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
        });
</script>
