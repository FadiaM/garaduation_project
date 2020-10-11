<?php
session_start();
$_SESSION['current_page'] = 'index.php';
require 'db_connection.php';
// CHECK USER IF LOGGED IN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);
if($userData['user_type'] == 'admin') {
    header('Location: adminindex.php');
    exit;
} 
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<style>
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

    .sticky + .w3-content {
        padding-top: 60px;
    }

    .active2 {
        top: 0;
        z-index: 10;
        margin: 0;
        padding: 0;
        height: 60px;
    }

    .responsive-font {
        font-size: 7vw;
    }

    .responsive-font2 {
        font-size: 4vw;
    }

    @media (max-width: 768px) {
        .w3-padding-64 {
            padding-top: 32px !important;
            padding-bottom: 32px !important;
        }

        .responsive-font {
            font-size: 11vw;
        }

        .responsive-font2 {
            font-size: 7vw;
        }
    }
	@media (max-width: 285px) {
          #logo {
            clip-path: inset(0px 111px 0px 0px);
          }
        }
		
		@media (min-width: 1200px) {
          #cater2 {
		margin-left:-200px;
          }
        }
		
		.fontt{
			  font-size: calc(20px + (26 - 14) * ((100vw - 300px) / (1600 - 300)));
		}		
</style>
<body>
<div id="main">
    <div class="sticky">
        <div class="active2 w3-bar w3-black w3-card">
            <div class="dropdown" style="float:left; overflow: hidden;">
                <a class="w3-bar-item w3-button w3-padding-large" style="font-size:25px"> &#9776; </a>
                <div class="dropdown-content"
                     style="width:140px; float:left; padding-left: 0px; font-family: monospace; position:absolute;">
                    <a class="w3-button" onclick="jumpTo('#home')">Home</a>
                    <a class="w3-button" onclick="jumpTo('#about_us')">About us</a>
                    <a class="w3-button" onclick="jumpTo('#the_menu')">The Menu</a>
                    <a class="w3-button" onclick="jumpTo('#find_us')">Find us</a>
                    <a class="w3-button" onclick="jumpTo('#catering')">Catering</a>
                    <a class="w3-button" onclick="jumpTo('#feedback')">Feedback</a>
                    <a class="w3-button" onclick="jumpTo('#contact')">Contact us</a>
                </div>
            </div>
			<div id="logo" style="position:absolute; top:3px; margin-left: 70px; "><a href="index.php"><img
                        src="images/design/logo.png" width="111" height="55"></a></div>
            <a class="active w3-bar-item" style="float:right; padding: 8px;" href="cart.php"><img src="images/design/cart.jpg" title="Your Basket" width="35" height="35"> </a>
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
    <div id="home" class="w3-content" style="font-family: Gabriola;max-width:2000px; ">
        <div class="mySlides w3-display-container w3-center">
            <img src="images/design/firstslide.jpg" style="width:100%">
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="images/design/secondslide.jpg" style="width:100%">
        </div>
		<div class="mySlides w3-display-container w3-center">
            <img src="images/design/thrdslide.jpg" style="width:100%">
        </div>
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px; font-family: Gabriola;"
             id="about_us">
            <a class="responsive-font" style="font-size:50px; font-family: Gabriola;">Who Are We?</a>
            <p class="w3-justify fontt" style="font-family: Gabriola;">With the increasing traffic jam in the
                city, having a quick and clean bite to eat is a great help especially if you have a tight schedule and want to eat quickly at any time
                and any meal. The need for it came from the problems faced through each meal you decided to buy rather than cooking it,
                 so you will reach and order in the fastest, easiest possible way.  And don't forget, we can come serve at your different events.</p>
        </div>
        <div style="background-image: url('images/design/menuslide.jpg'); background-size:100%; background-repeat:no-repeat; background-opacity:.9;
        background-position: center;" id="the_menu" class="w3-container t2">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
                <div class="w3-row-padding w3-padding-64 " style=" ">
                    <h2 class="responsive-font" style="color:white; text-align:center; font-family:Gabriola;">
                        <a href="food.php"><b> SEE OUR <br>MENU </b></h2>
                    </a>
                </div>
            </div>
        </div>
        <div id="find_us">
            <h2 class="responsive-font" style="color:black; text-align:center;  font-family: Gabriola;
            "><b>Find Trucks Location: </b></h2>
            <p style="background-image: url('images/design/locationslide.png'); background-position: center;  background-repeat: repeat-y; background-size:100%; text-align:center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3385.44077745358!2d35.89064861464214!3d31.94893683305199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca0f33d0576c5%3A0xd27c4f27fdf66534!2sAbdoun%20Cir.%2C%20Amman!5e0!3m2!1sen!2sjo!4v1573080857747!5m2!1sen!2sjo"
                        width="71%" height="360px" style="border:0;" allowfullscreen=""></iframe>
                <br> <br> </p>
        </div>
        <div style="background-image: url('images/design/caterslide.jpg'); background-repeat:no-repeat; background-opacity:.9;
        background-position: center;" id="catering" class="w3-container t2">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
                <div class="w3-row-padding w3-padding-64 " style=" ">
                    <h2 class="responsive-font" style="color:white; text-align:center; font-family:Gabriola;">
                        <a href="cater.php"><b> BOOK FOR <br>CATERING </b></h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="w3-black" id="feedback">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px;font-family: Gabriola;">
                <h2 class="responsive-font2" style="color:white; text-align:center;  font-family: Gabriola;"> Add Your Feedback: </h2>
                <form method="post" action="">
                    <label style="width:100%">
                        <input style="font-size: 20px;width:100%" class="w3-input w3-border w3-center" type="text" id="feed"
                               placeholder="write your feedback here" name="feedback" required>
                    </label><br>
					<?php if(!isset($userData)): ?>
                        <div style="font-family: Gabriola; font-size: 22px; text-align:center;">Please <a href="login_form.php">Login</a> first.</div>
                      <?php endif ?>
                    <button style="color:white; font-size: 20px; height:50px; width:100%" class="w3-button w3-black w3-section w3-center"
                            type="submit" <?php echo (!isset($userData)) ? 'disabled' : '' ?>>SEND</button>
					<?php
					if(isset($_POST['feedback']) ){
					$user_email = $_SESSION['user_email'];
					$feedback=mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['feedback'])); 
					if(!empty(trim($feedback))){
						$insert_user = mysqli_query($db_connection, "INSERT INTO `feedback` (useremail,feedback) VALUES ('$user_email', '$feedback')");
					}}
					?>
                </form>
            </div>
            <br>
        </div>
    </div>
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <div class="w3-col m6 w3-large w3-margin-bottom" id="contact" style="padding-top:5px;">
        <i class="fa fa-phone" style="width:30px"></i><a style="font-size: 25px; font-family: Gabriola;">Phone: </a><a
            style="font-size: 20px; font-family: Andalus;" id="myInput">079797979.<br></a>
        <i class="fa fa-envelope" style="width:30px" href="#"> </i><a
            style="font-size: 25px; font-family: Gabriola;"> Email:
        <a style="font-size: 25px; font-family: Gabriola;" id="myInput"> kitchenonwheels@mail.com.<br></a></a>
    </div>
	<a style="font-size: 25px; font-family: Gabriola;"> Follow us on social media: <br></a>
    <a title="Facebook" href="https://www.facebook.com/"> <i class="fa fa-facebook-official w3-hover-opacity" ></i></a>
    <a title="Instagram" href="https://www.instagram.com/"> <i class="fa fa-instagram w3-hover-opacity" ></i></a>
    <a title="Snapchat" href="https://www.snapchat.com/"> <i class="fa fa-snapchat w3-hover-opacity" ></i></a>
    <a title="Twitter" href="https://twitter.com/"> <i class="fa fa-twitter w3-hover-opacity" ></i></a>
</footer>
<script>
    function jumpTo(id) {
        $('html, body').animate({
            scrollTop: $(id).offset().top - 58
        }, 500);
    }

    var myIndex = 0;
carousel();
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) x[i].style.display = "none"; 
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}
</script>
</div>
</body>
</html>
