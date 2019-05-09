<?php 
	$msg = "";
	if(isset($_POST['submit'])) {
		
		$link = mysqli_connect("localhost", "root", "Smackdown1", "store");

		$storeId = $link->real_escape_string($_POST['storeId']);
		$password = $link->real_escape_string($_POST['password']);
		$cPassword = $link->real_escape_string($_POST['cPassword']);

		if ($password != $cPassword)
			$msg = "Please Check Your Passwords Match!";
		else{
			/* Hashing the password to secure the login of the user */
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$link->query("INSERT INTO login (storeId, password) VALUES ('$storeId', '$hash')");
			$msg = 'New store has been registered!';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-6 cold-md-offset-3" align="center">
				<h1> Hello Lads </h1>
				<?php
					if($msg !="") echo $msg . "<br><br><br>";
				 ?>
				<form method="post" action="register.php">
					<input class="form-control" name="storeId" placeholder ="Store Id..."><br>
					<input class="form-control" name="password" Type="password" placeholder ="Password..."><br>
					<input class="form-control" name="cPassword" Type="Password" placeholder ="Confirm Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value ="register"><br>

				</form>

			</div>
		</div>
	</div>
</body>
</html>