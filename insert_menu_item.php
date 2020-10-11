<?php
if(isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price'])){

// CHECK IF FIELDS ARE NOT EMPTY
if(!empty(trim($_POST['name'])) && !empty(trim($_POST['category'])) && !empty($_POST['price'])){

// Escape special characters.
$name = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['name']));
$category = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['category']));
$price = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['price']));

// choose upload directory
$target_dir = "images/menu/";

// create unique file name using timestamp and keeping the file extension
$temp = explode(".", $_FILES["image"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . $newfilename;

// flag used to validate the image
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && isset($_FILES['file'])) {

$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
// echo "File is an image - " . $check["mime"] . ".";
$uploadOk = 1;
} else {
// echo "File is not an image.";
$uploadOk = 0;
}
}

// image is valid, start upload
if ($uploadOk == 1) {

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
// image has been uploaded successfully

// get file name to save it in DB
$image = $newfilename;

// INSER USER INTO THE DATABASE
$insert_item = mysqli_query($db_connection, "INSERT INTO menu (name, category, price, image) VALUES ('$name', '$category', '$price', '$image')");

}
}

// success or not, go back to menu admin panel
header('Location: index.php');
exit;

}
}
?>
