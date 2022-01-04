<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>login</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

	<style>
		body {
  background: #e9e9e9;
  color: #666666;
  font-family: 'RobotoDraft', 'Roboto', sans-serif;
  font-size: 14px;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* Pen Title */
.pen-title {
  padding: 50px 0;
  text-align: center;
  letter-spacing: 2px;
}
.pen-title h1 {
  margin: 0 0 20px;
  font-size: 48px;
  font-weight: 300;
}
.pen-title span {
  font-size: 12px;
}
.pen-title span .fa {
  color: #f30;
}
.pen-title span a {
  color: #f30;
  font-weight: 600;
  text-decoration: none;
}

/* Form Module */
.form-module {
  position: relative;
  background: #ffffff;
  max-width: 320px;
  width: 100%;
  border-top: 5px solid #f30;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}
.form-module .toggle {
  cursor: pointer;
  position: absolute;
  top: -0;
  right: -0;
  background: #;
  width: 30px;
  height: 30px;
  margin: -5px 0 0;
  color: #ffffff;
  font-size: 12px;
  line-height: 30px;
  text-align: center;
}
.form-module .toggle .tooltip {
  position: absolute;
  top: 5px;
  right: -65px;
  display: block;
  background: rgba(0, 0, 0, 0.6);
  width: auto;
  padding: 5px;
  font-size: 10px;
  line-height: 1;
  text-transform: uppercase;
}
.form-module .toggle .tooltip:before {
  content: '';
  position: absolute;
  top: 5px;
  left: -5px;
  display: block;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-right: 5px solid rgba(0, 0, 0, 0.6);
}
.form-module .form {
  display: none;
  padding: 40px;
}
.form-module .form:nth-child(2) {
  display: block;
}
.form-module h2 {
  margin: 0 0 20px;
  color: #f30;
  font-size: 18px;
  font-weight: 400;
  line-height: 1;
}
.form-module input {
  outline: none;
  display: block;
  width: 100%;
  border: 1px solid #ccc;
  margin: 0 0 20px;
  padding: 10px 15px;
  box-sizing: border-box;
  font-wieght: 400;
  transition: 0.3s ease;
}
.form-module input:focus {
  border: 1px solid #f30;
  color: #333333;
}
.form-module button {
  cursor: pointer;
  background: #f30;
  width: 100%;
  border: 0;
  padding: 10px 15px;
  color: #ffffff;
  transition: 0.3s ease;
}
.form-module button:hover {
  background: #b92a07;
}
.form-module .cta {
  background: #f2f2f2;
  width: 100%;
  padding: 15px 40px;
  box-sizing: border-box;
  color: #666666;
  font-size: 12px;
  text-align: center;
}
.form-module .cta a {
  color: #333333;
  text-decoration: none;
}

	</style>


</head>

<body>
	<?php
	include("inc/config/config.php"); //INCLUDE CONNECTION
	error_reporting(0); // hide undefine index errors
	session_start(); // temp sessions
	$tblno =  $_SESSION['tblno'];
	if (isset($_POST['submit']))   // if button is submit
	{
		$username = $_POST['username'];  //fetch records from login form
		$password = $_POST['password'];

		if (!empty($_POST["submit"]))   // if records were not empty
		{
			$loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'"; //selecting matching records
			$result = mysqli_query($conn, $loginquery); //executing
			$row = mysqli_fetch_array($result);

			if (is_array($row))  // if matching records in the array & if everything is right
			{
				$_SESSION["user_id"] = $row['u_id']; // put user id into temp session
				header("refresh:1;url=index.php"); // redirect to index.php page
			} else {
				$message = "Invalid Username or Password!"; // throw error
			}
		}
	}
	?>

	<!-- Form Mixin-->
	<!-- Input Mixin-->
	<!-- Button Mixin-->
	<!-- Pen Title-->
	<div class="pen-title">
		<h1>Login Form</h1>
	</div>
	<!-- Form Module-->
	<div class="module form-module">
		<div class="toggle">

		</div>
		<div class="form">
			<h2>Login to your account</h2>
			<span style="color:red;"><?php echo $message; ?></span>
			<span style="color:green;"><?php echo $success; ?></span>
			<form action="" method="post">
				<input type="text" placeholder="Username" name="username" />
				<input type="password" placeholder="Password" name="password" />
				<input type="submit" id="buttn" name="submit" value="login" />
			</form>
		</div>

		<div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
	</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>







</body>

</html>