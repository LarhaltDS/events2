<?php
include 'menu.html';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="show_event_style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="update_event.js"></script>
  <script src="delete_event.js"></script>
</head>
<body>
<div class="container">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modifica evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="event_name">Nome evento</label>
              <input type="text" class="form-control" id="event_name" name="event_name">
            </div>
            <div class="form-group">
              <label for="event_date">Data evento</label>
              <input type="text" class="form-control" id="event_date" name="event_date">
            </div>
            <div class="form-group">
              <label for="event_time_begin">Ora inizio evento</label>
              <input type="text" class="form-control" id="event_time_begin" name="event_time_begin">
            </div>
            <div class="form-group">
              <label for="event_time_end">Ora fine evento</label>
              <input type="text" class="form-control" id="event_time_end" name="event_time_end">
            </div>
            <div class="form-group">
              <label for="event_location">Luogo evento</label>
              <input type="text" class="form-control" id="event_location" name="event_location">
            </div>
            <div class="form-group">
              <label for="event_description">Descrizione evento</label>
              <textarea class="form-control" id="event_description" name="event_description"></textarea>
            </div>
            <div class="form-group">
              <label for="event_participants">Numero di partecipanti</label>
              <input type="text" class="form-control" id="event_participants" name="event_participants">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
      </form>
    </div>
  </div>
  </div>

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

$sql = "SELECT DISTINCT client_name FROM events ORDER BY client_name ASC";
$result = $conn->query($sql);

echo '<form action="show_client_events.php" method="post">';
echo '<select name="client_name">';
echo '<option value="">--Seleziona un cliente--</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['client_name'] . '">' . $row['client_name'] . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Mostra eventi">';
echo '</form>';

if ($_POST) {
  $client_name = $_POST['client_name'];
  $sql = "SELECT event_name, event_date, event_time_begin, event_time_end, event_location, event_description, event_participants FROM events WHERE client_name='$client_name' ORDER BY event_date ASC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    setlocale(LC_ALL, 'it_IT.UTF-8');
    $currentMonth = "";
    echo "<table>";
    echo "<tr>";
    echo "<th>Nome evento</th>";
    echo "<th>Data evento</th>";
    echo "<th>Ora inizio evento</th>";
    echo "<th>Ora fine evento</th>";
    echo "<th>Luogo evento</th>";
    echo "<th>Descrizione evento</th>";
    echo "<th>Numero di partecipanti</th>";
    echo "<th>Azioni</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
      $month = strtoupper(strftime("%B", strtotime($row["event_date"])));

      if ($month != $currentMonth) {
        echo "<tr>";
        echo "<td colspan='8' style='text-align: center; font-weight: bold;'>" . $month . "</td>";
        echo "</tr>";
        $currentMonth = $month;
      }

      echo "<tr>";
      echo "<td>" . $row["event_name"] . "</td>";
      echo "<td>" . strftime("%a %d %b %Y", strtotime($row["event_date"])) . "</td>";
      echo "<td>" . date("H:i", strtotime($row["event_time_begin"])) . "</td>";
      echo "<td>" . date("H:i", strtotime($row["event_time_end"])) . "</td>";
      echo "<td>" . $row["event_location"] . "</td>";
      echo "<td>" . $row["event_description"] . "</td>";
      echo "<td>" . $row["event_participants"] . "</td>";
      echo "<td>";
      echo "<button class='btn btn-primary btn-sm edit-btn' data-toggle='modal' data-target='#editModal' data-id='" . $row["event_id"] . "'><i class='fas fa-edit'></i></button>";
      echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . $row["event_id"] . "'><i class='fas fa-trash'></i></button>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<p>Nessun evento trovato per il cliente selezionato.</p>";
  }
}

$conn->close();
?>
</div>
</body>
</html>
