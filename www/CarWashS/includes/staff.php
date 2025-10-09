<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Staff Management</title>
  <link rel="stylesheet" href="styles.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <div id="navigation">
    <h1 class="sample">The Crew <b>Car Wash</b></h1>
    <ul>
      <li><a href="homepage.php">Home</a></li>
      <li><a href="client.php">Client</a></li>
      <li><a class="active" href="staff.php">Staff</a></li>
    </ul>
  </div>

  <div class="container">
    <section class="panel form-card">
      <h2>New Staff</h2>
      <form method="post" action="insert_staff.php" class="staff-form">
        <label>Staff Name</label>
        <input type="text" name="staff_name" required>

        <label>Role</label>
        <input type="text" name="role" placeholder="e.g., washer, cashier">

        <label>Phone</label>
        <input type="tel" name="phone">

        <div class="form-actions">
          <button class="btn primary" type="submit">Add</button>
          <button class="btn ghost" type="reset">Clear</button>
        </div>
      </form>
    </section>

    <section class="panel table-card">
      <div class="table-header">
        <h2>Staff List</h2>
        <div class="table-actions"><input id="tableSearch" type="search" placeholder="Search staff..."></div>
      </div>
      <div class="table-wrap">
      <?php
      include('db_connect.php');
      // Show staff with booking count and last handled booking time
      $sql = "SELECT st.staff_id, st.staff_name, st.role, st.phone,
                     COUNT(b.booking_id) AS bookings_handled,
                     MAX(b.scheduled_at) AS last_handled
              FROM staff st
              LEFT JOIN bookings b ON b.staff_id = st.staff_id
              GROUP BY st.staff_id
              ORDER BY st.staff_id DESC";
      $res = mysqli_query($conn, $sql);
      if ($res && mysqli_num_rows($res) > 0) {
        echo "<table id=\"staffTable\" class=\"styled-table\">";
        echo "<thead><tr><th>ID</th><th>Name</th><th>Role</th><th>Phone</th><th>Bookings</th><th>Last Handled</th></tr></thead><tbody>";
        while ($r = mysqli_fetch_assoc($res)) {
          $id = htmlspecialchars($r['staff_id']);
          $name = htmlspecialchars($r['staff_name']);
          $role = htmlspecialchars($r['role']);
          $phone = htmlspecialchars($r['phone']);
          $count = intval($r['bookings_handled']);
          $last = $r['last_handled'] ? htmlspecialchars($r['last_handled']) : '-';
          echo "<tr><td>$id</td><td>$name</td><td>$role</td><td>$phone</td><td>$count</td><td>$last</td></tr>";
        }
        echo "</tbody></table>";
      } else {
        echo "<p class=\"muted\">No staff records yet.</p>";
      }
      mysqli_close($conn);
      ?>
      </div>
    </section>
  </div>

  <script src="carw.js"></script>
</body>
</html>
