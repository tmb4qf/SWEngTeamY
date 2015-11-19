<!doctype html>
<!--<html>
    <head><title></title></head>
    <body>

        <h1>Login Page</h1>
        <?php //echo form_open('LoginController/checkLogin'); ?>
        
            Username:<br/>
            <input type="text" name ="username"/><br/>
            Password: <br/>
            <input type="text" name="password"/>
            <input type="submit" value = "login" name="submit">
        </form>
    </body>
</html>-->

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
	 <?php echo validation_errors(); ?>
	 <?php echo form_open('LoginController/checkLogin'); ?>
	<!--<form id="myDiv" action="localhost:8888/swengteamy/index.php/LoginController/checkLogin" method= 'POST'>-->
	<h2> Sign In </h2>
    <fieldset id ="field">
        Employee ID <br> <input type = "text" name = "username"> <br>
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
