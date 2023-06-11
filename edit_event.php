<?php
$servername = "localhost";
$username = "root";
$password = "Andrea.82";
$dbname = "events";

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Verifica se la richiesta è stata effettuata con metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recupera i dati dall'array $_POST
  $event_id = $_POST["event_id"];
  $event_name = $_POST["event_name"];
  $event_date = $_POST["event_date"];
  $event_time_begin = $_POST["event_time_begin"];
  $event_time_end = $_POST["event_time_end"];
  $event_location = $_POST["event_location"];
  $event_description = $_POST["event_description"];
  $event_participants = $_POST["event_participants"];

  // Prepara la query per l'aggiornamento dell'evento
  $stmt = $conn->prepare("UPDATE events SET event_name=?, event_date=?, event_time_begin=?, event_time_end=?, event_location=?, event_description=?, event_participants=? WHERE event_id=?");
  $stmt->bind_param("ssssssii", $event_name, $event_date, $event_time_begin, $event_time_end, $event_location, $event_description, $event_participants, $event_id);

  // Esegue la query
  if ($stmt->execute() === TRUE) {
    echo "Evento aggiornato con successo";
  } else {
    echo "Errore nell'aggiornamento dell'evento: " . $conn->error;
  }

  // Chiude la connessione al database
  $conn->close();
}
?>
