<?php
session_start();
require_once("../global.php");
if(isset($_POST['optionNumber'])){
$plantogive = $_POST['optionNumber'];
if($plantogive == "1"){
$price = "15";
$dias = "31";
$image = "/web-gallery/v2/images/club/habboclub_basic_small.png";
$text = "Habbo Club";
$money = "1";
$mes = "1";
}elseif($plantogive == "2"){
$price = "45";
$dias = "93";
$mes = "3";
$image = "/web-gallery/v2/images/club/habboclub_basic_small.png";
$text = "Habbo Club";
$money = "1";
}elseif($plantogive == "3"){
$price = "30";
$dias = "31";
$image = "/web-gallery/v2/images/club/habboclub_vip_small.png";
$text = "VIP";
$money = "2";
$mes = "1";
}elseif($plantogive == "4"){
$price = "50";
$dias = "93";
$image = "/web-gallery/v2/images/club/habboclub_vip_small.png";
$text = "VIP";
$money = "2";
$mes = "3";
}else{echo 'Error procesando tu solicitud.';};
if(isset($money) && $money == "1" ){
if(isset($mes)){
$meses = addslashes(trim($mes));
if($meses == "1"){$days = "31";$amount = $price;}elseif($meses == "3"){$days = "90";$amount = $price;}elseif($meses == "6"){$days = "180";$amount = $price;}elseif($meses == "12"){$days = "360";$amount = $price;}else{$error = "El Pack de HC elegido no existe.";echo $error;};
$getCoins = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getCoins->fetch(PDO::FETCH_ASSOC);
$coins1 = $b['credits'];
$id = $b['id'];
if($coins1>=$amount){
$final = $coins1-$amount;
$vip_end = time() + ($days*24*3600);
$vip_ini = time();
$check  = db::query("SELECT user_id, timestamp_expire FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_club' ORDER BY timestamp_expire DESC LIMIT 1");
$total_records = $check->rowCount();
if ($total_records>0){
$row = $check->fetch(PDO::FETCH_ASSOC);
$current_exp = $row['timestamp_expire'];
if($current_exp > time()){
$vip_end = $vip_end + ($current_exp - time());}};
db::query("DELETE FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_club'");
db::query("INSERT INTO user_subscriptions(user_id, subscription_id, timestamp_activated, timestamp_expire) VALUES ('".$id."', 'habbo_club', '".$vip_ini."', '".$vip_end."')");
db::query("UPDATE users SET credits='".$final."' WHERE username = '" .USER_NAME. "'");
echo '<p><b>Gracias por suscribirte como HC</b></p>
<p>Tu suscripci�n al Habbo Club ha sido activada.</p>
<p><a href="#" onclick="habboclub.closeSubscriptionWindow();return false;" class="new-button"><b>Ok</b><i></i></a></p>
<div class="clear"></div>';
}else{echo '<img src="web-gallery/images/piccolo_unhappy.gif" alt="" align="left" style="margin:10px;" />
<p>Error al realizar la compra. Por favor, int�ntalo de nuevo.</p>
 <p>No hay Cr�ditos suficientes. S�lo tienes '.$coins1.' Cr�ditos, y necesitas '.$amount.'.<br /></p>
 <p>Consigue unos Cr�ditos y forma parte del Habbo Club<br /></p>
 <p><a href="credits" onclick="habboclub.closeSubscriptionWindow();return true;" class="new-button"><b>Obtener Cr�ditos</b><i></i></a></p>
<div class="clear"></div>';};
}else{echo 'Error procesando tu solicitud.';};
}elseif(isset($money) && $money == "2" ){
if(isset($mes)){
$meses = addslashes(trim($mes));
if($meses == "1"){$days = "31";$amount = $price;}elseif($meses == "3"){$days = "90";$amount = $price;}elseif($meses == "6"){$days = "180";$amount = $price;}elseif($meses == "12"){$days = "360";$amount = $price;}else{$error = "El Pack de VIP elegido no existe.";echo $error;};
$getCoins = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getCoins->fetch(PDO::FETCH_ASSOC);
$coins1 = $b['coins'];
$id = $b['id'];
if($coins1>=$amount){
$final = $coins1-$amount;
$vip_end = time() + ($days*24*3600);
$vip_ini = time();
$check  = db::query("SELECT user_id, timestamp_expire FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_vip' ORDER BY timestamp_expire DESC LIMIT 1");
$total_records = $check->rowCount();
if ($total_records>0){
$row = $check->fetch(PDO::FETCH_ASSOC);
$current_exp = $row['timestamp_expire'];
if($current_exp > time()){
$vip_end = $vip_end + ($current_exp - time());}};
db::query("DELETE FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_vip'");
db::query("INSERT INTO user_subscriptions(user_id, subscription_id, timestamp_activated, timestamp_expire) VALUES ('".$id."', 'habbo_vip', '".$vip_ini."', '".$vip_end."')");
db::query("UPDATE users SET coins='".$final."' WHERE username = '" .USER_NAME. "'");
echo '<p><b>Gracias por suscribirte como VIP</b></p>
<p>Tu suscripci�n al VIP ha sido activada.</p>
<p><a href="#" onclick="habboclub.closeSubscriptionWindow();return false;" class="new-button"><b>Ok</b><i></i></a></p>
<div class="clear"></div>';
}else{echo '<img src="web-gallery/images/piccolo_unhappy.gif" alt="" align="left" style="margin:10px;" />
<p>Error al realizar la compra. Por favor, int�ntalo de nuevo.</p>
 <p>No hay Coins suficientes. S�lo tienes '.$coins1.' Coins, y necesitas '.$amount.'.<br /></p>
 <p>Consigue unos Croins y forma parte del VIP<br /></p>
 <p><a href="credits" onclick="window.location = \'http://onpixels.info/shop/Tienda\'" class="new-button"><b>Obtener Coins</b><i></i></a></p>
<div class="clear"></div>';};
}else{echo 'Error procesando tu solicitud.';};

};


}else{echo 'Error procesando tu solicitud.';};


?>