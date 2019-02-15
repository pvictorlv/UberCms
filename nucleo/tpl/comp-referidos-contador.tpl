<!--
/*=======================================================================
| Agradecimiento a Juli0san por hacer SOLO ESTA PÁGINA, lo demás hecho por masacre10 
| Aporte para kekomundo ~ Gracias por no hacerme querer dar más aportes km!
| masacre_11@hotmail.com
\======================================================================*/
-->
<div class="habblet-container ">		
<div class="cbb clearfix settings "> 

<h2 class="title">Últimos referidos</h2>

<div class="box-content">

Hola <b>%habboname%</b>, actualmente tienes <b><?php 

if(!isset($_GET['n']))
{
$usuario = $_SESSION['UBER_USER_N'];
}
else
{
$usuario = mysql_real_escape_string($_GET['n']);
}
$query = mysql_query("SELECT COUNT(*) AS aantalleden FROM users_referidos WHERE usuario ='". $usuario ."' ORDER BY ID") or die(mysql_error()); 
        $data = mysql_fetch_assoc($query); echo $data['aantalleden']; 

?></b> puntos.




	</p>

</div>
	
</div>
</div>

<div class="habblet-container ">		
<div class="cbb clearfix orange "> 

<h2 class="title">Información</h2>

<div class="box-content">

Las multicuentas serán automáticamente baneadas permanentemente sin previo aviso y sin posible recuperación.

</div>
	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>