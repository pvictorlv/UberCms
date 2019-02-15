<?php
if (isset($_GET['qryName'])) {
    global $users;
    $qryId = $users->Name2id(filter($_GET['qryName']));
} else if (isset($_GET['qryId']) && is_numeric($_GET['qryId'])) {
    $qryId = (int)$_GET['qryId'];
}

if (!isset($qryId) && LOGGED_IN) {
    header('Location: ' . WWW . '/home/' . $_SESSION['UBER_USER_N']);
} else if (!isset($qryId) && !LOGGED_IN) {
    header('Location: ' . WWW . '/');
}

?>

<div class="movable widget TraxPlayerWidget" id="widget-%id%"
     style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3><?php if (isset($_SESSION['startSessionEditHome'])) {
                        if ($_SESSION['startSessionEditHome'] == $qryId) {

                            echo '<img src="%www%/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit" />	
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
                        }
                    }
                    ?><span class="header-left">&nbsp;</span><span class="header-middle">TRAXPLAYER</span><span
                            class="header-right">&nbsp;</span></h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">


                <div id="edit-menu-trax-select-temp" style="display:none">
                    <select id="trax-select-options-temp">
                        <option value="">- Elegir canci&oacute;n -</option>

                        <?php

                        $mysql = dbquery("SELECT * FROM items WHERE user_id = '" . USER_ID . "' LIMIT 1");
                        $i = 0;
                        while ($machinerow = $mysql->num_rows) {
                            $i++;

                            $sql = dbquery("SELECT * FROM soundmachine_songs WHERE machineid = '1' LIMIT 1");
                            $n = 0;
                            while ($songrow = mysql_fetch_assoc($sql)) {
                                $n++;
                                if ($songrow['id'] <> "") {
                                    echo "<option value=\"" . $songrow['id'] . "\">" . trim(nl2br(($songrow['title']))) . "</option>\n";
                                }

                            }
                        } ?>

                    </select>
                </div>
                <?php
                $sql1 = mysql_query("SELECT * FROM soundmachine_songs WHERE userid = '" . USER_ID . "' LIMIT 1");
                $songrow1 = mysql_fetch_assoc($sql1);
                ?>


                <div id="traxplayer-content" style="text-align:center;"></div>
                <embed type="application/x-shockwave-flash"
                       src="/web-gallery/flash/traxplayer/traxplayer.swf" name="traxplayer" quality="high"
                       base="/web-gallery/flash/traxplayer/" allowscriptaccess="always" menu="false"
                       wmode="transparent"
                       flashvars="songUrl=/myhabbo/trax_song.php?songId=1&amp;sampleUrl=%www%/dcr/hof_furni/mp3/"
                       height="66" width="210"/>


                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>