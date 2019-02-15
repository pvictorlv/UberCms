<style type="text/css">
<!--
.buttonv4 {BORDER-RIGHT: #CCCCCC 1px solid; BORDER-TOP: #CCCCCC 1px solid; width:70px; FONT-WEIGHT: normal; FONT-SIZE: 10px; BORDER-LEFT: #CCCCCC 1px solid; CURSOR: pointer; COLOR: #000000; BORDER-BOTTOM: #CCCCCC 1px solid; FONT-FAMILY: Verdana; BACKGROUND-COLOR: #f5f5f5; border-radius: 1px; moz-border-radius: 1px; height:20px;
}
.Estilo1 {
	font-size: 10px;
	
	font-style: italic;
	color: #000000;
}
-->
</style>
	
<div class="habblet-container ">		
<div class="cbb clearfix red "> 

<h2 class="title">Comprar VIP </h2>

<div class="box-content"><div class="smallprint">


   <div align="center"><a href="JavaScript:PopWindow()"></a>
<?php
if(isset($_POST['mesvip'])){
$meses = addslashes(trim($_POST['mesvip']));
if($meses == "1"){$days = "31";$amount = "30";}elseif($meses == "3"){$days = "90";$amount = "50";}elseif($meses == "6"){$days = "180";$amount = "70";}elseif($meses == "12"){$days = "360";$amount = "90";}else{$error = "El Pack de VIP elegido no existe.";echo $error;};
$getCoins = dbquery("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getCoins);
$coins1 = $b['VIP_Coins'];
$id = $b['id'];
if($coins1>=$amount){
$final = $coins1-$amount;
$vip_end = time() + ($days*24*3600);
$vip_ini = time();
$check  = dbquery("SELECT user_id, timestamp_expire FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_vip' ORDER BY timestamp_expire DESC LIMIT 1");
$total_records = mysql_num_rows($check);

if ($total_records>0){
$row = mysql_fetch_assoc($check);
$current_exp = $row['timestamp_expire'];
if($current_exp > time()){
$vip_end = $vip_end + ($current_exp - time());}};

dbquery("UPDATE users SET vip = '1' WHERE id=".$id."");
dbquery("DELETE FROM user_subscriptions WHERE user_id=".$id." AND subscription_id='habbo_vip'");
dbquery("INSERT INTO user_subscriptions(user_id, subscription_id, timestamp_activated, timestamp_expire) VALUES ('".$id."', 'habbo_vip', '".$vip_ini."', '".$vip_end."')");
dbquery("UPDATE `users` SET `VIP_Coins`='".$final."' WHERE username = '" .USER_NAME. "'");
echo 'Felicidades '.USER_NAME.', Compra realizada con éxito';
}else{$error = "No tienes suficientes coins.";echo $error;};
}else{echo '<form method="POST" name="buyvip"><select name="mesvip"><option selected="selected" value="1">1 Mes 30 Coins</option><option value="3">3 Meses 50 Coins</option><option value="6">6 Meses 70 Coins</option><option value="12">1 Año 90 Coins</option></select><input name="enviar" class="buttonv4" value="Comprar" type="submit"></form>';};
					
?><br>
   </div>
 </div></div>
	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>