<!--
/*=======================================================================
| Agradecimiento a Juli0san por hacer SOLO ESTA PÁGINA, lo demás hecho por masacre10 
| Aporte para kekomundo ~ Gracias por no hacerme querer dar más aportes km!
| masacre_11@hotmail.com
\======================================================================*/
-->
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>

<div class="habblet-container ">		
<div class="cbb clearfix red "> 

<h2 class="title">Chequeo de Online/Offline</h2>

<div class="box-content">

	<div align="center">
	<?php
	if(isset($_SESSION['UBER_USER_N'])){
	$sql = mysql_query("SELECT online FROM users WHERE username = '".$_SESSION['UBER_USER_N']."' LIMIT 1;");
$online = mysql_fetch_array($sql);
if($online['online'] == '1')
{
echo '<div class="error" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">';
echo '<h2>ALERTA</h2>';
echo 'Nuestro sistema ha detectado que estás online. Por favor desconectate del hotel antes de comprar para no tener problemas con la compra';
echo '</div>';
}
else
{
echo '<div class="goodmsg" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">';
echo '<h2>Bien hecho.</h2>';
echo 'Hemos detectado que estás fuera del hotel, puedes seguir con tu canjeo de referidos.</font>';
echo '</div>';
} 
}
?>
</div>
</div>
	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>