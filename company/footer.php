<?php //require '../first.php' ?>

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
		<a href="index.php"><?=$_SESSION['Current_Company']['name'] ?></a> &copy; |
		<a href="index.php">Home</a> |

		<?php if ($_SESSION['Current_Company']['subdomain_id'] == 0): ?>
			<a href="signup.php">Signup</a> |
		<?php endif; ?>

		<?php if ($_SESSION['Current_Company']['subdomain_id'] != 0): ?>
			<a href="signin.php">Signin</a> |
		<?php endif; ?>
	</nav>
	<!-- </h3> -->
	<!-- <br> -->
	<hr>
	<nav class="bottom">
		Powered by <a href="<?=$ssl.$site_domain?>" target="_blank">RMC</a> &copy;, a project of <a href="http://eSite.pk" target="_blank">RoshanTech</a>
	</nav>
</footer>
</body>
</html>
<?php
//$conn->close();
