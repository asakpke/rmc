<footer>
		<nav>			
			<?=$_SESSION['Current_Company']['name']?> &copy;			
	</nav>
	<!-- </h3> -->
	<hr>
	<nav class="bottom">
		Powered by <a href="<?=$ssl.$site_domain?>" target="_blank">RMC</a> &copy;, a project of <a href="http://eSite.pk" target="_blank">RoshanTech</a>
	</nav>
</footer>
</body>
</html>
<?php
$conn->close();