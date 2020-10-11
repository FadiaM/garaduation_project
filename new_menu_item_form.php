<?php
session_start();
require 'db_connection.php';
require 'insert_menu_item.php';
$_SESSION['current_page'] = 'new_menu_item_form.php';
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        #upload_preview {
            height: 100%;
            min-height: calc(100vh - 220px);
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-left: 20px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

            #upload_preview img {
                width: 100%;
                height: 300px;
                object-fit: contain;
            }

            #upload_preview div {
                display: none;
            }

            #upload_preview.no_image img {
                display: none;
            }

            #upload_preview.no_image div {
                display: block;
            }

        @media (max-width: 768px) {
            #upload_preview {
                margin-left: 0;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body style=" font-family: monospace;">
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
        <form method="post" name="NewMenuItemForm" enctype="multipart/form-data">
            <h3>
                <span>New Menu Item</span>
                <a class="btn btn-outline-secondary" href="index.php">Back</a>
                <input type="submit" class="btn btn-primary" name="submit" value="submit" />
            </h3>
            <div class="form-row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="Salads">Salads</option>
                            <option value="Appetizers">Appetizers</option>
                            <option value="Pizzas">Pizzas</option>
                            <option value="Beef Burgers">Beef Burgers</option>
                            <option value="Chicken Burgers">Chicken Burgers</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Desserts">Desserts</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (JD)</label>
                        <input type="number" class="form-control" id="price" name="price" required min="0">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <input type="file" name="image" accept="image/*" onchange="uploadPreview(event)" style="display: none;" id="upload_input" required>
                    <div id="upload_preview" class="no_image">
                        <div>Image</div>
                        <img />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
    // preview image
    var uploadPreview = function(event) {
      if (event.target.files[0]) {
        $('#upload_preview img').attr('src', URL.createObjectURL(event.target.files[0]));
        $('#upload_preview').removeClass("no_image");
      } else {
        $('#upload_preview img').removeAttr("src");
        $('#upload_preview').addClass("no_image");
      }
    };
    $('#upload_preview').click(function() {
      $('#upload_input').click();
    });
    </script>
</body>
</html>
