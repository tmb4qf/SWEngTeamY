<!DOCTYPE html>
<?php
		//Start session
		session_start();

		//If user is logged in, direct them to the booking page
		if($_SESSION['login'] == "yes")
		{
  			 header("Location: ");
		}

		if (!isset($_SESSION['count']))
		{
			$_SESSION['count'] = 0;
		} 
		else
		{
			$_SESSION['count']++;
		}
		
	?>
	
	<?php
		DEFINE ("HOST","");
		DEFINE ("DBNAME","dbname=");
		DEFINE("USERNAME","user=");
		DEFINE("PASSWORD","password =");
	?>
	
	<?php
		//Connect to database
		$conn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD) or die('Could not connect:' . pg_last_error());
	?>

	<!-- <?php
	
	echo"<br>";
		//Get user login data
		$employeeID = htmlspecialchars($_POST['employeeID']);
		$password = htmlspecialchars($_POST['password']);
		if(isset($_POST['submit']))
		{
			
				
			//get the password_hash and salt from the database based on the username
   			$result = pg_prepare($conn, "selectp", "SELECT loginID, password_hash, salt FROM hotel.authentication WHERE loginID = $1");
			$result = pg_execute($conn, "selectp", array($loginID));
			if(!$result)
			{
					die('Query failed: '.pg_last_error($conn));
			}
			$line = pg_fetch_array($result,null,PGSQL_ASSOC);	
			$salt = $line['salt'];
			$dbHash= $line['password_hash'];
			$dbLoginID = $line['employeeID'];
			


			$a = $salt.$password;
			$a = str_replace(' ','',$a);
			$pwhash = sha1($a);
			for($i=0; $i<10000; $i++)
			{
				$pwhash = sha1($pwhash);
			}	
				echo"<br>";
				echo"<br>";
			//check if the password hash match from when they registed to the password they entered
			if($pwhash == $dbHash && $loginID == $dbLoginID)
			{
				
				//create session variables to be used on other pages
				$_SESSION['employeeID']= $employeeID;
				$_SESSION['login']= "yes";
				
				header("Location: /~cs3380s15grp2/hotel/book.php");
			}
			else
			{
				
				//keep them at the index.php and ask them for the login info again
				echo "<div style= 'text-align:center'>Please enter your login information again.</div>";
			}
		}	
				//Close database connection
				pg_free_result($result);
				pg_close($conn);
			?> -->
<html>
<head>
	<title>Security Request</title>
	<style>
	
	body 
	{
		/*background-color: #D9D9D2;*/
		background-color: gray;
	}
	
	h1
	{ 
		color: gold;
		text-align: center;
		text-shadow: 4px 4px #002549;
		font-size: 100px;
	}
		
	#myDiv 
	{
		text-align: center;
		width: 1116px;
		padding: 10px;
		border: 5px solid black;
		margin-left: auto;
		margin-right: auto;
		background-color: #999966;
		font-size: 20px;
	}

	#field
	{
		text-align: center;
	}
			
	
			
	#wrap
    {
		display: block;
		margin-left: center;
		margin-right: center;
	}	
			
	.button 
	{
		width: 100px;
		height: 30px;
		background-color: gold;
		border: solid 1px #006600;
		border-radius: 5px;
		color: black;
		font-size: 20px;
		box-shadow: 5px 5px 5px black;
	}
	
	.centeredImage
	{
		text-align:center;
    	margin-top:0px;
    	margin-bottom:0px;
    	padding:0px;
    }
	
	div.box
	{
		text-align: center;
	}
		
	</style>
</head>
<body>

	<br>
	<br>
	
	<br>
	<h1> Mizzou Security Request </h1>
		
	<form id="myDiv" action="hotel.php" method= 'POST'>
	<h2> Sign In </h2>
    <fieldset id ="field">
        Employee ID <br> <input type = "text" name = "employeeID"> <br>
		Password <br> <input type = "password" name = "password">
		<br> <br>
		<input class = "button" type = "submit" name= "submit" value = "Login" >
		
		<br>
		<br>
    </fieldset>
	</form>
	<br>

	
</body>
</html>
