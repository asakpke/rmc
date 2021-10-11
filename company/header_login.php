<?php
session_start();

// pr($_SESSION,'$_SESSION');
// pr($_SESSION['Company_Login']['id'],'$_SESSION[Company_Login][id]');

if (defined('HEADER_PHP_COMPANY')) {
	return;
} else {
	define('HEADER_PHP_COMPANY', true);
}

// pr($_SESSION['Company_Login']['id'],'$_SESSION[Company_Login][id]');

require '../function.php';
// require 'db.php';
// pr($_SESSION,'$_SESSION');
// pr($_SESSION['Company_Login']['id'],'$_SESSION[Company_Login][id]');

if (empty($_SESSION['Company_Login']['id'])) {
	// $_SESSION['page_msg'] = 'Unauthorized access please signin';
	// header("Location: {$site_url}/company/signin.php");
	header("Location: {$site_domain}");
	exit(0);
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RoshanTech RMC</title>
	<link rel="stylesheet" href="../css/main.css?v1">
</head>
<body>
<header>
	<!-- <h1><?//=$_SERVER['HTTP_HOST']?></h1> -->
	<!-- LARGE_LOGO -->
	<h1>
		<!-- LARGE_LOGO -->
		<?//=$current_company['name']?>
		<a href="dashboard.php">RoshanTech</a>
	</h1>
	<nav>
		<a href="dashboard.php">Dashboard</a> |
		<a href="logout.php">Logout</a>
	</nav>

</header>
<hr>