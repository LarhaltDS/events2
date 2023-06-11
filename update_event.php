<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
$event_date = isset($_POST['event_date']) ? $_POST['event_date'] : '';
$event_time_begin = isset($_POST['event_time_begin']) ? $_POST['event_time_begin'] : '';
$event_time_end = isset($_POST['event_time_end']) ? $_POST['event_time_end'] : '';
$event_location = isset($_POST['event_location']) ? $_POST['event_location'] : '';
$event_description = isset($_POST['event_description']) ? $_POST['event_description'] : '';
$event_participants = isset($_POST['event_participants']) ? $_POST['event_participants'] : '';

// Imposta i valori di connessione al database
$servername = "localhost";
$username = "root";
$password = "Andrea.82";
$dbname = "events";

// Crea la connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Prepara la query di aggiornamento
$sql = "UPDATE events SET event_date='$event_date', event_time_begin='$event_time_begin', event_time_end='$event_time_end', event_location='$event_location', event_description='$event_description', event_participants='$event_participants' WHERE event_name='$event_name'";

// Esegue la query
if ($conn->query($sql) === TRUE) {
  $response = array();
$response['status'] = 'success';
$response['message'] = 'Evento aggiornato con successo';

echo json_encode($response);
} else {
    error_log("Errore nell'aggiornamento dell'evento: " . $conn->error, 3, "error_log.log");

  $response = array();
$response['status'] = 'error';
$response['message'] = 'Errore nell\'aggiornamento dell\'evento: ' . $conn->error;

echo json_encode($response);
}
// Chiude la connessione al database
$conn->close();

?>
