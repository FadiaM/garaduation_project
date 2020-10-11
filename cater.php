<?php
session_start();
$_SESSION['current_page'] = 'cater.php';
require 'db_connection.php';
// CHECK USER IF LOGGED IN
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
$user_email = $_SESSION['user_email'];
$get_user_data = mysqli_query($db_connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
$userData =  mysqli_fetch_assoc($get_user_data);
} else {
header('Location: login_form.php');
exit;
}
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1"/>
<title> Catering </title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jotfor.ms/static/formCss.css?3.3.15894" rel="stylesheet" type="text/css"/>
<link type="text/css" media="print" rel="stylesheet" href="https://cdn.jotfor.ms/css/printForm.css?3.3.15894"/>
<link type="text/css" rel="stylesheet" href="https://cdn.jotfor.ms/css/styles/nova.css?3.3.15894"/>
<link type="text/css" rel="stylesheet" href="https://cdn.jotfor.ms/themes/CSS/54be8eef700cc415378b456a.css?themeRevisionID=5cedbeaea0c8bc323340c421"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://cdn.jotfor.ms/static/prototype.forms.js" type="text/javascript"></script>
<script src="https://cdn.jotfor.ms/static/jotform.forms.js?3.3.15894" type="text/javascript"></script>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        html, body {
            min-height: 100%;
        }

        body, div, form, input, select, textarea, p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
        }

        h1 {
            position: absolute;
            margin: 0;
            font-size: 32px;
            color: #fff;
            z-index: 2;
        }

        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 20px;
        }

        form {
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

        .banner::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            width: 100%;
            height: 100%;
        }

        input, textarea, select {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input {
            width: calc(100% - 10px);
            padding: 5px;
        }

        select {
            width: 100%;
            padding: 7px 0;
            background: transparent;
        }

        textarea {
            width: calc(100% - 12px);
            padding: 5px;
        }

        .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
            color: #000000;
        }

        .item input:hover, .item select:hover, .item textarea:hover {
            border: 1px solid transparent;
            box-shadow: 0 0 6px 0 #000000;
            color: #000000;
        }

        .item {
            position: relative;
            margin: 10px 0;
        }

        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        .item i, input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            font-size: 20px;
            color: #a9a9a9;
        }

        .item i {
            right: 1%;
            top: 30px;
            z-index: 1;
        }

        [type="date"]::-webkit-calendar-picker-indicator {
            right: 0;
            z-index: 2;
            opacity: 0;
            cursor: pointer;
        }

        input[type="time"]::-webkit-inner-spin-button {
            margin: 2px 22px 0 0;
        }

        input[type=radio], input.other {
            display: none;
        }

        label.radio {
            position: relative;
            display: inline-block;
            margin: 5px 20px 10px 0;
            cursor: pointer;
        }

        .question span {
            margin-left: 30px;
        }

        label.radio:before {
            content: "";
            position: absolute;
            top: 2px;
            left: 0;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        #radio_5:checked ~ input.other {
            display: block;
        }

        input[type=radio]:checked + label.radio:before {
            border: 2px solid #000000;
            background: #FFFFFF;
        }

        label.radio:after {
            content: "";
            position: absolute;
            top: 7px;
            left: 5px;
            width: 7px;
            height: 4px;
            border: 3px solid #00000;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
            opacity: 0;
        }

        input[type=radio]:checked + label:after {
            opacity: 1;
        }
		
        .btn-block {
            margin-top: 10px;
            text-align: center;
        }

        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
		
        @media  {
            .name-item, .city-item {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .name-item input, .city-item input {
                width: calc(50% - 20px);
            }

            .city-item select {
                width: calc(50% - 8px);
            }

            label.radio, label.checkbox {
                position: relative;
                display: inline-block;
                margin: 5px 20px 15px 0;
                cursor: pointer;
            }

            input[type=radio], input[type=checkbox] {
                display: none;
            }

            label.radio, label.checkbox {
                position: relative;
                display: inline-block;
                margin: 5px 20px 15px 0;
                cursor: pointer;
            }

            .question span {
                margin-left: 30px;
            }

            label.radio:before, label.checkbox:before {
                content: "";
                position: absolute;
                left: 0;
                width: 17px;
                height: 17px;
                border-radius: 50%;
                border: 2px solid #ccc;
            }

            label.checkbox:before {
                border-radius: 5px
            }

            input[type=radio]:checked + label:before, label.radio:hover:before,
            input[type=checkbox]:checked + label:before, label.chekbox:hover:before {
                border: 2px solid #000000;
            }

            label.radio:after, label.checkbox:after {
                content: "";
                position: absolute;
                top: 6px;
                left: 5px;
                width: 8px;
                height: 4px;
                border: 3px solid #3263cd;
                border-top: none;
                border-right: none;
                transform: rotate(-45deg);
                opacity: 0;
            }

            input[type=radio]:checked + label:after, input[type=checkbox]:checked + label:after {
                opacity: 1;
            }
        }

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
		
		select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
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
    <form method="post">
        <div class="banner">
            <h1 style="line-height: 30px; font-family: Gabriola; font-size: 50px;"> KITCHEN ON WHEELS CATERING BOOKING FORM </h1>
        </div>
        <div class="item">
            <p>Events Date</p>
			<input id="datefield" type='date' name="Edate" min='' ></input>
            <i style="margin-right:30px;" class="fas fa-calendar-alt"></i>
        </div>
        <div class="item">
            <p>Events Time</p>
            <input type="time" name="Etime" >
            <i style="margin-right:30px;" class="fas fa-clock"></i>
        </div>
        <div class="item">
            <p>Select Events Type</p>
            <select name="selection" value="selection">
                <option value="" selected="true" disabled="disabled">Please select:</option>
                <option value="Birthday Party">Birthday Party</option>
                <option value="Open Day">Open Day</option>
                <option value="Meeting">Meeting</option>
                <option value="Graduation">Graduation</option>
                <option value="Baby Shower">Baby Shower</option>
                <option value="Bachelor Party">Bachelor Party</option>
				<option value="Weeding">Weeding</option>
                <option value="Other">Other...</option>
            </select>
        </div>
        <div class="item">
            <p>Events Theme (if any)</p>
            <input type="text" name="theme"/>
        </div>
        <div class="item">
            <p>Expected Number Of Attendance</p>
            <input type="number" min="1" max="1000" step="1" name="numberofAtt" >
        </div>
        <div class="question">
            <p>Any kind of special equipments do you need?</p>
            <div class="question-answer">
                <div>
                    <input type="checkbox" value="DJ" id="checkbox_1" name="contact1"/>
                    <label for="checkbox_1" class="checkbox"><span>DJ</span></label>
                </div>
                <div>
                    <input type="checkbox" value="Balloons" id="checkbox_2" name="contact2"/>
                    <label for="checkbox_2" class="checkbox"><span>Balloons</span></label>
                </div>
                <div>
                    <input type="checkbox" value="Beverage" id="checkbox_3" name="contact3"/>
                    <label for="checkbox_3"
                           class="checkbox"><span>Other supplies (plastic cups, dishes...)</span></label>
                </div>
            </div>
            <p>Any extra special equipments request?</p>
            <input type="text" name="special"/>
        </div>
        <div class="question">
            <p>Any extra food not from our menu?</p>
            <input type="text" name="special2"/>
        </div>
        <br>
	<div align="center">
            <button type="submit" name="submit" Value="submit" style="font-family: Gabriola; font-size: 20px;" class="btn btn-outline-primary">Confirm
			</button>
		 </div>
    </form>
</div>
</body>
<script type="text/javascript">
    JotForm.init(function () {
        JotForm.newDefaultTheme = false;
    });
	
	var today = new Date();
	var dd = today.getDate()+2;
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
	today = yyyy+'-'+mm+'-'+dd;
	document.getElementById("datefield").setAttribute("min", today);
	
    function handler() {
        alert("pick from menu");
    }

    function function_total() {
        var x, text;
        x = (parseInt(document.getElementById("Innovation").value));
        x += (parseInt(document.getElementById("Complexity").value));
        x += (parseInt(document.getElementById("Completeness").value));
        x += (parseInt(document.getElementById("Formatting").value));
        x += (parseInt(document.getElementById("Content_Rich").value));
        x += (parseInt(document.getElementById("Program").value));
        x += (parseInt(document.getElementById("Communication").value));
        x += (parseInt(document.getElementById("Content").value));
        x += (parseInt(document.getElementById("Questions").value));
        x += (parseInt(document.getElementById("Group").value));
        x += (parseInt(document.getElementById("Structure").value));

        if (isNaN(x) || x < 1 || x > 30) {
            text = "Input error";
        } else {
            text = "Input OK";
        }

        document.getElementById("total").innerHTML = x.toString();
    }
</script>
<?php

$EdateErr = $EtimeErr = $selectionErr = $numberofAttErr = $themeErr =$contactErr =$specialErr =$recordedErr = $if_yesErr ="";
$Edate = $Etime = $if_yes = $theme = $selection = $numberofAtt = $contact1 = $contact2 = $contact3 = $special = $recorded = $special2="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["Edate"])) {
    $Edate = trim($_POST["Edate"]);
	$Edate = date("Y-m-d",strtotime($Edate));
  } else {$Edate="";}
  
  if (!empty($_POST["Etime"])) {
    $Etime = trim($_POST["Etime"]);
	$Etime=date("h:i:sa",strtotime($Etime));
  } else {$Etime="";}
   
  if (!empty($_POST["selection"])) {
    $selection = trim($_POST["selection"]);
  } else {$selection="";}

  if (!empty($_POST["theme"])) {
    $theme = trim($_POST["theme"]);
  } else {$theme="";}

  if (!empty($_POST["numberofAtt"])) {
    $numberofAtt = trim($_POST["numberofAtt"]);
  } else {$numberofAtt="";}
  
   if (!empty($_POST["contact1"])) {
    $contact1 = trim($_POST["contact1"]);
  } else {$contact1="";}
  
  if (!empty($_POST["contact2"])) {
    $contact2 = trim($_POST["contact2"]);
  } else {$contact2="";}
  
  if (!empty($_POST["contact3"])) {
    $contact3 = trim($_POST["contact3"]);
  } else {$contact3="";}
  
   if (!empty($_POST["special"])) {
    $special = trim($_POST["special"]);
  } else {$special="";}
  
   if (!empty($_POST["special2"])) {
    $special2 = trim($_POST["special2"]);
  } else {$special2="";}
  
 $equipments="{$contact1},{$contact2},{$contact3}";
  
 $user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($userData['user_email']));

 $insert_catering_order = mysqli_query($db_connection, "INSERT INTO `catering` (user_email,date,time,type,theme,numberofAtt,equipment,specialEquipments,food) 
 VALUES ('$user_email','$Edate', '$Etime','$selection','$theme','$numberofAtt','$equipments','$special','$special2')");
}
?>
