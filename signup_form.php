<?php
session_start();
require 'db_connection.php';
require 'insert_user.php';
// IF USER LOGGED IN
if(isset($_SESSION['user_email'])){
header('Location: index.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
<style>
.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}
.popup .close {
  position: relative;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
  left: 90%;
}
.popup .close:hover {
  color: #FFA500;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>
</head>

<body style="background-image: url('images/design/background.jpg'); background-size: 25%;">
<br>
<form action="" method="post" style="background-color:white; opacity:95%;">
<h1 style="text-align:center; color:black; background-color:white; margin-left: 0px;
margin-right: 0px; margin-top: 0px;"><b> KITCHEN ON WHEELS </b></h1>
<h2 >Sign Up</h2>

<div class="container">
<label for="username"><b>Username</b></label>
<input type="text" placeholder="Enter your name" id="username" name="username" title="First and Last name" required>

<label for="Phone"><b>Phone</b></label>
<input type="text" placeholder="Enter your phone number" id="phone" name="phone" title="Phone number" required>

<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter your email" id="email" name="user_email" title="Email address" required>

<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter password" id="password" name="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
title="Must contain at least 8 or more characters, at least one number and one uppercase" required>

<label for="password"><b>Confirm Password</b></label>
<input type="password" placeholder="Re-Enter password" id="rest_password" name="rest_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
title="Must contain at least 8 or more characters, at least one number and one uppercase" required>
<br><label for="password"><h3>Reset Password security question:</h3></label>
<label for="password"><b>What are the last five digits of your nationality ID number?</b></label>
<input type="text" placeholder="Enter your nationality ID number last five digits" id="security_question" name="security_question" pattern="{5,}"  required>
<button type="submit" style="font-size:15px;">Sign Up</button>
</div>
<?php
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
?>
<div class="container" style="opacity:90%; background-color:#f1f1f1">
<p> Already a member?
<a href="login_form.php"><button type="button" class="Regbtn" style="font-size:15px;">Login</button></a></p>
<p> By creating an account you agree to our <a href="#popup1" style="text-align:center;
        color:dodgerblue">Terms & Policies.</a></p>
</div>

<div id="popup1" class="overlay">
    <div class="popup">
        <a class="close" href="#">&times;</a>
        <div class="content" style="text-align:center;"> <b style="padding-top:-150px;">Our terms & policies: </b><br><br>
			When registering or ordering on our site you may be asked to enter your name, email, credit card information or other details to help you with
			your experience.<br>We may use such information to personalize user's experience and to allow us to deliver the type of
            content and product offerings in which you are most interested.<br>Don't worry, your information is safe with us.
			</div>
    </div>
</form>
</body>
</html>
