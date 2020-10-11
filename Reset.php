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
<title>Reset Password</title>
<link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>
<body style="background-image: url('images/design/background.jpg'); background-size: 25%;">
<br>
<form action="" method="post" style="background-color:white; opacity:97%;">
<h1 style="text-align:center; color:black; background-color:white; margin-left: 0px;
margin-right: 0px; margin-top: 0px;"><b> KITCHEN ON WHEELS </b></h1>

<h2>Reset Password</h2>
<div class="container">
<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter email" id="email" name="user_email" required>
<br>
<label for="password"><b>What are the last five digits of your nationality ID number?</b></label>
<input type="text" placeholder="Enter your nationality ID number last five digits" id="security_question" name="security_question" pattern="{5,}"  required>
<button type='submit' name='submit' value='Submit' style="font-size:15px;">Reset Password</button>
</div>

<?php
if(isset($_POST['user_email']) && isset($_POST['security_question']) ){
$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));
$security_question = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['security_question']));
$check_email_security_question = mysqli_query($db_connection, "SELECT `user_email`,`security_question` FROM `users` WHERE user_email = '$user_email' AND security_question = '$security_question' ");
if(mysqli_num_rows($check_email_security_question) > 0){   
header('Location: password.php');
}else{
$error_message = "Invalid email or security number";
}
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
}
?>
</form>
</body>
</html>
