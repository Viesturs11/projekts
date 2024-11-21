<?php 

require("constants.php");

$mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if ($mysqli -> connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>

