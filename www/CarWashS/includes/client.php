<!DOCTYPE html>
<html>
<head>
    <title>Car Wash Service</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
</head>
<body>
        <div id="navigation">
      <h1 class="sample">The Crew <b>Car Wash</b></h1>
      <ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="client.php" title="Data Here">Client</a></li>
    <li><a href="staff.php" title ="Data Here">Staff</a></li>
    </ul>
    </div>
        <div class="container">
            <section class="panel form-card">
                <h2>New Client</h2>
                <p class="muted">Add client details for the car wash.</p>
                <form method="post" action="insert_datas.php" class="client-form" novalidate>
                    <label>Client Name:</label>
                    <input type="text" name="client_name" required>

                    <label>Plate #:</label>
                    <input type="text" name="plate_number" required>

                    <label>Phone #:</label>
                    <input type="tel" name="phone_number" required>

                    <label>Vehicle Type:</label>
                    <input type="text" name="vehicle_type" required>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn primary">Save</button>
                        <button type="reset" class="btn ghost">Clear</button>
                    </div>
                </form>
            </section>

            <section class="panel table-card">
                <div class="table-header">
                    <h2>Client Records</h2>
                    <div class="table-actions"><input id="tableSearch" type="search" placeholder="Search..."></div>
                </div>

                <div class="table-wrap">


<?php
include("db_connect.php");

// Show Client Table with latest booking, service and staff (if any)
// We'll LEFT JOIN a subquery that gets the latest booking per client
$sql = "SELECT c.*, b.booking_id, b.scheduled_at, s.name AS service_name, st.staff_name AS handled_by
        FROM client c
        LEFT JOIN (
            SELECT * FROM bookings b1
            WHERE b1.booking_id = (
                SELECT booking_id FROM bookings b2 WHERE b2.client_id = b1.client_id ORDER BY b2.created_at DESC LIMIT 1
            )
        ) b ON b.client_id = c.client_id
        LEFT JOIN services s ON s.service_id = b.service_id
        LEFT JOIN staff st ON st.staff_id = b.staff_id
        ORDER BY c.client_id DESC";
$query = mysqli_query($conn, $sql);

mysqli_report(MYSQLI_REPORT_OFF);
if ($query && mysqli_num_rows($query) > 0) {
    echo "<table id=\"clientTable\" class=\"styled-table\">";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Plate</th><th>Phone</th><th>Vehicle</th><th>Service</th><th>Staff</th><th>Scheduled</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($query)) {
        $id = htmlspecialchars($row['client_id']);
        $name = htmlspecialchars($row['client_name']);
        $plate = htmlspecialchars($row['plate_number']);
        $phone = htmlspecialchars($row['phone_number']);
        $vehicle = htmlspecialchars($row['vehicle_type']);
        $service = isset($row['service_name']) ? htmlspecialchars($row['service_name']) : '-';
        $handled = isset($row['handled_by']) ? htmlspecialchars($row['handled_by']) : '-';
        $scheduled = isset($row['scheduled_at']) && $row['scheduled_at'] ? htmlspecialchars($row['scheduled_at']) : '-';
        echo "<tr data-id=\"$id\">";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$plate</td>";
        echo "<td>$phone</td>";
        echo "<td>$vehicle</td>";
        echo "<td>$service</td>";
        echo "<td>$handled</td>";
        echo "<td>$scheduled</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class=\"muted\">No client records found.</p>";
}
echo "</div>"; // close table-wrap
echo "</section></div>"; // close panel + container
mysqli_close($conn);
?>
<script src="carw.js"></script>
</body>
</html>