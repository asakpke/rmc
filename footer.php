<footer>
	<!-- <h3><?//='COMPANY'?></h3> -->
	<h3>
		<!-- SMALL_LOGO -->
		<?//=$current_company['name']?>
		<a href="index.php"><?=$current_company['name']?></a>
	</h3>
</footer>
</body>
</html>
<?php
$conn->close();