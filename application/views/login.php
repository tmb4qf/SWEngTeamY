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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Security Request</title>
	<link href="../../assets/css/bootstrap.slate.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<!--<style>
	
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
		
	</style>-->
</head>
<body>

	<br>
	<br>
	
	<div class="container">
		<div class="jumbotron">
			<h1 align="center"> Mizzou Security Request </h1>
			<?php echo validation_errors(); ?>
			<?php echo form_open('LoginController/checkLogin'); ?>
			<!--<form id="myDiv" action="localhost:8888/swengteamy/index.php/LoginController/checkLogin" method= 'POST'>-->
		</div>
		
		<div class="row-fluid" align="center">
		  <div class="col-md-7">
			<div class="panel panel-primary">
			  <div class="panel-heading">
				<h3 class="panel-title">Sign In</h3>
			  </div>
			  <div class="panel-body">
				  <div class="row-fluid">
					  <div class="row-fluid">
						<div class="col-md-10">
						<div class="form-group">
						  <label for="username" class="col-lg-3 control-label">Pawprint</label>
						  <div class="col-lg-9">
							<input type="text" name = "username" class="form-control" id="username" placeholder="Pawprint">
						  </div>
						</div>
						<div class="form-group">
						  <label for="password" class="col-lg-3 control-label">Password</label>
						  <div class="col-lg-9">
							<input type="password" name = "password" class="form-control" id="password" placeholder="Password">
						  </div>
						</div>
						</div>
						<div class="col-md-2"></div>
					   </div>
				  </div>
		
				  <div class="row-fluid">
					<div class="col-md-12">
						<input class="btn btn-primary btn-lg" type = "submit" name= "submit" value = "Login" >
					</div>
				  </div>
				</div>
			</div>
		  </div>
		</div>
	</div>
		
		
	<!--<h2> Sign In </h2>
    <fieldset id ="field">
        Employee ID <br> <input type = "text" name = "username"> <br>
		Password <br> <input type = "password" name = "password">
		<br> <br>
		<input class = "button" type = "submit" name= "submit" value = "Login" >
		
		<br>
		<br>
    </fieldset>-->
	</form>
	<br>

	
</body>
</html>
