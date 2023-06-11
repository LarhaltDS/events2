
$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "delete_event.php",
    data: {event_name: event_name},
    success: function(response) {
      response = JSON.parse(response);
      if (response.status === "success") {
        // Ricarica la pagina
        location.reload();
      } else {
        // Mostra un messaggio di errore
        alert(response.message);
      }
    }
  });
});

