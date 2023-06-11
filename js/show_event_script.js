$(document).ready(function() {
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    events: function(start, end, timezone, callback) {
      $.ajax({
        url: "get_events.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
          var events = [];
          $.each(data, function(index, value) {
            events.push({
              id: value.id,
              title: value.client_name,
              start: value.event_date + " " + value.event_time_begin,
              end: value.event_date + " " + value.event_time_end,
              where: value.event_location,
              what: value.event_description,
              who: value.event_participants
            });
          });
          callback(events);
        }
      });
    },
    slotEventOverlap: false,
    timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
    eventRender: function(event, element) {
      element.attr('data-bs-toggle', 'popover');
      element.attr('data-bs-trigger', 'hover');
      element.attr('data-bs-placement', 'top');
      element.attr('data-bs-html', 'true');
      element.attr('data-bs-content', `
        <strong>Nome:</strong> ${event.title}<br>
        <hr>
        <strong>Luogo:</strong> ${event.where}<br>
        <strong>Dettagli:</strong> ${event.what}<br>
        <strong>Ora inizio:</strong> ${event.start.format('HH:mm')}<br>
        <strong>Ora fine:</strong> ${event.end.format('HH:mm')}
      `);
    },
    locale: 'it' // impostazione lingua
  });

  $(document).on('mouseenter', '.fc-event', function() {
    $('.fc-event').popover('hide');
    $(this).popover('show');
  });

  $(document).on('mouseleave', '.fc-event', function() {
    $(this).popover('hide');
  });

$(document).on("click", ".fc-day, .fc-day > *, .fc-day-top", function(e) {
	   console.log("Click sul giorno del calendario");
    var date = $(this).data('date');

    $.ajax({
      url: "get_occupied_rooms.php",
      type: "POST",
      data: { date: date },
      success: function(response) {
        console.log(response); // Stampa la risposta JSON per verificarne il formato

        try {
          var rooms = JSON.parse(response).rooms;

          if (rooms.length > 0) {
            var roomNames = rooms.map(function(room) {
              return "<li>" + room + "</li>";
            });

            $("#occupied-rooms-list").html(roomNames);
            $(".occupied-rooms").show();
          } else {
            // Nessuna sala occupata per questa data
            $("#occupied-rooms-list").html("<li>Nessuna sala occupata per questa data</li>");
            $(".occupied-rooms").show();
          }
        } catch (error) {
          console.error(error);
        }
      }
    });

    e.stopPropagation();
  });
});
