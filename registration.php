<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index
include("inc/config/config.php"); // connection
if (isset($_POST['submit'])) //if submit btn is pressed
{
   if (
      empty($_POST['firstname']) ||  //fetching and find if its empty
      empty($_POST['lastname']) ||
      empty($_POST['email']) ||
      empty($_POST['phone']) ||
      empty($_POST['password']) ||
      empty($_POST['cpassword'])
   ) {
      $message = "All fields must be Required!";
   } else {
      //cheching username & email if already present
      $check_username = mysqli_query($conn, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
      $check_email = mysqli_query($conn, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");



      if ($_POST['password'] != $_POST['cpassword']) {  //matching passwords
         $message = "Password not match";
      } elseif (strlen($_POST['password']) < 6)  //cal password length
      {
         $message = "Password Must be >=6";
      } elseif (strlen($_POST['phone']) < 10)  //cal phone length
      {
         $message = "invalid phone number!";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
      {
         $message = "Invalid email address please type a valid email!";
      } elseif (mysqli_num_rows($check_username) > 0)  //check username
      {
         $message = 'username Already exists!';
      } elseif (mysqli_num_rows($check_email) > 0) //check email
      {
         $message = 'Email Already exists!';
      } else {

         //inserting values into db
         $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password) VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "')";
         mysqli_query($conn, $mql);
         $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'login.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";




         header("refresh:5;url=login.php"); // redireted once inserted success
      }
   }
}


?>


<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" href="#">
   <title>FoodPartner</title>
   <!-- Bootstrap core CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
   <!-- <link href="css/animsition.min.css" rel="stylesheet">
   <link href="css/animate.css" rel="stylesheet"> -->
   <!-- Custom styles for this template -->
   <link href="css/style.css" rel="stylesheet">
</head>

<body>

   
   <div class="page-wrapper">
      
      <div class="breadcrumb">
         <div class="container">
            <ul>
               <li><a href="#" class="active">
                     <span style="color:red;"><?php echo $message; ?></span>
                     <span style="color:green;">
                        <?php echo $success; ?>
                     </span>

                  </a></li>

            </ul>
         <h1 style="text-align: center;">Register</h1>
         </div>
      </div>
      <section class="contact-page inner-page">
         <div class="container">
            <div class="row">
               <!-- REGISTER -->
               <div class="col-md-8">
                  <div class="widget">
                     <div class="widget-body">

                        <form action="" method="post">
                           <div class="row">
                              <div class="form-group col-sm-12">
                              <h3 style="color: #f30; text-align: center; padding-bottom: 10px;">Create a new account</h3>
                                 <label for="exampleInputEmail1">User-Name</label>
                                 <input class="form-control" type="text" name="username" id="example-text-input" placeholder="UserName">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">First Name</label>
                                 <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="First Name">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Last Name</label>
                                 <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Last Name">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Email address</label>
                                 <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small>
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputEmail1">Phone number</label>
                                 <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted">We"ll never share your email with anyone else.</small>
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputPassword1">Password</label>
                                 <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label for="exampleInputPassword1">Confirm password</label>
                                 <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password">
                              </div>
                              <!-- <div class="form-group col-sm-12">
                                 <label for="exampleTextarea">Delivery Address</label>
                                 <textarea class="form-control" id="exampleTextarea" name="address" rows="3"></textarea>
                              </div> -->

                           </div>

                           <div class="row">
                              <div class="col-sm-4">
                                 <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                              </div>
                           </div>
                        </form>
                     <div style="text-align: center;">Account Exist ?<a style="padding-left: 5px;" href="login.php" style="color:#f30;">Login</a></div>

                     </div>
                     <!-- end: Widget -->
                  </div>
                  <!-- /REGISTER -->
               </div>
</body>

</html>