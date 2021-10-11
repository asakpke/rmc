<?php require 'header.php' ?>

<?php
// echo '<pre>'; print_r($_POST); echo '</pre>';
// pr($_POST,'$_POST');
// $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
// pr($hash,'$hash');

// $verify = password_verify($_POST['password'], $hash);
// pr($verify,'$verify');

// pr($_FILES,'$_FILES');

set_company();
?>

<h2>New Signup</h2>
<small>Already signup? <a href="signin.php">Click here</a> to signin.</small>
<form method="post" enctype="multipart/form-data">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="<?=!empty($_POST['name']) ? $_POST['name'] : ''?>"><br><br>

  <label for="email">Email: <span class="required">*</span></label><br>
  <input type="email" id="email" name="email" value="<?=!empty($_POST['email']) ? $_POST['email'] : ''?>" required><br><br>

	<label for="password">Password: <span class="required">*</span></label><br>
  <input type="password" id="password" name="password" value="<?=!empty($_POST['password']) ? $_POST['password'] : ''?>" required><br><br>

  <label for="subdomain">Sub Domain: <span class="required">*</span></label><br>
  <input type="text" id="subdomain" name="subdomain" value="<?=!empty($_POST['subdomain']) ? $_POST['subdomain'] : ''?>" required>.<?=$site_domain?><br><br>

  <label for="payment">Payment Proof:</label><br>
  <!-- <input type="file" id="payment" name="payment" value="<?//=!empty($_POST['payment']) ? $_POST['payment'] : ''?>"> -->
  <!-- <input type="file" id="payment" name="payment" value="<?//=!empty($_FILES['payment']['name']) ? $_FILES['payment']['name'] : ''?>"> -->
  <!-- <input type="file" id="payment" name="payment" <?//=($_FILES['payment']['error'] == UPLOAD_ERR_OK or $_FILES['payment']['error'] != UPLOAD_ERR_NO_FILE) ? 'required' : '' // 0?>> -->
  <input type="file" id="payment" name="payment">
  <small>You can skip it now but your account would not be activated until the payment confirmation.</small><br><br>

	<input type="submit">

  <p class="required">* are required fields.</p>
</form>

<?php require 'footer.php' ?>