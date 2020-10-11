<?php
session_start();
$_SESSION['current_page'] = 'cart.php';
require 'db_connection.php';

// CHECK USER IF LOGGED IN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);
}

// get all menu items from DB
$items = [];
$get_menu_items = mysqli_query($db_connection, "SELECT * FROM menu");
while($row = mysqli_fetch_assoc($get_menu_items)){
  $items[$row['id']] = $row;
}
$cartItems ='';
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
      padding-top: 60px;
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

    /* items style */
    .cart_item {
      display: flex;
      align-items: center;
      padding-bottom: 15px;
      border-bottom: 1px solid #ccc;
      margin-bottom: 15px;
    }

    .item_image {
      width: 100px;
      height: 100px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      object-fit: contain;
    }

    .item_title {
      flex-grow: 1;
      margin-left: 20px;
      display: flex;
      flex-direction: column;
      font-size: 1.2em;
    }

    .quantity_box {
      display: flex;
      margin: 0 10px;
    }

    .quantity_box > * {
      border: 1px solid #ccc;
    }


    .item_quantity {
      font-weight: bold;
      padding: 5px 10px;
    }

    @media (max-width: 550px) {
      .cart_item {
        flex-direction: column;
        text-align: center;
      }

      .item_title {
        margin: 0;
      }

      .quantity_box {
        margin-top: 5px;
      }
    }

    /* cart style */
    .cart_header {
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      font-size: 20px;
      margin-bottom: 15px;
    }

    .price_line {
      display: flex;
      margin-bottom: 5px;
      padding: 0 15px;
    }

    .price_line > div:first-child {
      flex-grow: 1;
    }

    #total {
      font-weight: bold;
      margin-top: 30px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<div class="sticky">
  <div class="active2 w3-bar w3-black w3-card">
  <div class="dropdown" style="float:left; overflow: hidden;"><a href="food.php">
        <img src="images/design/back.png" width="70" height="61" class="w3-button" style="display: inline-block; text-decoration: none;">
    </a></div>
  <div id="logo" style="position:absolute; top:3px; margin-left: 70px; "><a href="index.php"><img
                  src="images/design/logo.png" width="111" height="55"></a></div>
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
  <div class="m-4">
    <div class="form-row">
      <div class="col-md-8">
        <div id="items"></div>
      </div>
      <div class="form-group col-md-4">
        <div class="cart_header">Cart Totals</div>
        <div class="price_line" id="subtotal">
          <div>Subtotal</div>
          <div>0 JD</div>
        </div>
        <div class="price_line" id="tax">
          <div>Sales Tax</div>
          <div>0 JD</div>
        </div>
        <div class="price_line" id="total">
          <div>Total Amount</div>
          <div>0 JD</div>
        </div>
        <?php if(!isset($userData)): ?>
          <div style="text-align: center; margin-bottom: 5px;">Please <a href="login_form.php">Login</a> before you can checkout.</div>
        <?php endif ?>
        <button style="width:100%;" type="button" class="w3-button w3-blue w3-section " onclick="checkout()" <?php echo (!isset($userData)) ? 'disabled' : '' ?>>PROCEED TO CHECKOUT</button>
      </div>
    </div>
  </div>
</div>
<script>
  // pass items from PHP to JS
  var items = <?php echo json_encode($items);?>;

 // read cart from localstorage
  if (localStorage.cart) {
    // convert string to object
    var cart = JSON.parse(localStorage.cart);

    // render cart items
    var html = '';
    for (id in cart) {
      let item = items[id];
      let quantity = cart[id];
      html += '<div class="cart_item">';
      html += '<img class="item_image" src="images/menu/' + item['image'] + '">';
      html += '<div class="item_title">' + item['name'] + '</div>';
      html += '<div class="item_price">' + item['price'] + ' JD</div>';
      html += '<div class="quantity_box">';
      html += '<button type="button" class="btn btn-sm b-r" onclick="updateqty(' + id + ', -1)">';
      html += '<i class="fa fa-minus"></i></button>';
      html += '<span class="item_quantity" id="item-' + id + '">' + quantity + '</span>';
      html += '<button type="button" class="btn btn-sm b-l" onclick="updateqty(' + id + ', 1)">';
      html += '<i class="fa fa-plus"></i></button>';
      html += '<button type="button" class="btn btn-sm b-l" onclick="removeitem(' + id + ')">';
      html += '<i class="fa fa-times"></i></button>';
	  html += '<button id="cartItems" name="cartItems" hidden value="'+item['name']+': '+quantity+'">';

      html += '</div></div>';
    }
    $('#items').html(html);

    // calculate totals
    calctotals();
  } else {
    $('#items').html('<div style="text-align: center;"><h2>Your cart is empty.</h2></div>');
  }
  
  function removeitem(id){
    var newCart = {};
    for(cartId in cart){
      if(cartId != id){
        newCart[cartId] = cart[cartId]; }}
      // save cart in local storage
      localStorage.cart = JSON.stringify(newCart);
      location.reload(); }
    function checkout(){
		if(cart[id] > 0){
      localStorage.clear();
		window.alert("Your order will be prepared soon.");}
      location.reload(); }

  function updateqty(id, dir) {
    // calculate new quantity
    let qty = cart[id] + dir;

    // prevent less than 0
    if(qty >= 0) {
      // update item quantity
      $('#item-' + id).html(qty);

      // update cart array
      cart[id] += dir;

      // update totals
      calctotals();

      // save cart in local storage
      localStorage.cart = JSON.stringify(cart); }  }

  function calctotals() {
    // calc subtotal
    let subtotal = 0;
    for (id in cart) {
      let quantity = cart[id];
      let price = items[id]['price'];
      let item_total = quantity * price;
      subtotal += item_total;  }

    // calc tax
    let tax = subtotal * 0.16;

    // calc total
    let total = 0;
    if(subtotal > 0) {
      total = subtotal + tax;   }

    // round to 2 decimal places
    tax = Math.round(tax * 100) / 100;
    total = Math.round(total * 100) / 100;

    // update totals
    $('#subtotal > div:nth-child(2)').html(subtotal + ' JD');
    $('#tax > div:nth-child(2)').html(tax + ' JD');
    $('#total > div:nth-child(2)').html(total + ' JD'); }
</script>
</body> </html>
<?php
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);
$content= $itemName="";
foreach ($items as $item) {
$itemName=$item['name']; }
 $insert_catering_order = mysqli_query($db_connection, "INSERT INTO `cart` (user_email,items) VALUES ('$user_email','$itemName')"); }
?>
