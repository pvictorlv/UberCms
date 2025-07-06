<?php

/*
If you need any help with the integration of PayGol in your system, 
please contact us at support@paygol.com or via Skype at paygol.com 
*/

//Probably you have to change this depending on your database connection and files
include("config_paypal.php");

// check that the request comes from PayGol server
if(!in_array($_SERVER['REMOTE_ADDR'],
array('109.70.3.48', '109.70.3.146', '109.70.3.58'))) {
header("HTTP/1.0 403 Forbidden");
die("Error: Unknown IP");
}



// read the get from PayGol system
$message_id = $_GET["message_id"];
$shortcode = $_GET['shortcode'];
$keyword = $_GET['keyword'];
$message = $_GET['message'];
$sender = $_GET['sender'];
$operator = $_GET['operator'];
$country = $_GET['country'];
$username = $_GET['custom'];
$price = $_GET['price'];
$currency = $_GET['currency'];
$days= $_GET['points'];


//Aqui puedes cambiar los dias que deseas dar
if($price=='1'){
  $coins = 5;
}elseif($price=='2'){
  $coins = 10;
}elseif($price=='3'){
  $coins = 20;
}elseif($price=='4'){
  $coins = 30;
}elseif($price=='5'){
  $coins = 40;
}elseif($price=='6'){
  $coins = 50;
}elseif($price=='7'){
  $coins = 60;
}elseif($price=='8'){
  $coins = 70;
}elseif($price=='9'){
  $coins = 80;
 }elseif($price=='12'){
  $coins = 90;
 }elseif($price=='15'){
  $coins = 120;
}


//echo 'coins'. $price;

//Inserta coins
$sql = "UPDATE users SET coins = coins+$coins WHERE id = '$username'";
echo $sql;
Db::query($sql);

?>