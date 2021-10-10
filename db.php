<?php
require 'config.php';

// Create connection
// $conn = new mysqli($servername, $username, $password);
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("<h1>Connection failed: " . $conn->connect_error . '</h1>');
}

// echo "<h1>Connected successfully</h1>";

// pr($_SERVER['HTTP_HOST'],'$_SERVER[HTTP_HOST]');

// $sql = 'SELECT 
// 		user.name
// 	FROM subdomain
// 	INNER JOIN user ON user.id = subdomain.user_id
// 	WHERE subdomain.name = "'.$_SERVER['HTTP_HOST'].'" 
// ';
// $sql = 'SELECT user.name
// 	FROM subdomain
// 	INNER JOIN user ON user.id = subdomain.user_id
// 	WHERE subdomain.name = ?
// ';
$sql = 'SELECT user.name
	FROM subdomain
	INNER JOIN user ON user.subdomain_id = subdomain.id
	WHERE subdomain.name = ?
		AND subdomain.status = "Active"
		AND user.status = "Active"
		AND user.type = "Company"
';
// $sql = 'SELECT user.name
// 	FROM subdomain
// 	INNER JOIN user ON user.subdomain_id = subdomain.id
// 	WHERE subdomain.name = ?
// 		AND subdomain.status = "Active"
// 		AND user.status = "Active"
// 		AND (user.type = "Company"
// 			OR user.type = "Master"
// 		)
// ';
// echo '<pre>'; print_r($sql); echo '</pre>';
// $result = $conn->query($sql);
// echo '<pre>'; print_r($result); echo '</pre>';
// pr($sql,'$sql');
$stmt = $conn->prepare($sql);
// echo '<pre>'; print_r($stmt); echo '</pre>';
$stmt->bind_param("s", $_SERVER['HTTP_HOST']); // i - integer, d - double, s - string, b - BLOB
// echo '<pre>'; print_r($stmt); echo '</pre>';
$stmt->execute();
// echo '<pre>'; print_r($stmt); echo '</pre>';
$result = $stmt->get_result();
// echo '<pre>'; print_r($result); echo '</pre>';
// pr($result,'$result');
$stmt->close();

$current_company = null;

// if ($result->num_rows > 0) {
if ($result->num_rows == 1) {
// if ($stmt->num_rows == 1) {
  // while($row = $result->fetch_assoc()) {
	$current_company = $result->fetch_assoc();
	// $current_company = $stmt->fetch_assoc();
	// echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	// echo '<pre>'; print_r($row); echo '</pre>';
	// echo '<h1>$current_company '.count($current_company).'</h1><pre>'; print_r($current_company); echo '</pre>';
	// pr($current_company,'$current_company');
  // }
}
else {
  // echo "0 results";
	// die('Invalid company');
	header("Location: company/");
	exit(0);  
}

// $conn->close();