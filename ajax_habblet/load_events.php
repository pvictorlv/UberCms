<ul class="habblet-list">
<?php
session_start();
require_once("../global.php");
if($_POST['eventTypeId']){$category = $_POST['eventTypeId'];}else{$category = "4";};
if($category == "1" || $category == "3" || $category == "4" || $category == "5" || $category == "6" || $category == "7" || $category == "8" || $category == "9" || $category == "10" || $category == "14"){
$buscarsalas = dbquery("SELECT * FROM rooms WHERE category = '".$category."' AND users_now > '0' ORDER BY users_now DESC LIMIT 0,10");
$i=0;
$num_rows = mysql_num_rows($buscarsalas);
if($num_rows > "0"){
while ($rooms = mysql_fetch_assoc($buscarsalas)){
	if ($i%2==1){$highlight = 'even';}else{$highlight = 'odd';}; $i++;
	$porcent = 	round($rooms['users_now']*100/$rooms['users_max']);	
	if ($porcent <= "30"){$occupancy = '2';}elseif($porcent > "30" && $porcent <= "50"){$occupancy = '3';}elseif($porcent > "50" && $porcent <= "70"){$occupancy = '4';}elseif($porcent > "70"){$occupancy = '5';};

	echo '<li class="'.$highlight.' room-occupancy-'.$occupancy.'" roomid="'.$rooms['id'].'">
    <div title="Ir a esta Sala">
        <span class="event-name">
                <a href="http://www.onpixels.info/client?forwardId=2&amp;roomId='.$rooms['id'].'" onclick="HabboClient.roomForward(this, \''.$rooms['id'].'\', \'private\'); return false;" target="">'.$rooms['caption'].'</a>
        </span>
		<span class="event-owner"> por <a href="/home/'.htmlentities($rooms['owner']).'">'.htmlentities($rooms['owner']).'</a></span>
		<p>'.$rooms['description'].'</p><br>
    </div>
</li>';
};}else{echo '<p>No hay salas populares en este momento, intenta en otra categoria.</p>';};
}else{};
?>
</ul>
