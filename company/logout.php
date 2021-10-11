<?php
// require '../config.php';
require 'header.php';
unset($_SESSION['Company_Login']);
// pr($site_url,'$site_url on logout.php');
// die("Self die before {$site_url}/company/index.php on logout.php");
header("Location: {$site_url}/company/index.php");
exit(0);