<?php
session_start();
$_SESSION['current_page'] = 'food.php';
require 'db_connection.php';

if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);
}

$items = [];
$get_menu_items = mysqli_query($db_connection, "SELECT * FROM menu ORDER BY name");
while($row = mysqli_fetch_assoc($get_menu_items)){
  $items[$row['category']][] = $row;
}

$categories = array("Salads", "Appetizers", "Pizzas", "Beef Burgers", "Chicken Burgers", "Drinks", "Desserts");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> The Menu </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style type="text/css">
        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 20px;
        }

        .cont {
            width: 100%;
            padding: 20px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 0 20px 0 #696969;
        }

        .banner {
            position: relative;
            height: 210px;
            background-image: url('images/design/background.jpg');
            background-size: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .banner > h1 {
          color: white;
          z-index: 2;
        }

        .banner::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            width: 100%;
            height: 100%;
        }

        /* top bar style */
        .active {
            display: block;
            color: white;
            text-align: center;
            font-size: 25px;
            margin-right: 10px;
        }

        .dropdown-content {
            display: none;
            background-color: #f1f1f1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            position: absolute;
            top: 60px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 12px;
            text-decoration: none;
            display: block;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 12px 12px;
            margin: 0;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 12px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #drop1 {
            background-color: black;
            color: white;
        }

        .sticky {
          position: fixed;
          z-index: 10;
          width: 100%;
        }

        .sticky + .testbox {
          padding-top: 80px;
        }

        .active2 {
            top: 0;
            z-index: 10;
        		margin: 0;
            padding: 0;
            height: 60px;
        }

        @media (max-width: 285px) {
          #logo {
            clip-path: inset(0px 111px 0px 0px);
          }
        }

        /* Menu styles */
        .card-header {
          cursor: pointer;
          position: relative;
        }

        .card-header::after {
        	content: "\f106";
        	color: #333;
        	position: absolute;
          top: 30%;
          right: 3%;
          font-family: "FontAwesome";
          font-size: 1.3em;
          font-weight: 900;
        }

        .card-header[aria-expanded="false"]::after {
        	content: "\f107";
        }

        .panel-title {
          font-size: 22px;
          padding: 7px 0;
        }

        .menu_item {
          display: flex;
          align-items: center;
          padding-bottom: 15px;
          border-bottom: 1px solid #ccc;
          margin-bottom: 15px;
        }

        .item_image {
          width: 200px;
          height: 200px;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          object-fit: contain;
        }

        .item_text {
          flex-grow: 1;
          margin-left: 20px;
          display: flex;
          flex-direction: column;
          font-size: 1.2em;
        }

        .item_options {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .added {
          display: none;
        }

        @media (max-width: 550px) {
          .menu_item {
            flex-direction: column;
            text-align: center;
          }

          .item_text {
            margin: 0;
          }
        }
    </style>
</head>
<body>
<div class="sticky">
  <div class="active2 w3-bar w3-black w3-card">
      <div class="dropdown" style="float:left; overflow: hidden;"><a href="index.php">
          		<img src="images/design/back.png" width="70" height="61" class="w3-button" style="display: inline-block; text-decoration: none;">
          </a></div>
      <div id="logo" style="position:absolute; top:3px; margin-left: 70px; "><a href="index.php"><img
                        src="images/design/logo.png" width="111" height="55"></a></div>
      <a class="active w3-bar-item" style="float:right; padding: 8px;" href="cart.php"><img src="images/design/cart.jpg" 
	  title="Your Basket" width="35" height="35"> </a>
      <div class="dropdown" style="float:right; overflow: hidden; position: unset;">
          <a class="active w3-bar-item" style="float:right; padding: 8px 0; height: 60px;"><img src="images/design/people.jpg" width="35" height="35"> </a>
          <div class="dropdown-content" style="font-family: monospace; width:175px; right: 0; padding-right: 0px;">
                    <?php if(!isset($userData)): ?>
                    <a href="login_form.php" class="  w3-button ">Login</a>
                    <?php else: ?>
                    <a id="drop1">Hello <?php echo $userData['username'];?>.</a>
                    <a href="logout.php" class="  w3-button ">Sign out</a>
                    <?php endif ?>
          </div>
      </div>
  </div>
</div>
<div class="testbox">
  <div class="cont">
    <div class="banner">
      <h1 style="font-size:50px; font-family: Gabriola; line-height: 30px;"> KITCHEN ON WHEELS MENU </h1>
    </div>
    <div class="accordion mt-4">
      <?php foreach ($categories as $category): ?>
        <div class="card">
          <div class="card-header" id="<?php echo 'heading-'.$category; ?>" data-toggle="collapse" data-target="<?php echo '#collapse-'.$category; ?>">
            <h2 class="mb-0">
              <div class="panel-title" aria-expanded="true" aria-controls="<?php echo 'collapse-'.$category; ?>">
                <?php echo $category; ?>
              </div>
            </h2>
          </div>
          <div id="<?php echo 'collapse-'.$category; ?>" class="collapse show" aria-labelledby="<?php echo 'heading-'.$category; ?>">
            <div class="card-body">
              <?php if (array_key_exists($category, $items)): ?>
                <?php foreach ($items[$category] as $item): ?>
                  <div class="menu_item">
                    <img class="item_image" src="<?php echo 'images/menu/'.$item['image']; ?>">
                    <div class="item_text">
                      <div class="item_title"><?php echo $item['name']; ?></div>
                      <div class="item_description">
                        <span><?php echo $item['price']; ?></span>
                        <span> JDs</span>
                      </div>
                    </div>
                    <div class="item_options">
                      <button
                      type="button"
                      name="id"
                      value="<?php echo $item['id']; ?>"
                      onclick="addToCart(<?php echo $item['id']; ?>)"
                      class="btn btn-outline-primary">Add To Cart</button>
                      <div id="<?php echo 'item-'.$item['id']; ?>" class="added">
                        <span>Added: </span>
                        <span>0</span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div>No Items Available.</div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div> <br>
	<div align="center">
                      <?php if(!isset($userData)): ?>
                        <div style="font-family: Gabriola; font-size: 22px; ">Please <a href="login_form.php">Login</a> before you can checkout.</div>
                        <br>
                      <?php endif ?> <a href="cart.php">
                      <button type="submit" name="submit" Value="submit" style="font-family: Gabriola; font-size: 20px;" class="btn btn-outline-primary"
					  >Go To Your Basket</button></a>
		 </div>
  </div>
</div>
<script>
  // read cart from localstorage
  if (localStorage.cart) {
    // convert string to object
    var cart = JSON.parse(localStorage.cart);

    // view cart items quantity
    for (id in cart) {
      // show added counter
      $('#item-' + id).show();
      $('#item-' + id + ' span:nth-child(2)').html(cart[id]);
    }
  } else {
    var cart = {};
  }

  function addToCart(id) {
    // show added counter (if not already visible)
    $('#item-' + id).show();

    // update added counter
    $('#item-' + id + ' span:nth-child(2)').html(parseInt($('#item-' + id + ' span:nth-child(2)').html()) + 1);

    // add to cart array
    if(cart[id]) {
      cart[id]++;
    } else {
      cart[id] = 1;
    }

    // save cart in local storage
    localStorage.cart = JSON.stringify(cart);
  }
</script>
</body>
</html>
