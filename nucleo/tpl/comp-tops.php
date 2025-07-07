<div id="content" style="position: relative" class="clearfix">
    <div id="column" class="column">
        <div class="habblet-container ">
            <div class="cbb clearfix orange ">
                <h2 class="title"><span style="float: left;">Cr&eacute;ditos</span></h2>
                <div align="left">
                    <table width="100%">
                        <tr>
                            <?php
                            $row = db::query("SELECT look,username,credits FROM users WHERE rank < 5 ORDER BY credits DESC LIMIT 5");
                            while ($sql = $row->fetch(2)){

                            ?>

                        <tr>
                            <td width="5px"></td>
                            <td width="20px">
                                <img
                                    src="%www%/habbo-imaging/avatarimage.php?figure=<?php echo $sql['look']; ?>&direction=2&head_direction=2&gesture=sml&action=crr=2&size=s"
                                    align="left"></td>
                            <td width="195px"><a
                                    href="/home/<?php echo $sql['username']; ?>"><b><?php echo $sql['username']; ?></b></a><br/><?php echo $sql['credits']; ?>
                                Cr&eacute;ditos
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <!-- / Table center - Online -->

    </div>

    <!-- / Table center - P&iacute;xeles -->
    <div id="column" class="column">
        <div class="habblet-container ">
            <div class="cbb clearfix blue ">
                <h2 class="title"><span style="float: left;">Pixels</span></h2>
                <div align="left">
                    <table width="100%">
                        <tr>
                            <?php
                            $row = db::query("SELECT look,username,activity_points FROM users WHERE rank < 5 ORDER BY activity_points DESC LIMIT 5");
                            while ($sql = $row->fetch(2)){
                            ?>
                        <tr>
                            <td width="5px"></td>
                            <td width="20px">
                                <img
                                    src="%www%/habbo-imaging/avatarimage.php?figure=<?php echo $sql['look']; ?>&direction=2&head_direction=2&gesture=sml&action=crr=2&size=s"
                                    align="left"></td>
                            <td width="195px"><a
                                    href="/home/<?php echo $sql['username']; ?>"><b><?php echo $sql['username']; ?></b></a><br/><?php echo $sql['activity_points']; ?>
                                Pixels
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <div id="column" class="column">
        <div class="habblet-container ">
            <div class="cbb clearfix orange ">
                <h2 class="title"><span style="float: left;">Online</span></h2>
                <div align="left">
                    <table width="100%">

                        <tr>
                            <?php

                            $q = db::query("SELECT look,username,online_seconds FROM users_stats us INNER JOIN users u on u.id = us.id WHERE rank < 4 ORDER BY online_seconds DESC LIMIT 5");
                            $time = 60*60; // 60*60*24

                            while ($row = $q->fetch(2)) {
                            ?>

                        <tr>
                            <td width="5px"></td>
                            <td width="20px">
                                <img
                                    src="%www%/habbo-imaging/avatarimage.php?figure=<?php echo $row['look']; ?>&direction=2&head_direction=2&gesture=sml&action=crr=2&size=s"
                                    align="left"></td>
                            <td width="195px"><a
                                    href="/home/<?php echo $row['username']; ?>"><b><?php echo $row['username']; ?></b></a><br/>
                                <?php echo round($row['online_seconds'] / $time); ?> Hora(s) online
                            </td>
                        </tr>

                        <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>

<script type="text/javascript">
    HabboView.run();
</script>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>


</div>
