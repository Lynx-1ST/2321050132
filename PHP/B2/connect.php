<?php
$servername = "localhost";
$username = "root";
$password = "loc.1005";
$port = 3306;
$database = "quan_ly_web_phim2";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>