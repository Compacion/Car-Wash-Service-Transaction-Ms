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
    </div>
    <br><br><br>

<form method="post" action="insert_datas.php" class="table-s">
    <h2 style= "text-align: center;">Form</h2>

    <label>Client Name:</label>
    <input type="text" name="client_name" required><br><br>

    <label>Plate #:</label>
    <input type="text" name="plate_number" required><br><br>

    <label>Phone #:</label>
    <input type="text" name="phone_number" required><br><br>

    <label>Vehicle Type:</label>
    <input type="text" name="vehicle_type" required><br><br>

    <input type="submit" name="submit" value="Save">
</form>
<br><br><br>

<hr>


<?php
include("db_connect.php");

// Show Client Table
$sql = "SELECT * FROM client";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    echo "<table border='1'>";
    echo "<tr><th colspan='5'>Client Table</th></tr>";
    echo "<tr><th>ID</th><th>Name</th><th>Plate Number</th><th>Phone Number</th><th>Vehicle Type</th></tr>";
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>".$row["client_id"]."</td>";
        echo "<td>".$row["client_name"]."</td>";
        echo "<td>".$row["plate_number"]."</td>";
        echo "<td>".$row["phone_number"]."</td>";
        echo "<td>".$row["vehicle_type"]."</td>";
        echo "</tr>";
    }
    echo "</table><br>";
}
mysqli_close($conn);
?>
</body>
</html>