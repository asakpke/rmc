<?php
require 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("<h1>Connection failed: " . $conn->connect_error . '</h1>');
}

// echo "<h1>Connected successfully</h1>";