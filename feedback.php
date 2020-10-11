<?php
session_start();
require 'db_connection.php';
$_SESSION['current_page'] = 'adminorders.php';
// CHECK USER IF LOGGED IN AND ADMIN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
  $user_email = $_SESSION['user_email'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
  $userData =  mysqli_fetch_assoc($get_user_data);

  // prevent access if user not admin
  if($userData['user_type'] != 'admin') {
    header('Location: index.php');
    exit;
  }
} else {
  header('Location: login_form.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1"/>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <style>

  </style>
</head>

<body style= "text-align: center; font-family: monospace;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
		<li class="nav-item">
          <a class="nav-link" href="adminindex.php">Menu</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link"> feedback <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminorders.php">Orders</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="catering.php">Catering</a>
        </li>
      </ul>
	     <div class="dropdown-content" style="font-family: ; width:175px; right: 0; padding-right: 0px; color: white;">
              <?php if(!isset($userData)): ?>
              <a href="login_form.php" class="  w3-button ">Login</a>
              <?php else: ?>
              <a id="drop1">Hello <?php echo $userData['username'];?>.</a><br>
              <a href="logout.php" class="  w3-button ">Sign out</a>
              <?php endif ?>
    </div>
    </div>
  </nav>
<?php
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `feedback`");
while($userData =  mysqli_fetch_assoc($get_user_data)){
foreach($userData as $value){
    echo $value, '<br>';
}
	echo '<br>', "**********************************************************", '<br>';
}
?> 
</body>
</html>
