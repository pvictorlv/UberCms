<div class="habblet-container ">
<div class="cbb clearfix green ">
<h2 class="title">Top 5 - Monedas</h2>
<div class="box-content">
<table style="overflow: yes !important; width: auto; height: 1px;">
<?php
$datosTop = mysql_query("SELECT * FROM users ORDER BY VIP Coins DESC LIMIT 5");
while($datosTop10 = mysql_fetch_array($datosTop)){
echo '
<tr><td width="5px"></td>
<td width="20px">';

echo '<img src="http://www.habbo.com.es/habbo-imaging/avatarimage?figure=' . $datosTop10['look'] . '&direction=3&head_direction=3&gesture=sml&action=crr=2&size=s" align="left"></td> <td width="195px"><a href="%www%/home/'.$datosTop10['username'].'"><img src="http://ciudadhabbo.com/herramientas/index.php?h=volter"?t='.$datosTop10['username'].'&w=1&s=7" border="0"></a><br />'.$datosTop10['VIP Coins'].' VIP Coins';

echo '</td>
           
          ';
}
?>
</table>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>