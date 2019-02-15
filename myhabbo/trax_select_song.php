<?php

require_once('../global.php');


$songid = FilterText($_POST['songId']);
$id = FilterText($_POST['widgetId']);

mysql_query("UPDATE homes_stickers SET var = '".$songid."' WHERE id = '".$id."'");?>

<embed type="application/x-shockwave-flash"
src="/web-gallery/flash/traxplayer/traxplayer.swf" name="traxplayer" quality="high"
base="/web-gallery/flash/traxplayer/" allowscriptaccess="always" menu="false"
wmode="transparent" flashvars="songUrl=/myhabbo/trax_song.php?songId=<?php echo $songid; ?>&amp;sampleUrl=%www%/dcr/hof_furni/mp3/" height="66" width="210" />