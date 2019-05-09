<?php 
	$msg = "";
	if(isset($_POST['submit'])) {
		
		/* Connection to Database */
		$link = mysqli_connect("localhost", "root", "Smackdown1", "store");

		/* Retreiving data posted*/
		$storeId = $link->real_escape_string($_POST['storeId']);
		$password = $link->real_escape_string($_POST['password']);

		/* Selecting records from the database */
		$sql = $link->query("SELECT storeId, password FROM login WHERE storeId = $storeId");
		if ($sql->num_rows > 0) {
			$data = $sql->fetch_array();
			/* Verifying the password*/
			if (password_verify($password, $data['password'])) {
				$msg = "You have been logged in!";
				header('Location: index.html');
			} else {
				$msg = "Please check your inputs";
			}
		} else {
			$msg = "Please check your inputs";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

		<!-- Links to other docs -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/login.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-6 cold-md-offset-3" align="center">
				<h1> Hello Again Lads </h1>
				<?php
					if($msg !="") echo $msg . "<br><br><br>";
				 ?>
				<form method="post" action="login.php">
					<input class="form-control" name="storeId" placeholder ="Store Id..."><br>
					<input class="form-control" name="password" Type="password" placeholder ="Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value ="LogIn"><br>
				</form>
				<form action="register.php">
					<input class="btn btn-primary" href="register.php" name="register" type="submit" value ="New Store?"><br>
				</form>
			</div>
		</div>
	</div>
</body>
</html>