<?php include 'menu.html';?>
<html>
    <head>
		<link rel="stylesheet" href="new_event_style.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		</head>
<body>
<form action="save_event.php" method="post">
  <h1>AGGIUNGI UN NUOVO EVENTO</h1>
    <label for="event_name">Nome evento:</label>
    <input type="text" id="event_name" name="event_name" required><br><br>
    <label for="event_date">Data dell'evento:</label>
    <input type="date" id="event_date" name="event_date" required><br><br>
    <label for="event_time_begin">Ora inizio evento:</label><input type="time" id="event_time_begin" name="event_time_begin" required><br><br>
	<label for="event_time_end">Ora fine evento:</label><input type="time" id="event_time_end" name="event_time_end" required><br><br>
    
  
    <div class="form-group">
  <label for="event_location">Luogo evento</label>
  <select class="form-control" id="event_location" name="event_location">
    <option value="">--Seleziona una sala--</option>
    <option value="Sala Scilla (Ristorante Sala 1)">Sala Scilla (Ristorante Sala 1)</option>
    <option value="Sala Cariddi (Ristorante Sala 2)">Sala Cariddi (Ristorante Sala 2)</option>
    <option value="Sala Itaca (Ristorante Sala 3)">Sala Itaca (Ristorante Sala 3)</option>
    <option value="Sala Scilla+Cariddi (1+2)">Sala Scilla+Cariddi (1+2)</option>
    <option value="Sala Scilla+Cariddi+Itaca (1+2+3)">Sala Scilla+Cariddi+Itaca (1+2+3)</option>
    <option value="Sala Impero">Sala Impero</option>
    <option value="Sala Impero+4AB">Sala Impero+4AB</option>
    <option value="Sala Farnese">Sala Farnese</option>
    <option value="Sala 4A">Sala 4A</option>
    <option value="Sala 4A+4B">Sala 4A+4B</option>
    <option value="Sala 4B">Sala 4B</option>
    <option value="Sala 5A">Sala 5A</option>
    <option value="Sala 5A+5B">Sala 5A+5B</option>
    <option value="Sala 5A+5B+5C">Sala 5A+5B+5C</option>
    <option value="Sala 5B">Sala 5B</option>
    <option value="Sala 5B+5C">Sala 5B+5C</option>
    <option value="Sala 5C">Sala 5C</option>
  </select>
</div>

  
    <label for="event_description">Descrizione evento:</label><br>
    <textarea id="event_description" name="event_description" required></textarea><br><br>
<!--Servizi Accessori-->
<label for="event_extra_services">Servizi extra:</label>
<input type="checkbox" id="event_extra_services" name="event_extra_services">
  <div >
    <div class="services-container">
        <input type="checkbox" id="beamer" name="beamer">    
        <label for="beamer">Proiettore:</label>
        <label for="beamer_price">€</label>
        <input type="text" class="right-aligned-input" id="beamer_price" name="beamer_price" pattern="[0-9]+([\.,][0-9]+)?" style="width:150px;">
    </div> 
    <div class="services-container">
        <input type="checkbox" id="audio_system" name="audio_system">
        <label for="audio_system">Impianto audio:</label>
		<label for="audio_price">€</label>
        <input type="text" class="right-aligned-input" id="audio_price" name="audio_price" pattern="[0-9]+([\.,][0-9]+)?" style="width:150px;">
      </div>
      <div class="services-container">
        <input type="checkbox" id="microphone" name="microphone">  
        <label for="microphone">Microfoni:</label>
		<label for="microphone_price">€</label>
        <input type="text" class="right-aligned-input" id="microphone_price" name="microphone_price" pattern="[0-9]+([\.,][0-9]+)?" style="width:150px;">
     </div>
     <div class="services-container">
        <input type="checkbox" id="maintenance_service" name="maintenance_service"> 
        <label for="maintenance_service">Servizio manutentore:</label>
		<label for="maintenance_service_price">€</label>
        <input type="text" class="right-aligned-input" id="maintenance_service_price" name="maintenance_service_price" pattern="[0-9]+([\.,][0-9]+)?" style="width:150px;">
     </div> 
  </div>
</div>

    <label for="event_participants">Numero di partecipanti:</label>
    <input type="number" id="event_participants" name="event_participants" required><br><br>
	<label for="client_name">Nome cliente:</label>
<select id="client_name" name="client_name" required>
  <option value="">--Seleziona un cliente--</option>
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

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['client_name'].'">'.$row['client_name'].'</option>';
      }
    } else {
      echo '<option value="">Nessun cliente presente nel database</option>';
    }
    $conn->close();
  ?>
  <option value="new_client_name">Aggiungi Nuovo</option>
</select><br><br>

<div id="add_new_client" style="display:none;">
  <label for="new_client_name">Nome nuovo cliente:</label>
  <input type="text" id="new_client_name" name="new_client_name">
</div>
<input type="submit" value="Salva">
</form>

<script>
document.getElementById("client_name").addEventListener("change", function() {
  if(this.value === "new_client_name") {
    document.getElementById("add_new_client").style.display = "block";
  } else {
    document.getElementById("add_new_client").style.display = "none";
  }
});
</script>

</body>
</html>
