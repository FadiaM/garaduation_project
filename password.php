<?php
session_start();
require 'db_connection.php';
require 'login.php';
include('app_logic.php');
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
<div class="container">

<label for="email"><b>Email</b></label>
<input type="email" placeholder="Enter email" id="email" name="user_email" required>
<br>
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="user_password" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
title="Must contain at least 8 or more characters, at least one number and one uppercase" required>
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="rest_password" placeholder="Re-Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
title="Must contain at least 8 or more characters, at least one number and one uppercase" required>
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
</div>
<?php 
if(isset($_POST['rest_password']) && isset($_POST['user_password']) && isset($_POST['user_email'])){
	$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));
	$rest_password=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['rest_password'])); 
	$user_password=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_password'])); 
// add confirm password to see if match with password
if ($_POST['user_password'] != $_POST['rest_password'])
	$error_message = "Password do not match.";	
else{
// IF EMAIL IS NOT REGISTERED, ENCRYPT USER PASSWORD USING PHP password_hash function 
$check_email = mysqli_query($db_connection, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email' ");
if(mysqli_num_rows($check_email) > 0){   
	$user_hash_password = password_hash($user_password, PASSWORD_DEFAULT);
$update_user = mysqli_query($db_connection, "UPDATE `users` SET `user_password`= '$user_hash_password' WHERE `user_email`='$user_email'");
if($update_user === TRUE){
 header('Location: login_form.php');
}
else{
$error_message = "Oops! something wrong.";
}
}else{
$error_message = "Invalid email";
}
}
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>';
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>';
}
}
?>
</div>
</div>
</form>
</body>
</html>
