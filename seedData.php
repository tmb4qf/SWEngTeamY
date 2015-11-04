<!DOCTYPE html>
<?php
	require "password.php";
	
	$employeeID = $_POST['employeeID'];
	$password = $_POST['pass'];
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$SSO = $_POST['sso'];
	$phoneNum = $_POST['phone'];
	$title = $_POST['title'];
	$addrID = $_POST['addrID'];
	
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['county'];
	$zipCode = $_POST['zip'];
	
	$orgID = $_POST['orgID'];
	$studentWorker = $_POST['studentWorker'];
	
	$jobTitle = $_POST['jobTitle'];
	
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	
	//connection string to db
	//query to add user info to db
?>
<html>
	<head>
		<title>Seed Data Form</title>
	</head>
	<body>
		<form action="seedData.php" method="POST">
			<h1>Authentication</h1>
			EmployeeID: <input type="text" name="employeeID"><br>
			Password: <input type="text" name="pass"><br>
			<br/><br/>
			
			<h1>Person</h1>
			First Name: <input type="text" name="fname"><br>
			Last Name: <input type="text" name="lname"><br>
			PawPrint/SSO: <input type="text" name="sso"><br>
			Phone-Number: <input type="text" name="phone"><br>
			Title: <input type="text" name="title"><br>
			Addr ID: <input type="text" name="addrID"><br>
			<br/><br/>
			
			<h1>Address</h1>
			Street: <input type="text" name="street"><br>
			City: <input type="text" name="city"><br>
			State: <input type="text" name="state"><br>
			Country: <input type="text" name="country"><br>
			Zip Code: <input type="text" name="zip"><br>
			<br/><br/>
			
			<h1>Applicant</h1>
			Organization ID: <input type="text" name="orgID"><br>
			Is Student Worker <input type="text" name="studentWorker"><br>
			
			<h1>Application Processor</h1>
			Job Title: <input type="text" name="jobTitle"><br>
			<input type="submit" value="Submit">

		</form>
	</body>
</html>