<div class="habblet-container ">		
<div class="cbb clearfix blue "> 
<h2 class="title">Ricos en creditos</h2> 
<div class="box-content">
<center>
<table>
<?php
$datosTop = mysql_query("SELECT * FROM users ORDER BY activity_points DESC LIMIT 5");
while($datosTop10 = mysql_fetch_array($datosTop)){
echo '
<tr><td width="5px"></td>
<td width="20px">';
echo '<img src="%www%/habbo-imaging/avatarimage.php?figure=' . $datosTop10['look'] . '&direction=3&head_direction=3&gesture=sml&action=crr=2&size=s" align="left"title="El es uno de los más ricos"/></td> <td width="195px"><a href="%www%/home/'.$datosTop10['username'].'">'.$datosTop10['username'].'</a><br />'.$datosTop10['credits'].' creditos';
echo '</td>
           
          ';
}
?>
</table>
</div>
</div>
</div>