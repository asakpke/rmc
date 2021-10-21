<?php
// require 'function.php';
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$_SESSION['Current_Company']['name'] //$current_company['name']?></title>
	<link rel="stylesheet" href="css/main.css?v3">
</head>
<body>
<header>
	<h1><?=$_SESSION['Current_Company']['name']?></h1>
	<nav>
		<a href="index.php">Home</a> |
		<a href="signup.php">Signup</a> |
		<a href="signin.php">Signin</a>
	</nav>
</header>
<hr>