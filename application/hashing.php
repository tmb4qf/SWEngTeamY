<?php
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rand = rand();
		$salt = crypt($rand);
		$hashedPassword = crypt($password, $salt);
		
		echo "Username: $username <br/>";
		echo "Password: $password <br/>";
		echo "Random: $rand <br/>";
		echo "Salt: $salt <br/>";
		echo "Hash: $hashedPassword <br/>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form action="hashing.php" method="POST">
			<input type="text" name="username"></input>
			<input type="text" name="password"></input>
			<input type="submit" name="submit"></input>
		</form>
	</body>
</html>
