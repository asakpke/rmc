<?php //require '../first.php' ?>

<?php require 'header.php' ?>

<?php
// pr($_POST,'$_POST');
company_login();
?>

<h2>Signin</h2>
<small>Have not signup yet? <a href="index.php">Click here</a> to signup.</small>
<form method="post">
  <label for="email">Email: <span class="required">*</span></label><br>
  <input type="email" id="email" name="email" value="<?=!empty($_POST['email']) ? $_POST['email'] : ''?>" required><br><br>

	<label for="password">Password: <span class="required">*</span></label><br>
  <input type="password" id="password" name="password" value="<?=!empty($_POST['password']) ? $_POST['password'] : ''?>" required><br><br>

  <small>You should be using your subdomain for signin instead of the main website i.e <a href="<?=$ssl?>YourSubDomain.<?=$site_domain?>"><?=$ssl?>YourSubDomain.<?=$site_domain?></a>.</small><br><br>

	<input type="submit">

  <p class="required">* are required fields.</p>
</form>

<?php require 'footer.php' ?>