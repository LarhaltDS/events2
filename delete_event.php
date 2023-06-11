<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$event_name = $_POST['event_name'];

// Seleziona l'evento dal database
$sql = "SELECT id FROM events WHERE event_name='$event_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $event_id = $row['id'];

  // Prepara la query di eliminazione dell'evento specifico
  $sql = "DELETE FROM events WHERE id='$event_id'";

  // Esegue la query di eliminazione
  if ($conn->query($sql) === TRUE) {
    $response = array();
    $response['status'] = 'success';
    $response['message'] = 'Evento eliminato con successo';
  } else {
    $response = array();
    $response['status'] = 'error';
    $response['message'] = 'Errore nell\'eliminazione dell\'evento: ' . $conn->error;
  }
} else {
  $response = array();
  $response['status'] = 'error';
  $response['message'] = 'Evento non trovato';
}

// Restituisci la risposta come JSON
echo json_encode($response);

// Chiude la connessione al database
$conn->close();

};
?>