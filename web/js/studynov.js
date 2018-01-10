$(document).ready(function() {

    $('#calendar').fullCalendar({
        events: [
            {
                title  : 'event1',
                start  : '2018-01-02'
            },
            {
                title  : 'event2',
                start  : '2018-01-05',
                end    : '2018-01-07'
            },
            {
                title  : 'event3',
                start  : '2018-01-29T12:30:00',
                allDay : false // will make the time show
            }
        ]
    });

});