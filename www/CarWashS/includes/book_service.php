<?php
include('db_connect.php');

$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;
if ($client_id <= 0) {
    // Show client selection
    $clients = mysqli_query($conn, "SELECT * FROM client ORDER BY client_name");
    $client = null;
} else {
    $client = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM client WHERE client_id = " . $client_id));
    if (!$client) { echo "Client not found."; exit; }
}

$services = mysqli_query($conn, "SELECT * FROM services ORDER BY name");
$staff = mysqli_query($conn, "SELECT * FROM staff ORDER BY staff_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Service - The Crew Car Wash</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include 'navigation.php'; ?>

  <main class="main-content">
    <div class="dashboard-header">
      <div class="header-content">
        <h1>Book Service</h1>
        <p class="header-subtitle">Schedule a car wash service for your clients</p>
      </div>
    </div>

    <div class="container">
      <section class="panel form-card">
        <?php if ($client): ?>
          <h2>New Booking</h2>
          <div style="background: rgba(122, 208, 230, 0.1); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border-left: 4px solid var(--accent-2);">
            <p style="margin: 0;"><strong>Client:</strong> <?php echo htmlspecialchars($client['client_name']); ?></p>
            <p style="margin: 0.5rem 0 0 0;"><strong>Vehicle:</strong> <?php echo htmlspecialchars($client['plate_number']); ?> (<?php echo htmlspecialchars($client['vehicle_type']); ?>)</p>
          </div>

          <form method="post" action="insert_booking.php">
            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
            
            <label>Service</label>
            <select name="service_id" required style="width: 100%; padding: 0.6rem; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border); border-radius: 0.5rem; color: #eaf6f8; margin-top: 0.5rem;">
              <option value="">-- Select Service --</option>
              <?php 
              mysqli_data_seek($services, 0);
              while ($s = mysqli_fetch_assoc($services)) { 
                echo '<option value="'. $s['service_id'] .'">'.htmlspecialchars($s['name']).' — $'.number_format($s['price'],2).'</option>'; 
              } 
              ?>
            </select>

            <label>Assign Staff (Optional)</label>
            <select name="staff_id" style="width: 100%; padding: 0.6rem; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border); border-radius: 0.5rem; color: #eaf6f8; margin-top: 0.5rem;">
              <option value="">-- Any Available Staff --</option>
              <?php 
              mysqli_data_seek($staff, 0);
              while ($st = mysqli_fetch_assoc($staff)) { 
                echo '<option value="'.$st['staff_id'].'">'.htmlspecialchars($st['staff_name']).' ('.htmlspecialchars($st['role']).')</option>'; 
              } 
              ?>
            </select>

            <label>Schedule Date & Time</label>
            <input type="datetime-local" name="scheduled_at" required style="margin-top: 0.5rem;">

            <div class="form-actions">
              <button class="btn primary" type="submit">Book Service</button>
              <a href="client.php" class="btn ghost">Cancel</a>
            </div>
          </form>
        <?php else: ?>
          <h2>Select Client</h2>
          <p class="muted">Choose a client to book a service</p>
          <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem;">
            <?php 
            if (mysqli_num_rows($clients) > 0) {
              while ($c = mysqli_fetch_assoc($clients)) { 
                echo '<a href="?client_id='.$c['client_id'].'" class="quick-action-card" style="text-decoration: none;">
                  <div style="text-align: left;">
                    <strong>'.htmlspecialchars($c['client_name']).'</strong><br>
                    <small style="color: var(--muted);">'.htmlspecialchars($c['plate_number']).'</small><br>
                    <small style="color: var(--muted);">'.htmlspecialchars($c['vehicle_type']).'</small>
                  </div>
                </a>';
              }
            } else {
              echo '<p class="muted">No clients found. <a href="client.php">Create one first</a></p>';
            }
            ?>
          </div>
        <?php endif; ?>
      </section>
    </div>
  </main>

  <script src="carw.js"></script>
</body>
</html>
