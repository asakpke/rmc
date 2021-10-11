<?php
if (defined('FOOTER_PHP_COMPANY')) {
	return;
} else {
	define('FOOTER_PHP_COMPANY', true);
}
?>
<footer>
	<!-- <h3><?//='COMPANY'?></h3> -->
	<!-- <h3> -->		
	<?//=$current_company['name']?>		
	<nav>			
		<!-- <a href="index.php">LOGO</a> -->
		<a href="dashboard.php">RoshanTech</a> &copy; |
		<a href="dashboard.php">Dashboard</a> |
		<a href="logout.php">Logout</a>
	</nav>
	<!-- </h3> -->
	<hr>
	<nav>
		Powered by <a href="http://eSite.pk">RoshanTech</a> |
		<a href="http://eSite.pk">eSite.pk</a>
	</nav>
</footer>
</body>
</html>
<?php
//$conn->close();
