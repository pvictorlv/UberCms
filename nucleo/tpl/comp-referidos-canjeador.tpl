<div class="habblet-container ">		
<div class="cbb clearfix red "> 

<h2 class="title">Canjeador</h2>

<div class="box-content">
	
	<p>
		Cuando lleves una cuenta considerable (<b>20+</b>) de referidos. Podras canjear tus referidos por: <b>Publicista</b><br><br>

Llevas un total de:

<b><?php 

if(!isset($_GET['n']))
{
$usuario = $_SESSION['UBER_USER_N'];
}
else
{
$usuario = mysql_real_escape_string($_GET['n']);
}

$query = mysql_query("SELECT COUNT(*) AS aantalleden FROM users_referidos WHERE usuario ='". $usuario ."' ORDER BY ID") or die(mysql_error()); 
        $data = mysql_fetch_assoc($query); echo $data['aantalleden'];?></b>
		
		<center>
		<?php if($data['aantalleden'] >= 2) { ?>
		<form action="#" method="post"><input type="hidden" name="rango" id="rango"><input type="submit" name="button" value="Canjear"></a>
		<?php } else { ?>
		<b>Aun no tienes los referidos necesarios</b></center>
		
		<?php } if(isset($_POST['rango'])) {
       	$contadorsql = mysql_query("SELECT * FROM users_referidos WHERE usuario = '$usuario'"); 
		$userCanjear = mysql_query("SELECT * FROM users WHERE username = 'usuario'");
		$Ucontador = mysql_fetch_array($userCanjear);
		if(mysql_num_rows($contadorsql) >= 20) {
		if($Ucontador['vip'] == 20) {
		mysql_query("UPDATE users SET vip= '1' WHERE username = '$usuario'");
		mysql_query("DELETE FROM users_referidos WHERE usuario = '$usuario' LIMIT 20");
		echo '<br><font color="green"<b>Haz canjeado tus referidos<b></font>';
		} else {
		echo '<br><font color="red"><b>No se pudieron cambiar poque ya eres VIP</b></font>';
		} } 
        echo '<br><font color="red"><b>No tienes los referidos necesarios</b></font>';
		} ?>
	</p>


</div>	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>