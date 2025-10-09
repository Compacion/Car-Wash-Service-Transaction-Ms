<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Car Wash Service — Clients</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="navigation">
        <h1 class="sample">The Crew <b>Car Wash</b></h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a class="active" href="client.php">Client</a></li>
                <li><a href="staff.php">Staff</a></li>
            </ul>
        </nav>
    </header>

    <main class="app">
        <section class="panel form-card">
            <h2>New Client</h2>
            <p class="muted">Add a client record for the car wash.</p>
            <form id="clientForm" method="post" action="insert_datas.php" novalidate>
                <label for="client_name">Client Name</label>
                <input id="client_name" name="client_name" type="text" required>

                <label for="plate_number">Plate Number</label>
                <input id="plate_number" name="plate_number" type="text" required>

                <label for="phone_number">Phone Number</label>
                <input id="phone_number" name="phone_number" type="text" inputmode="tel" placeholder="09XXXXXXXXX" required>

                <label for="vehicle_type">Vehicle Type</label>
                <input id="vehicle_type" name="vehicle_type" type="text" required>

                <div class="form-actions">
                    <button type="submit" class="btn primary">Save</button>
                    <button type="reset" class="btn ghost">Clear</button>
                </div>
            </form>
        </section>

        <section class="panel table-card">
            <div class="table-header">
                <h2>Client Records</h2>
                <div class="table-actions">
                    <input id="tableSearch" type="search" placeholder="Search by name, plate or phone...">
                </div>
            </div>

            <?php
            include("db_connect.php");
            $sql = "SELECT * FROM client ORDER BY client_id DESC";
            $query = mysqli_query($conn, $sql);
            if ($query && mysqli_num_rows($query) > 0) {
                    echo "<div class=\"table-wrap\"><table id=\"clientTable\" class=\"styled-table\">";
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
                    echo "</tbody></table></div>";
            } else {
                    echo "<p class=\"muted\">No client records yet.</p>";
            }
            mysqli_close($conn);
            ?>
        </section>
    </main>

    <script src="carw.js"></script>
</body>
</html>