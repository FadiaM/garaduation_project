<?php
session_start();
require 'db_connection.php';
require 'login.php';
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
<title>Login</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>
<body style="background-image: url('images/design/background.jpg'); background-size: 25%;">
<br>
<form action="" method="post" style="background-color:white; opacity:97%;">
<h1 style="text-align:center; color:black; background-color:white; margin-left: 0px;
margin-right: 0px; margin-top: 0px;"><b> KITCHEN ON WHEELS </b></h1>
<h2>Login</h2>
<div class="container">
<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter email" id="email" name="user_email" required>

<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter password" id="password" name="user_password" required>

<button type="submit" style="font-size:15px;">Login</button>
</div>
<?php
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
?>

<div class="container" style="opacity:90%; background-color:#f1f1f1;">
<p> Not a member?
<a href="signup_form.php"><button type="button" class="Regbtn" style="font-size:15px;">Sign Up</button></a></p>
<p> Forget your password?
<a href="Reset.php" style="text-align:center; color:dodgerblue;">Reset it here.</a></p>
</div>
</div>
</form>
</body>
</html>
