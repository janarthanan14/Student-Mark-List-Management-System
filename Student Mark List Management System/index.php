<?php
session_start();

include './db/db_connection.php';

if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$errorUsername="";
$errorPass="";
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (isset($_POST['username'], $_POST['password'])) {
	// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
	if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
		// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $password);
			$stmt->fetch();
			// Account exists, now we verify the password.
			// Note: remember to use password_hash in your registration file to store the hashed passwords.

			if ($_POST['password'] === $password) {
				// Verification success! User has logged-in!
				// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				echo 'Welcome ' . $_SESSION['name'] . '!';
				header('Location: courses.php');
			} else {
				$errorPass= "* Incorrect password!";
			}
		} else {
			$errorUsername= "* Incorrect username";
		}


		$stmt->close();
	} else {
		exit('Please fill both the username and password fields!');
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="login">
		<h1>Login</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" value="<?php echo $_POST['username'] ?? ''; ?>" required>
			</div>
			<span class="errorText"><?php echo $errorUsername; ?></span>
			<div>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
			</div>
			<span class="errorText"><?php echo $errorPass; ?></span>
			<input type="submit" value="Login">
		</form>
	</div>
</body>

</html>