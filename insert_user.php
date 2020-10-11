<?php
$error_message=False;
if(isset($_POST['username']) && isset($_POST['phone']) && isset($_POST['security_question']) && isset($_POST['user_email']) && isset($_POST['user_password'])){
if(!empty(trim($_POST['username'])) && !empty(trim($_POST['phone'])) && !empty(trim($_POST['security_question'])) && !empty(trim($_POST['user_email'])) && !empty($_POST['user_password'])){
// Escape special characters.
$username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['username']));
$user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));
$phone=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['phone']));
$security_question=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['security_question']));
//IF EMAIL IS VALID
if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {  
// CHECK IF EMAIL IS ALREADY REGISTERED
$check_email = mysqli_query($db_connection, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email'");
if(mysqli_num_rows($check_email) > 0){    
$error_message = "This email is already registered. Please login or try another email.";
}
else{
	$rest_password=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['rest_password'])); 
	$user_password=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_password'])); 
// add confirm password to see if match with password
if ($_POST['user_password'] != $_POST['rest_password']) $error_message = "Password do not match.";	
	
// IF EMAIL IS NOT REGISTERED, ENCRYPT USER PASSWORD USING PHP password_hash function 
$user_hash_password = password_hash($user_password, PASSWORD_DEFAULT);

// INSER USER INTO THE DATABASE
if($error_message === False){
$insert_user = mysqli_query($db_connection, "INSERT INTO `users` (username,phone_number,security_question, user_email, user_password) VALUES ('$username', '$phone','$security_question','$user_email', '$user_hash_password')");

if($insert_user === TRUE){
$success_message = "Thanks! You have successfully signed up. Now go to login page please!";
}
else{
$error_message = "Oops! something wrong.";
}
}
}    
}
else {
// IF EMAIL IS INVALID
$error_message = "Invalid email address.";
}
}
else{
// IF FIELDS ARE EMPTY
$error_message = "Please fill in all the required fields.";
}
}
?>
