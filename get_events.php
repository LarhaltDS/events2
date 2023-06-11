

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

  $query = "SELECT * FROM events";
  $result = mysqli_query($conn, $query);

  $events = array();

  while($row = mysqli_fetch_assoc($result)) {
    $event = array();
    $event['id'] = $row['id'];
    $event["client_name"] = $row['client_name'];
    $event['event_date'] = $row['event_date'];
    $event['event_time_begin'] = $row['event_time_begin'];
    $event['event_time_end'] = $row['event_time_end'];
    $event['event_location'] = $row['event_location'];
    $event['event_description'] = $row['event_description'];
    $event['event_participants'] = $row['event_participants'];
    array_push($events, $event);
  }


  echo json_encode($events);

  // Verifica risultato query
  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }

  mysqli_close($conn);
?>
