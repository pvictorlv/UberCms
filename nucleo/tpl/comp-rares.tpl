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
<div class="cbb clearfix white ">
  <div class="box-content" style="padding:0px !important;"><div class="smallprint">


   <div align="center"><a href="JavaScript:PopWindow()"></a>
<?php

if (isset($_POST['furni']) && is_numeric($_POST['furni']))
{
$fid = preg_replace("/[^0-9]/", "", addslashes(trim($_POST['furni'])));
$getBuyItem = db::query("SELECT * FROM shop_rares WHERE enabled = '1' and id = '".$fid."' ORDER BY order_id ASC");
$itemtobuy = mysql_fetch_assoc($getBuyItem);
$price = $itemtobuy['price'];
$furniid = $itemtobuy['furni'];
$caption = $itemtobuy['caption'];
$getCoins = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getCoins);
$coins1 = $b['VIP_Coins'];
$idusr = $b['id'];
if($coins1>=$price){
$final = $coins1-$price;
db::query("INSERT INTO items (user_id, room_id, base_item, x, y, z, rot, extra_data, wall_pos) values ('".$idusr."','0','".$furniid."','0','0','0','0','','')");
db::query("UPDATE users SET VIP_Coins='".$final."' WHERE username = '" .USER_NAME. "'");
echo "Ya tienes tu ".$caption." en el inventario, Felicidades!<br><a href='/shops/Rares'>Seguir Comprando ></a>";
}else{$error = "No tienes suficientes WIP Coins para comprar ".$caption."<br><a href='/shops/Rares'>Volver ></a>";echo $error;};

}else{


$getItems = db::query("SELECT * FROM shop_rares WHERE enabled = '1' ORDER BY order_id ASC");
$i=0;
while ($item = mysql_fetch_assoc($getItems))
{
if ($i%2==1)
	{
		$highlight = '#e6e6e6';
	}
	else
	{
		$highlight = '#fff';
        }; $i++;
	echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"  bgcolor="'.$highlight.'">
      <tbody>
<tr align="center"><td><div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(134, 206, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(134, 206, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div></div><h2 class="title rounded-done" style="background-color:#4AB501;color:#ffffff;">' . clean($item['caption']) . '</h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(134, 206, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(134, 206, 85);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(85, 186, 17);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(74, 181, 1);"></div></div></div></div></div></div></td></tr>
 </tbody></table>
<table width="100%" cellspacing="0" cellpadding="0" border="0"  bgcolor="'.$highlight.'">
      <tbody>
<tr align="center">
	<td ><img src="' . clean($item['image_url']) . '"></td>	
<td align="center"><b style="font-size:20px;">' . clean($item['price']) . ' Coins</b><br><form method="post"><input type="hidden" value="' . $item['id'] . '" name="furni"><input type="submit" class="new-button fill" value="Comprar Ahora"></form></td></tr>
 </tbody></table>
';
}

};
?><br>
   </div>
 </div></div>
	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>