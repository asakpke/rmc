<?php
// require 'config.php';

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("<h1>Connection failed: " . $conn->connect_error . '</h1>');
}

// get_current_company();


function pr($v,$n) {
	// echo '<h1>$n '.count($v).'</h1><pre>'; print_r($v); echo '</pre>';
	// if (is_array($v) or is_object($v)) {
		$c = count($v);
		$p = print_r($v, true);
		echo "<h1>{$n} {$c}</h1><pre>{$p}</pre>";
	// }
	// else {
	// 	echo "<h1>{$n}</h1><pre>".var_dump($v)."</pre>";
	// }
}

function prd($v,$n) {
	pr($v, $n);
	die('<h1>Self die</h1>');
}

function get_current_company() {
	global $conn;

	if (!empty($_SESSION['Current_Company'])) {
		return; // self commented, uncomment later on
	}

	$sql = 'SELECT subdomain_id, user.name
		FROM subdomain
		INNER JOIN user ON user.subdomain_id = subdomain.id
		WHERE subdomain.name = ?
			AND subdomain.status = "Active"
			AND user.status = "Active"
			AND user.type = "Company"
	';

	$stmt = $conn->prepare($sql);
	$subdomain = explode('.', $_SERVER['HTTP_HOST']);
	$stmt->bind_param("s", $subdomain[0]); // i=integer,d=double,s=string,b=BLOB
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows == 1) {
		$_SESSION['Current_Company'] = $result->fetch_assoc();
	}
}

function set_company() {
	global $conn, $root_folder;
	// pr($conn, '$conn set_company()');

	// pr($_POST,'$_POST');

	if (!empty($_POST)
		and !empty($_POST['email'])
	) {
		// query for email/subdomain
		if (is_email_exists($_POST['email'], 'Company')) {
			// die('<h1>Email exists</h1>');
			echo '<h1>This email alreay exists, please try another.</h1>';
			return;
		}
		// else {
		// 	// die('<h1>Email DON\'T exists</h1>');
		// 	echo '<h1>Email DON\'T exists</h1>';
		// }

		if (is_subdomain_exists($_POST['subdomain'])) {
			// die('<h1>Email exists</h1>');
			echo '<h1>This subdomain already exists, please try another.</h1>';
			return;
		}
		// else {
		// 	// die('<h1>Email DON\'T exists</h1>');
		// 	echo '<h1>Subdomain DON\'T exists</h1>';
		// }

		// $payment_file = upload_file($_FILES['payment'], 'upload/');
		// $payment_file = upload_file($_FILES['payment'], '/../upload/');
		// $payment_file = upload_file($_FILES['payment'], '../upload/');
		$payment_file = upload_file($_FILES['payment'], $root_folder.'/upload/');		
		// pr($payment_file,'$payment_file');

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$conn->begin_transaction();

		try {
			$sql = 'INSERT INTO subdomain (name) VALUES (?)';
			$stmt = $conn->prepare($sql);
			// $subdomain = $_POST['subdomain'].'.'.$site_domain;
			$stmt->bind_param('s',$_POST['subdomain']); // i - integer, d - double, s - string, b - BLOB
			// $stmt->bind_param('s',$subdomain); // i - integer, d - double, s - string, b - BLOB
			$stmt->execute();
			// pr($stmt,'$stmt after execute() subdomain');
			$result = $stmt->get_result();
			// pr($result,'$result');
			// return;

			if (!empty($stmt->insert_id)) {
				$insert_id = $stmt->insert_id;
				// pr($insert_id,'$insert_id');

				$sql = 'INSERT INTO user (subdomain_id, type, name, email, password, payment) VALUES (?, ?, ?, ?, ?, ?)';
				// pr($sql,'$sql');
				// pr($conn,'$conn');
				$stmt = $conn->prepare($sql);
				// pr($stmt,'$stmt after prepare()');
				// pr(conn->error_list,'conn->error_list');
				// echo $conn->error_list;
				// print_r($conn->error_list);
				// $error_list = $conn->error_list;
				// pr($error_list,'$error_list');
				
				$type = 'Company';
				// pr($type,'$type');
				$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				// pr($hash,'$hash');
				
				$stmt->bind_param('isssss',
					// $stmt->insert_id,
					$insert_id,
					// 'Company',
					$type,
					$_POST['name'],
					$_POST['email'],
					// $_POST['password'],			
					$hash,			
					$payment_file
				); // i - integer, d - double, s - string, b - BLOB
				$stmt->execute();
				// pr($stmt,'$stmt after execute() user');
				$result = $stmt->get_result();
				// pr($result,'$result');

				$conn->commit();

				$stmt->close();
			} // if (!empty($stmt->insert_id))
		}
		catch (mysqli_sql_exception $exception) {
			$conn->rollback();
			throw $exception;
		}
	} // if (!empty($_POST) and !empty($_POST['email']))
} // set_company()

function is_email_exists($email, $type) {
	global $conn;
	// pr($conn, '$conn is_email_exists()');

	$sql = 'SELECT id
		FROM user
		WHERE user.email = ?
			AND user.type = ? 
	';
	// pr($conn, '$conn');
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $type); // i - integer, d - double, s - string, b - BLOB
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows > 0) {
		return true;
	}
	
	return false;
}

function is_subdomain_exists($subdomain) {
	global $conn;
	// pr($conn, '$conn is_email_exists()');

	$sql = 'SELECT id
		FROM subdomain
		WHERE name = ?
	';
	// pr($conn, '$conn');
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $subdomain); // i - integer, d - double, s - string, b - BLOB
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows > 0) {
		return true;
	}
	
	return false;
}

function upload_file($file,$path) {
	// pr($file,'$file');
	// pr($path,'$path');
	$payment_file = null;
	// $payment_file = 'null';
	$upload_err = array(
			0 => 'There is no error, the file uploaded with success',  // UPLOAD_ERR_OK
			1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini', // UPLOAD_ERR_INI_SIZE
			2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', // UPLOAD_ERR_FORM_SIZE
			3 => 'The uploaded file was only partially uploaded', // UPLOAD_ERR_PARTIAL
			4 => 'No file was uploaded', // UPLOAD_ERR_NO_FILE
			6 => 'Missing a temporary folder', // UPLOAD_ERR_NO_TMP_DIR
			7 => 'Failed to write file to disk.', // UPLOAD_ERR_CANT_WRITE
			8 => 'A PHP extension stopped the file upload.', // UPLOAD_ERR_EXTENSION
	);
	// pr($upload_err,'$upload_err');

	if ($file['error'] == UPLOAD_ERR_OK) { // 0
		// $target_file = $path . basename($file['name']);
		// $target_file = basename($file['name']);
		// $target_file = getcwd().$path . basename($file['name']);
		// $file_ext = explode($file['name'],'.',2);
		$file_ext = explode('.', $file['name'], 2);
		// pr($file_ext,'$file_ext');
		$target_file = uniqid(rand(), true) . '.' . $file_ext[1];

		while (file_exists($path . $target_file)) {
			// $target_file = $path . uniqid(rand(), true) . basename($file['name']);
			// $target_file = uniqid(rand(), true) . basename($file['name']);
			$target_file = uniqid(rand(), true) . '.' . $file_ext[1];
		}

		// pr($target_file,'$target_file');

		// if (move_uploaded_file($file["tmp_name"], $target_file)) {
		if (move_uploaded_file($file["tmp_name"], $path . $target_file)) {
			// echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			$payment_file = $target_file;
		} else {
			die('<h1>Sorry, there was an error uploading your file, please go back & try again.</h1>');
		}
	}
	elseif ($file['error'] == UPLOAD_ERR_NO_FILE) { // 4
	}
	else {
		die('<h1>'.$upload_err[$file['error']].' Please go back & try again.</h1>');
	}

	return $payment_file;
}

function company_login() {
	// global $conn, $site_domain, $root_folder, $site_url;

	$company_login = login(
		!empty($_POST['email']) ? $_POST['email'] : '',
		!empty($_POST['password']) ? $_POST['password'] : '',
		'Company'
	);
	// pr($company_login,'$company_login');
} // company_login()

function login($email, $password, $type) {
	global $conn, $site_url;

	// pr($email,'$email');
	// pr($password,'$password');
	// pr($type,'$type');
	// pr($_SESSION[$type.'_Login'],'$_SESSION[$type._Login]');

	// is_login();
	if (!empty($_SESSION[$type.'_Login'])) {
		// pr($_SESSION[$type.'_Login'],'$_SESSION[$type._Login]');
		// return true;

		// pr($site_url,'$site_url on function.login()');

		// die("Self die before {$site_url}/company/dashboard.php on function.login()");

		header("Location: {$site_url}/company/dashboard.php");
		exit(0);
	}

	if (empty($email)
		or empty($password)
	) {
		return;
	}

	$sql = 'SELECT id, name, password
		FROM user
		WHERE email = ?
			AND status = "Active"
			AND type = ?
	';

	$stmt = $conn->prepare($sql);

	$error_list = $conn->error_list;
	// pr($error_list,'$error_list');

	$stmt->bind_param('ss',  // i - integer, d - double, s - string, b - BLOB
		$email,
		// $password,
		$type
	);
	$stmt->execute();
	$result = $stmt->get_result();
	// pr($result, '$result');
	$stmt->close();

	$row = null;

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		// pr($row,'$row');

		$verify = password_verify($password, $row['password']);
		// pr($verify,'$verify');

		// pr($_SESSION['Current_Company'],'$_SESSION[Current_Company] at db.php');

		if ($verify) {
			unset($row['password']);
			$_SESSION[$type.'_Login'] = $row;
			// die("self die before {$site_url}/company/dashboard.php at function.login()");
			header("Location: {$site_url}/company/dashboard.php");
			exit(0);
		}
		else {
			$row = null;
		}
	}	

	return $row;
} // login()