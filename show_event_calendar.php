<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.js"></script>
  <script src="js/show_event_script.js"></script>
  <link rel="stylesheet" href="css/show_event_calendar.css" />

</head>
<body>
  <div class="container">
    <div class="sidebar">
      <?php include 'menu.html'; ?>
    </div>
    <div class="content">
      <h1>CALENDARIO EVENTI</h1>
      <div class="wrapper">
        <div id="calendar"></div>
        <div class="occupied-rooms-container">
          <h3>Sale occupate:</h3>
          <ul id="occupied-rooms-list"></ul>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
