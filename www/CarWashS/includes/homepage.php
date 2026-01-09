<?php
// Services records page (homepage replacement)
include 'db_connect.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Service Records</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header id="navigation" class="site-header">
  <div class="nav-inner">
    <h1 class="site-title">The Crew <b class="brand">Car Wash</b></h1>
    
      <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="mainNav" aria-label="Toggle navigation">
        <span class="hamburger" aria-expanded="true"></span>
      </button>

    <nav id="mainNav" class="main-nav" aria-label="Main navigation">
      <ul>
        <li><a href="homepage.php">Services</a></li>
        <li><a href="client.php">Client</a></li>
        <li><a href="staff.php">Staff</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="container.services">
  <section class="panel table-card">
    <div class="table-header">
      <h2>Service Records</h2>
      <div class="table-actions">
        <input id="tableSearch" type="search" placeholder="Search services...">
      </div>
    </div>
    <div class="table-wrap">
<?php
$sql = "SELECT service_id, name, price, description FROM services ORDER BY service_id DESC";
$res = mysqli_query($conn, $sql);
if ($res && mysqli_num_rows($res) > 0) {
  echo "<table class=\"styled-table\"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th></tr></thead><tbody>";
  while ($row = mysqli_fetch_assoc($res)) {
    $id = htmlspecialchars($row['service_id']);
    $name = htmlspecialchars($row['name']);
    $price = htmlspecialchars($row['price']);
    $desc = htmlspecialchars($row['description']);
    echo "<tr><td>$id</td><td>$name</td><td>$price</td><td>$desc</td></tr>";
  }
  echo "</tbody></table>";
} else {
  echo "<p class=\"muted\">No services found.</p>";
}
?>
    </div>
  </section>

  <section class="panel dashboard-card">
    <div class="table-header">
      <h2>Dashboard Overview</h2>
      <div class="table-actions"><a class="btn ghost" href="client.php">Manage Clients</a> <a class="btn ghost" href="homepage.php">Services</a> <a class="btn ghost" href="staff.php">Staff</a> <a class="btn ghost" href="bookings.php">Bookings</a> <a class="btn ghost" href="payment_list.php">Payments</a></div>
    </div>
    <div class="table-wrap dashboard-grid">
<?php
$tables = ['client' => 'Clients', 'services' => 'Services', 'staff' => 'Staff', 'bookings' => 'Bookings', 'payments' => 'Payments'];
foreach ($tables as $tbl => $label) {
  $r = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM `$tbl`");
  $c = $r ? mysqli_fetch_assoc($r)['cnt'] : 0;
  echo "<div class=\"dash-tile\"><h3>$label</h3><p class=\"big\">".intval($c)."</p></div>";
}
?>
    </div>
  </section>

