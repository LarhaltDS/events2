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

$sql = "SELECT DISTINCT client_name FROM events";
$result = $conn->query($sql);

echo '<form action="show_client_events.php" method="post">';
echo '<select name="client_name">';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['client_name'] . '">' . $row['client_name'] . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Mostra eventi">';
echo '</form>';

if ($_POST) {
  $client_name = $_POST['client_name'];
  $sql = "SELECT event_name, event_date, event_location, event_description, event_participants FROM events WHERE client_name='$client_name'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Nome evento</th>";
    echo "<th>Data evento</th>";
    echo "<th>Luogo evento</th>";
    echo "<th>Descrizione evento</th>";
    echo "<th>Numero di partecipanti</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["event_name"] . "</td>";
        echo "<td>" . $row["event_date"] . "</td>";
        echo "<td>" . $row["event_location"] . "</td>";
        echo "<td>" . $row["event_description"] . "</td>";
        echo "<td>" . $row["event_participants"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "Nessun evento trovato per il cliente selezionato";
  }
}

$conn->close();

?>
