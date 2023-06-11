<?php
$selectedClient = ""; // Inizializza la variabile per il cliente selezionato

if (isset($_POST['client_name'])) {
  $selectedClient = $_POST['client_name'];
} elseif (isset($_GET['client_name'])) {
  $selectedClient = $_GET['client_name'];
}

$clientColor = ""; // Inizializza la variabile per il colore del cliente

if (!empty($selectedClient)) {
  $sql = "SELECT client_color FROM events WHERE client_name = '$selectedClient' LIMIT 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $clientColor = $row['client_color'];
  }
}
?>
