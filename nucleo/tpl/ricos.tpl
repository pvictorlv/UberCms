<style type="text/css">



    #playground, #playground-outer {

	    width: 922px;

	    height: 1360px;

    }



</style>

<div class="habblet-container ">		
<div class="cbb clearfix orange "> 
</center>
<h2 class="title">Ricos en píxeles</h2> 
<center>
<div class="box-content">
<table>
<?php
$datosTop = mysql_query("SELECT * FROM users ORDER BY activity_points DESC LIMIT 5");
while($datosTop10 = mysql_fetch_array($datosTop)){
echo '
<tr><td width="5px"></td>
<td width="20px">';
echo '<img src="%www%/habbo-imaging/avatarimage.php?figure=' . $datosTop10['look'] . '&direction=3&head_direction=3&gesture=sml&action=crr=2&size=s" align="left"title="El es uno de los más ricos"/></td> <td width="195px"><a href="%www%/home/'.$datosTop10['username'].'">'.$datosTop10['username'].'</a><br />'.$datosTop10['activity_points'].' píxeles';
echo '</td>
           
          ';
}
?>
</center>
</table>
</div>
</div>
</div>