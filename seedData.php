<!DOCTYPE html>
<?php
	$employeeID = $_POST['employeeID'];
	$password = $_POST['pass'];
	$userName = $_POST['uname'];
	$title = $_POST['title'];
	$academicOrg = $_POST['academicOrg'];
	$SSO = $_POST['sso'];
	$address = $_POST['address'];
	$phoneNum = $_POST['phone'];
?>
<html>
	<head>
		<title>Seed Data Form</title>
	</head>
	<body>
		<form action="seedData.php" method="POST">
			<h1>Login Info</h1>
			EmployeeID: <input type="text" name="employeeID"><br>
			Password: <input type="text" name="pass"><br>
			<br/><br/>
			<h1>Bio/Dem Info</h1>
			User Name (Full legal name): <input type="text" name="uname"><br>
			Title: <input type="text" name="title"><br>
			Academic Organization: <input type="text" name="academicOrg"><br>
			PawPrint/SSO: <input type="text" name="sso"><br>
			Campus Address: <input type="text" name="address"><br>
			Phone-Number: <input type="text" name="phone"><br>
			<br/><br/>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>