<?php
include('db_connect.php');

$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;
if ($client_id <= 0) {
    echo "Invalid client id."; exit;
}

$client = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM client WHERE client_id = " . $client_id));
if (!$client) { echo "Client not found."; exit; }

$services = mysqli_query($conn, "SELECT * FROM services ORDER BY name");
$staff = mysqli_query($conn, "SELECT * FROM staff ORDER BY staff_name");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Book service for <?php echo htmlspecialchars($client['client_name']); ?></title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="navigation"><h1 class="sample">Book Service</h1></div>
  <div class="container">
    <section class="panel form-card">
      <h2>Client</h2>
      <p><?php echo htmlspecialchars($client['client_name']); ?> — <?php echo htmlspecialchars($client['plate_number']); ?></p>
      <form method="post" action="insert_booking.php">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <label>Service</label>
        <select name="service_id" required>
          <?php while ($s = mysqli_fetch_assoc($services)) { echo '<option value="'. $s['service_id'] .'">'.htmlspecialchars($s['name']).' — '.number_format($s['price'],2).'</option>'; } ?>
        </select>

        <label>Staff</label>
        <select name="staff_id">
          <option value="">-- any --</option>
          <?php while ($st = mysqli_fetch_assoc($staff)) { echo '<option value="'.$st['staff_id'].'">'.htmlspecialchars($st['staff_name']).'</option>'; } ?>
        </select>

        <label>Schedule</label>
        <input type="datetime-local" name="scheduled_at">

        <div class="form-actions"><button class="btn primary" type="submit">Book</button></div>
      </form>
    </section>
  </div>
</body>
</html>
