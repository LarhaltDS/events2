<?php
  // Connect to the database
  $conn = mysqli_connect("localhost", "username", "password", "database");

  // Check the connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Get the selected extra services and their prices
$beamer = isset($_POST['event_extra_services_projector']) ? 1 : 0;
$beamerPrice = isset($_POST['beamer_price']) ? $_POST['beamer_price'] : 0;
$audioSystem = isset($_POST['event_extra_services_audio_system']) ? 1 : 0;
$audioSystemPrice = isset($_POST['event_extra_services_audio_system_price']) ? $_POST['event_extra_services_audio_system_price'] : 0;
$microphone = isset($_POST['event_extra_services_microphones']) ? 1 : 0;
$microphonePrice = isset($_POST['event_extra_services_microphones_price']) ? $_POST['event_extra_services_microphones_price'] : 0;
$maintenanceService = isset($_POST['event_extra_services_maintenance']) ? 1 : 0;
$maintenanceServicePrice = isset($_POST['event_extra_services_maintenance_price']) ? $_POST['event_extra_services_maintenance_price'] : 0;


  // Insert the extra services and their prices into the database
  $sql = "UPDATE events SET beamer='$beamer', beamer_price='$beamerPrice', audio_system='$audioSystem', audio_price='$audioSystemPrice', microphone='$microphone', microphone_price='$microphonePrice', maintenance_service='$maintenanceService', maintenance_service_price='$maintenanceServicePrice' WHERE id=$event_id";

  if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }

  mysqli_close($conn);
?>

