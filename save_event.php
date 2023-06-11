<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
    padding: 20px;
  }

  h1 {
    font-size: 36px;
    margin-bottom: 20px;
  }

  a {
    display: inline-block;
    margin: 20px;
    padding: 10px 20px;
    background-color: lightblue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }
</style>

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

$client_name = $_POST["client_name"];
if ($client_name === "new_client_name") {
  $client_name = $_POST["new_client_name"];
}
$event_name = $_POST["event_name"];
$event_date = $_POST["event_date"];
$event_time_b = $_POST["event_time_begin"];
$event_time_e = $_POST["event_time_end"];
$event_location = $_POST["event_location"];
$event_description = $_POST["event_description"];
$event_participants = $_POST["event_participants"];
$beamer = isset($_POST['beamer']) ? 1 : 0;
$beamerPrice = !empty($_POST['beamer_price']) ? $_POST['beamer_price'] : NULL;
$audioSystem = isset($_POST['audio_system']) ? 1 : 0;
$audioSystemPrice = !empty($_POST['audio_price']) ? $_POST['audio_price'] : NULL;
$microphone = isset($_POST['microphone']) ? 1 : 0;
$microphonePrice = !empty($_POST['microphone_price']) ? $_POST['microphone_price'] : NULL;
$maintenanceService = isset($_POST['maintenance_service']) ? 1 : 0;
$maintenanceServicePrice = !empty($_POST['maintenance_service_price']) ? $_POST['maintenance_service_price'] : NULL;

$sql = "INSERT INTO events (event_name, event_date, event_time_begin, event_time_end, event_location, event_description, event_participants, client_name, beamer, beamer_price, audio_system, audio_price, microphone, microphone_price, maintenance_service, maintenance_service_price) 
VALUES ('$event_name', '$event_date', '$event_time_b', '$event_time_e', '$event_location', '$event_description', '$event_participants', '$client_name', $beamer, " . (isset($_POST['beamer_price']) && $_POST['beamer_price'] != '' ? $_POST['beamer_price'] : 'NULL') . ", $audioSystem, " . (isset($_POST['audio_price']) && $_POST['audio_price'] != '' ? $_POST['audio_price'] : 'NULL') . ", $microphone, " . (isset($_POST['microphone_price']) && $_POST['microphone_price'] != '' ? $_POST['microphone_price'] : 'NULL') . ", $maintenanceService, " . (isset($_POST['maintenance_service_price']) && $_POST['maintenance_service_price'] != '' ? $_POST['maintenance_service_price'] : 'NULL') . ")";

echo $sql;

if ($conn->query($sql) === TRUE) {
  echo "Evento salvato con successo<br>";
  echo "<a href='new_event.php'>Inserisci un nuovo evento</a><br>";
  echo "<a href='show_client_events.php'>Visualizza eventi cliente</a>";
} else {
  echo "Errore: " . $sql . "<br>" . $conn->error;
}

?>
