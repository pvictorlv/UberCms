<div class="habblet-container ">		
<div class="cbb clearfix red ">
<div class="box-tabs-container clearfix">

<h2 class="title">Selecci&oacute;n Staff</h2>

<ul class="box-tabs">
        <li id="tab-1-3-1"><a href="#">Salas</a><span class="tab-spacer"></span></li>
        <li id="tab-1-3-2" class="selected"><a href="#">Grupos</a><span class="tab-spacer"></span></li>
</ul>

</div>

<div id="tab-1-3-1-content"  style="display: none">
<div id="staffpicks-rooms-habblet-list-container" class="habblet-list-container groups-list">

<ul class="habblet-list">

<?php $sql = mysql_query("SELECT * FROM cms_recommended WHERE type = 'room' ORDER BY id ASC") or die(mysql_error());
	while($row = mysql_fetch_assoc($sql)) {
	$i++;
		$roomsql = mysql_query("SELECT * FROM rooms WHERE id = '".$row['id_rec']."' LIMIT 1");
		$roomrow = mysql_fetch_assoc($roomsql);

	if(IsEven($i)){
            $even = "even left";
        } else {
            $even = "even2";
        }


	$roomcount = $roomrow['users_now'] / $roomrow['users_max'] * 100;
	if($roomcount == 99 || $roomcount > 99){
		$rl = 5;
	} elseif($roomcount > 65){
		$rl = 4;
	} elseif($roomcount > 32){
		$rl = 3;
	} elseif($roomcount > 0){
		$rl = 2;
	} elseif($roomcount < 1){
		$rl = 1;
	}

	$getOwner = mysql_query("SELECT * FROM users WHERE id = '".$roomrow['owner']."'");
	$owner = mysql_fetch_assoc($getOwner);

	?>

	<li class="<?php echo $even; ?> room-occupancy-<?php echo $rl; ?>" roomid="<?php echo $roomrow['id']; ?>">
            <div>
                <span class="room-name"><a href="../client?forwardId=2&amp;roomId=<?php echo $roomrow['id']; ?>" onclick="HabboClient.roomForward(this, '<?php echo $roomrow['id']; ?>', '<?php echo $roomrow['roomtype']; ?>'); return false;" target="85d327955e5fc804ac33675ef8d05e3c9d3ef7ed"><?php echo $roomrow['caption']; ?></a></span>
                <span class="room-owner"><a href="/home/<?php echo $owner['username']; ?>"><?php echo $owner['username']; ?></a></span>
                <p><?php echo $roomrow['description']; ?></p>

            </div>
        </li>

<?php } ?>
    </ul>
</div>
</div>

<div id="tab-1-3-2-content" >
<div id="staffpicks-groups-habblet-list-container" class="habblet-list-container groups-list">

    <ul class="habblet-list two-cols">

	<?php $sql = mysql_query("SELECT * FROM cms_recommended WHERE type = 'group' ORDER BY id ASC") or die(mysql_error());
	while($row = mysql_fetch_assoc($sql)) {

	$i++;
	
		$groupsql = mysql_query("SELECT * FROM group_details WHERE id = '".$row['id_rec']."' LIMIT 1");
		$grouprow = mysql_fetch_assoc($groupsql);

        if(IsEven($i)){
            $even = "even left";
        } else {
            $even = "even right";
        }
    ?>
 <li class="<?php echo $even; ?>" style="background-image: url(<?php echo $path; ?>/habbo-imaging/badge.php?badge=<?php echo $grouprow['badge']; ?>)">
        <?php if($grouprow['roomid'] !== 0) { ?><a href="<?php echo $path; ?>/client?forwardId=2&amp;roomId=<?php echo $grouprow['roomid']; ?>" onclick="HabboClient.roomForward(this, '<?php echo $grouprow['roomid']; ?>', 'private'); return false;" target="9cf76b1ff4b99b02656456ee94e0271ab56272ee" class="group-room"></a><?php } ?>
            <a class="item" href="./groups/<?php echo $grouprow['id']; ?>"><?php echo HoloText($grouprow['name']); ?></a>
            </li>
            <?php } ?>
    </ul>
</div>
    
                        
                    </div>
                </div> </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>