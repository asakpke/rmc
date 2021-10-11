<?php
session_start();

if (defined('HEADER_PHP_COMPANY')) {
	return;
} else {
	define('HEADER_PHP_COMPANY', true);
}

require '../function.php';
// require 'db.php';

// pr($_SESSION['Current_Company'],'$_SESSION[Current_Company] at db.php');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RMC</title>
	<link rel="stylesheet" href="../css/main.css?v2">
</head>
<body>
<header>
	<!-- <h1><?//=$_SERVER['HTTP_HOST']?></h1> -->
	<!-- LARGE_LOGO -->
	<h1>
		<!-- LARGE_LOGO -->
		<?//=$current_company['name']?>
		<a href="index.php"><?=$_SESSION['Current_Company']['name']?></a>
	</h1>
	<nav>
		<a href="index.php">Home</a> |

		<?php if ($_SESSION['Current_Company']['subdomain_id'] == 0): ?>
			<a href="signup.php">Signup</a> |
		<?php endif; ?>

		<?php if ($_SESSION['Current_Company']['subdomain_id'] != 0): ?>
			<a href="signin.php">Signin</a> |
		<?php endif; ?>
	</nav>
</header>
<hr>
<?php
if (!empty($_SESSION['page_msg'])) {
	echo "<h3 class=\"required\">{$_SESSION['page_msg']}</<h3>";
	unset($_SESSION['page_msg']);
}
