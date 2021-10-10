<?php require 'header.php' ?>

<?php
// echo '<pre>'; print_r($_POST); echo '</pre>';
// pr($_POST,'$_POST');
// $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
// pr($hash,'$hash');

// $verify = password_verify($_POST['password'], $hash);
// pr($verify,'$verify');

// pr($_FILES,'$_FILES');
?>

<h2>New Signup</h2>
<form method="post">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="<?=!empty($_POST['name']) ? $_POST['name'] : ''?>"><br><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" value="<?=!empty($_POST['email']) ? $_POST['email'] : ''?>" required><br><br>

	<label for="password">Password:</label><br>
  <input type="password" id="password" name="password" value="<?=!empty($_POST['password']) ? $_POST['password'] : ''?>" required><br><br>

	<input type="submit">
</form>

<?php require 'footer.php' ?>