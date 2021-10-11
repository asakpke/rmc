<?php
session_start();

if (defined('HEADER_PHP_ROOT')) {
	return;
} else {
	define('HEADER_PHP_ROOT', true);
}

require 'function.php';
// require 'db.php';

// pr($current_company, '$current_company HEADER_PHP_ROOT');
// pr($_SESSION,'$_SESSION at db.php');
// pr($_SESSION['Current_Company'],'$_SESSION[Current_Company] at db.php');

// if (empty($current_company)) {
if (empty($_SESSION['Current_Company'])) {
	// header("Location: {$site_url}/company");
	die("Self die before {$site_url}/company on header.php");
	// exit(0);
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$_SESSION['Current_Company']['name'] //$current_company['name']?></title>
	<link rel="stylesheet" href="css/main.css?v2">
</head>
<body>
<header>
	<!-- <h1><?//=$_SERVER['HTTP_HOST']?></h1> -->
	<!-- LARGE_LOGO -->
	<h1>
		<!-- LARGE_LOGO -->
		<?//=$current_company['name']?>
		<a href="index.php"><?=$_SESSION['Current_Company']['name'] //$current_company['name']?></a>
	</h1>
	<!-- <hr> -->
	<nav>
		<a href="index.php">Home</a> |

		<?php if ($_SESSION['Current_Company']['subdomain_id'] == 0): ?>
			<a href="signup.php">Signup</a> |
		<?php endif; ?>

		<?php if ($_SESSION['Current_Company']['subdomain_id'] != 0): ?>
			<a href="signin.php">Signin</a> |
		<?php endif; ?>
	</nav>
	<!-- <hr> -->
</header>
<hr>