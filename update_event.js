//Cancella l'evento
$(document).on('click', '.fa-trash', function () {
var event_name = $(this).closest('tr').find('td:eq(0)').text();
if (confirm('Sei sicuro di voler eliminare l\'evento ' + event_name + '?')) {
    $.ajax({
        url: 'delete_event.php',
        type: 'post',
        data: {
            event_name: event_name
        },
        dataType: 'json',
        success: function (response) {
            if (response.status == 'success') {
                $(this).closest('tr').remove();
            } else {
                alert(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            
        }
    });
}
});



$(document).ready(function () {
$(document).on('click', '.fa-pencil-alt', function () {
    // Recupera i valori delle celle corrispondenti alla riga cliccata
    var event_name = $(this).closest('tr').find('td:eq(0)').text();
    var event_date = $(this).closest('tr').find('td:eq(1)').text();
    var event_time_begin = $(this).closest('tr').find('td:eq(2)').text();
    var event_time_end = $(this).closest('tr').find('td:eq(3)').text();
    var event_location = $(this).closest('tr').find('td:eq(4)').text();
    var event_description = $(this).closest('tr').find('td:eq(5)').text();
    var event_participants = $(this).closest('tr').find('td:eq(6)').text();

    // Mostra un modulo di modifica con i valori recuperati
    $('#editModal').find('input[name="event_name"]').val(event_name);
    $('#editModal').find('input[name="event_date"]').val(event_date);
    $('#editModal').find('input[name="event_time_begin"]').val(event_time_begin);
$('#editModal').find('input[name="event_time_end"]').val(event_time_end);
$('#editModal').find('input[name="event_location"]').val(event_location);
$('#editModal').find('textarea[name="event_description"]').val(event_description);
$('#editModal').find('input[name="event_participants"]').val(event_participants);
$('#editModal').modal('show');
});

$('#editModal').find('form').submit(function (e) {
e.preventDefault();

// Recupera i valori modificati dal modulo
var event_name = $(this).find('input[name="event_name"]').val();
var event_date = $(this).find('input[name="event_date"]').val();
var event_time_begin = $(this).find('input[name="event_time_begin"]').val();
var event_time_end = $(this).find('input[name="event_time_end"]').val();
var event_location = $(this).find('input[name="event_location"]').val();
var event_description = $(this).find('textarea[name="event_description"]').val();
var event_participants = $(this).find('input[name="event_participants"]').val();




// Invia i dati modificati al server tramite chiamata AJAX
$.ajax({
  url: 'update_event.php',
  type: 'post',
  data: {
    event_name: event_name,
    event_date: event_date,
    event_time_begin: event_time_begin,
    event_time_end: event_time_end,
    event_location: event_location,
    event_description: event_description,
    event_participants: event_participants
  },
  dataType: 'json',
  success: function (response) {
  console.log({
  event_name: event_name,
  event_date: event_date,
  event_time_begin: event_time_begin,
  event_time_end: event_time_end,
  event_location: event_location,
  event_description: event_description,
  event_participants: event_participants
  
});

  if (response.status == 'success') {
    // Aggiorna la riga corrispondente nella tabella con i nuovi valori
    var tr = $('td:contains("' + event_name.trim() + '")').closest('tr');
    tr.find('td:eq(0)').text(event_name);
    tr.find('td:eq(1)').text(event_date);
    tr.find('td:eq(2)').text(event_time_begin);
    tr.find('td:eq(3)').text(event_time_end);
    tr.find('td:eq(4)').text(event_location);
    tr.find('td:eq(5)').text(event_description);
    tr.find('td:eq(6)').text(event_participants);
    console.log(response);
  } else {
    alert(response.message);
  }
},
  error: function (jqXHR, textStatus, errorThrown) {
    console.error('Errore nella chiamata AJAX: ' + textStatus, errorThrown);
  }
});

// Chiudi la finestra modale
$('#editModal').modal('hide');
console.log();
});

});
