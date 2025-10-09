<!DOCTYPE html>
<html>
<head>
    <title>Car Wash Service</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
        <div id="navigation">
      <h1 class="sample">The Crew <b>Car Wash</b></h1>
      <ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="client.php" title="Data Here">Client</a></li>
    <li><a href="staff.php" title ="Data Here">Staff</a></li>
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

// Show Client Table
$sql = "SELECT * FROM client";
$query = mysqli_query($conn, $sql);

mysqli_report(MYSQLI_REPORT_OFF);
if ($query && mysqli_num_rows($query) > 0) {
    echo "<table id=\"clientTable\" class=\"styled-table\">";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Plate</th><th>Phone</th><th>Vehicle</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($query)) {
        $id = htmlspecialchars($row['client_id']);
        $name = htmlspecialchars($row['client_name']);
        $plate = htmlspecialchars($row['plate_number']);
        $phone = htmlspecialchars($row['phone_number']);
        $vehicle = htmlspecialchars($row['vehicle_type']);
        echo "<tr data-id=\"$id\">";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$plate</td>";
        echo "<td>$phone</td>";
        echo "<td>$vehicle</td>";
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
<script src="includes/carw.js"></script>
</body>
</html>