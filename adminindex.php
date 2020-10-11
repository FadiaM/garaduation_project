<?php
session_start();
require 'db_connection.php';
$_SESSION['current_page'] = 'adminindex.php';
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

  // get all menu items from DB
  $items = [];
  $get_menu_items = mysqli_query($db_connection, "SELECT * FROM menu ORDER BY name");
  while($row = mysqli_fetch_assoc($get_menu_items)){
    $items[$row['category']][] = $row;
  }

  // define categories
$categories = array("Salads", "Appetizers", "Pizzas", "Beef Burgers", "Chicken Burgers", "Drinks", "Desserts");

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
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <style>
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
      margin-left: 20px;
      display: flex;
      flex-direction: column;
      font-size: 1.2em;
    }

    .item_options {
      flex-grow: 1;
      display: flex;
      justify-content: flex-end;
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

<body style= " font-family: monospace;" > 
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
		<li class="nav-item active">
          <a class="nav-link">Menu <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="feedback.php"> feedback </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminorders.php">Orders</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="catering.php">Catering</a>
        </li>
      </ul>
	     <div class="dropdown-content" style="font-family: monospace; width:175px; right: 0; padding-right: 0px; color: white;">
              <?php if(!isset($userData)): ?>
              <a href="login_form.php" class="  w3-button ">Login</a>
              <?php else: ?>
              <a id="drop1">Hello <?php echo $userData['username'];?>.</a><br>
              <a href="logout.php" class="  w3-button ">Sign out</a>
              <?php endif ?>
    </div>
    </div>
  </nav>

  <div class="m-5">
    <h3>
      <span>Menu Items</span>
      <a class="btn btn-outline-primary" href="new_menu_item_form.php">Add New Item</a>
    </h3>

    <form action="delete_menu_item.php" method="post">
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
                          <span> JD</span>
                        </div>
                      </div>
                      <div class="item_options">
                        <button
                        type="submit"
                        name="id"
                        value="<?php echo $item['id']; ?>"
                        onclick="return confirm('Are you sure to delete item: <?php echo $item['name']; ?> ?')"
                        class="btn btn-outline-danger">Delete</button>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div>No Items Available..</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </form>
  </div>
</body>
</html>
