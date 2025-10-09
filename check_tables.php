<?php
$m = new mysqli('mysql','root','root','carwashservice_db');
$tables = ['services','bookings','payments'];
foreach ($tables as $t) {
  $r = $m->query("SHOW TABLES LIKE '$t'");
  echo "$t: " . ($r && $r->num_rows ? 'yes' : 'no') . "\n";
}
?>
