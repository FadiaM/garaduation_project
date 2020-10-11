<?php
session_start();
require 'db_connection.php';
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

  // CHECK IF FIELDS ARE NOT EMPTY
  if(isset($_POST['id']) && !empty(trim($_POST['id']))){

    // validate input
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // get image name to delete it
    $get_item_data = mysqli_query($db_connection, "SELECT image FROM menu WHERE id = '$id'");
    $item =  mysqli_fetch_assoc($get_item_data);

    // delete the image
    if ($item['image']) {
      unlink('images/menu/'.$item['image']) or die("Couldn't delete file");
    }

    // delete the data
    $delete_item_data = mysqli_query($db_connection, "delete from menu WHERE id = '$id'");
  }
  header('Location: adminindex.php');
  exit;
} 
else {
  header('Location: index.php');
  exit;
}
?>
