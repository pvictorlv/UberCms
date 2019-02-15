<style type="text/css">
<!--
.buttonv4 {BORDER-RIGHT: #CCCCCC 1px solid; BORDER-TOP: #CCCCCC 1px solid; width:80px; FONT-WEIGHT: normal; FONT-SIZE: 10px; BORDER-LEFT: #CCCCCC 1px solid; CURSOR: pointer; COLOR: #000000; BORDER-BOTTOM: #CCCCCC 1px solid; FONT-FAMILY: Verdana; BACKGROUND-COLOR: #f5f5f5; border-radius: 1px; moz-border-radius: 1px; height:20px;
}
-->
</style>
<div class="habblet-container ">
<div class="cbb clearfix blue ">

<h2 class="title">Canjear Referidos</h2>

<div id="hotcampaigns-habblet-list-container">
<?php
if(isset($_POST['refer'])){if($_POST['refer'] == "50"){$amount = "1";$refersto = "50";}elseif($_POST['refer'] == "100"){$amount = "2";$refersto = "100";}elseif($_POST['refer'] == "150"){$amount = "3";$refersto = "150";}elseif($_POST['refer'] == "200"){$amount = "4";$refersto = "200";}elseif($_POST['refer'] == "250"){$amount = "5";$refersto = "250";}elseif($_POST['refer'] == "300"){$amount = "7";$refersto = "300";}elseif($_POST['refer'] == "400"){$amount = "10";$refersto = "400";}else{$amount = "0";$refersto = "99999999999";};
$query = mysql_query("SELECT COUNT(*) AS ospina FROM users_referidos WHERE usuario ='".USER_NAME."' ORDER BY ID") or die(mysql_error()); 
$data = mysql_fetch_assoc($query); $referidos = $data['ospina']; 	
					if(isset($referidos) && isset($amount)){		
					if($referidos >= $refersto){
						$getCoins = mysql_query("SELECT * FROM users WHERE username = '".USER_NAME."'");$b = mysql_fetch_assoc($getCoins);$coins1 = $b['coins'];
						$final = $coins1+$amount;
						dbquery("UPDATE users SET coins='".$final."' WHERE username = '" .USER_NAME. "'");
						dbquery("UPDATE users_referidos SET usuario='Alegames' WHERE usuario = '" .USER_NAME. "' ORDER BY id LIMIT ".$refersto."");
						$error = "Canjeo realizado con éxito.";
						}else{$error = "No Tienes Suficientes Referidos";};						
					}else{$error = "Ha ocurrido algún error, intenta de nuevo.";};
echo $error;
	}else{
$query = mysql_query("SELECT COUNT(*) AS ospina FROM users_referidos WHERE usuario ='".USER_NAME."' ORDER BY ID") or die(mysql_error()); $data = mysql_fetch_assoc($query); $referidos = $data['ospina']; 
		echo 'Ahora con esta opcion podras llamar a tus amigos, y con un monto minimo de 50 referidos podras cambiarlos por Coins, herramienta super util. Tienes <strong>'.$data['ospina'].'</strong> Referidos.<br><br><form action="" method="post" name="tranfer">
<center>Cantidad: <select name="refer">
<option value="50"> 1 Coin(s) x 50 referidos</option>
<option value="100"> 2 Coin(s) x 100 referidos</option>
<option value="150"> 3 Coin(s) x 150 referidos</option>
<option value="200"> 4 Coin(s) x 200 referidos</option>
<option value="250"> 5 Coin(s) x 250 referidos</option>
<option value="300"> 7 Coin(s) x 300 referidos</option>
<option value="400"> 10 Coin(s) x 400 referidos</option>
</select></center>
<br><center><input name="enviar" class="buttonv4" value="Canjear" type="submit"></center><br/>
</form>';};
					
?></div>
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>