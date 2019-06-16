

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title"><span style="float: left;">Mis Placas</span> </h2>
<div align="left">
<div id="badge-back">

</div>
<center><b><br><a style="color:#000000">Placas en uso:</a style></b><?php

    $getBadges = db::query("SELECT * FROM user_badges WHERE user_id = '" . USER_ID . "' AND badge_slot >= 1 ORDER BY badge_slot DESC LIMIT 5");

?>

<div id="badge-back">
    <ul class="badge-back"><br>
<?php
    while($b = mysql_fetch_assoc($getBadges)){
                echo '&nbsp;&nbsp;<img src="http://images.habbo.com/c_images/album1584/' . $b['badge_id'] . '.gif"> &nbsp; &nbsp;';
}
    ?>

    </div>

	</div></center>
</div>
	</div>




