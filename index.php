<?php
require 'config.php';
require 'function.php';

get_current_company();

if (!empty($_SESSION['Current_Company'])) {
	require 'header.php';
	?>
	<h2>Welcome to <?=$_SESSION['Current_Company']['name']?></h2>
	<p>New to <?=$_SESSION['Current_Company']['name']?>? You may signup or signin.</p>

	<?php
	require 'footer.php';
}
else {
	require 'header_main.php';
	?>
	<h2>Welcome to RMC</h2>
	<p>New to RMC? You may signup or signin.</p>
	<?php
	require 'footer_main.php';	
}