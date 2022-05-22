<?php

$host = "109.234.162.106";
$dbname = "naal3419_pres487";
$user = "naal3419_pres487";
$pass = "7[I)78npS1";
$port = "";

$mysqli= mysqli_connect ("localhost", "naal3419_pres487", "7[I)78npS1", "naal3419_pres487");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>