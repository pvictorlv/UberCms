<div class="habblet-container ">
<div class="cb clearfix white "><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
<div class="rounded-container"><div style="background-color: rgb(255, 255, 255); "><div style="margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div></div></div><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div></div><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div></div><h2 class="title rounded-done">Placas en uso:</h2><div style="background-color: rgb(255, 255, 255); "><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div><div style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div></div><div style="margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; height: 1px; overflow-x: hidden; overflow-y: hidden; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "><div style="height: 1px; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 1px; margin-bottom: 0px; margin-left: 1px; background-color: rgb(255, 255, 255); "></div></div></div></div></div></div>
<div id="hotcampaigns-habblet-list-container">

<center>
<?php

    $getBadges = mysql_query("SELECT * FROM user_badges WHERE user_id = '" . USER_ID . "' AND badge_slot >= 1 ORDER BY badge_slot DESC LIMIT 5");
		
?>



<p><?php
    while($b = mysql_fetch_assoc($getBadges)){
                echo '<img src="http://navvos.com/c_images/album1584/' . $b['badge_id'] . '.gif">';
}
    ?></p>

</center>

	</div>
</div></div></div><div class="bb"><div></div></div></div>

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
</div>