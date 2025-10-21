<?php
include('db_connect.php');
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if (!$booking_id) { echo 'Invalid booking id'; exit; }
$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT b.*, c.client_name, s.name AS service_name, s.price FROM bookings b JOIN client c ON b.client_id=c.client_id JOIN services s ON b.service_id=s.service_id WHERE b.booking_id=".$booking_id));
if (!$booking) { echo 'Booking not found'; exit; }
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payment</title><link rel="stylesheet" href="styles.css"></head>
<body>
  <div id="navigation"><h1 class="sample">Payment</h1></div>
  <div class="container" style="align-items: center; justify-content: center; display: flex; height: 50vh;">
    <section class="panel form-card">
      <h2>Payment for Booking #<?php echo $booking_id; ?></h2>
      <p>Client: <?php echo htmlspecialchars($booking['client_name']); ?></p>
      <p>Service: <?php echo htmlspecialchars($booking['service_name']); ?> — <?php echo number_format($booking['price'],2); ?></p>
      <form method="post" action="insert_payment.php">
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <label>Amount</label>
        <input type="number" name="amount" value="<?php echo number_format($booking['price'],2); ?>">
        <label>Method</label>
        <select name="method"><option value="cash">Cash</option><option value="card">Card</option></select>
        <div class="form-actions"><button class="btn primary" type="submit">Pay</button></div>
      </form>
    </section>
  </div>
</body>
</html>
