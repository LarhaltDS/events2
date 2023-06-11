<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "Andrea.82";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupero la data dalla richiesta POST
$date = $_POST['date'];

// Eseguo la query per ottenere le sale occupate per la data selezionata
$sql = "SELECT event_location FROM events WHERE event_date = '$date'";
$result = $conn->query($sql);

$occupiedRooms = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $occupiedRooms[] = $row['event_location'];
    }
}

// Chiudo la connessione al database
$conn->close();

// Restituisco i dati come un array JSON
$response = array('rooms' => $occupiedRooms);
echo json_encode($response);
