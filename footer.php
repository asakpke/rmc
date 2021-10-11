<?php
if (defined('FOOTER_PHP_ROOT')) {
	return;
} else {
	define('FOOTER_PHP_ROOT', true);
}
?>
<footer>
	<!-- <h3><?//='COMPANY'?></h3> -->
	<!-- <h3> -->
		<!-- SMALL_LOGO -->
		<?//=$current_company['name']?>
		<!-- <a href="index.php"><?//=$current_company['name']?></a> -->
		<nav>			
			<!-- <a href="index.php">LOGO</a> -->
			<a href="index.php"><?=$_SESSION['Current_Company']['name'] //$current_company['name']?></a> &copy; |
			<a href="index.php">Home</a> |

			<?php if ($_SESSION['Current_Company']['subdomain_id'] == 0): ?>
			<a href="signup.php">Signup</a> |
		<?php endif; ?>

		<?php if ($_SESSION['Current_Company']['subdomain_id'] != 0): ?>
			<a href="signin.php">Signin</a> |
		<?php endif; ?>
	</nav>
	<!-- </h3> -->
	<hr>
	<nav class="bottom">
		Powered by <a href="<?=$site_domain?>" target="_blank">RMC</a> &copy;, a project of <a href="http://eSite.pk" target="_blank">RoshanTech</a>
	</nav>
</footer>
</body>
</html>
<?php
$conn->close();