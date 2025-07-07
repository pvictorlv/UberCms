<?php
global $users, $qryId;


$count = db::query("SELECT DISTINCT(badge_id) FROM users_badges WHERE user_id = ?", $qryId)->rowCount();
$sql = db::query("SELECT DISTINCT(badge_id) FROM users_badges WHERE user_id = ? LIMIT 16", $qryId);
$desde = 1;
$hasta = 16;
$getBadges = db::query("SELECT DISTINCT(badge_id) FROM users_badges WHERE user_id = ? LIMIT 0,16", $qryId)->rowCount();
$n = $getBadges;
$x = 0;
while ($n >= 0) {
    $n = $n - 16;
    $x++;
}

?>
<div class="movable widget BadgesWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3><span class="header-left">&nbsp;</span><span class="header-middle">Emblemas e conquistas</span><span
                            class="header-right">&nbsp;</span></h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">
                <div id="badgelist-content">
                    <ul class="clearfix" style="height: 180px; ">
                        <?php
                        while ($data = $sql->fetch(2)) {
                            ?>
                            <li style="background-image: url(<?php echo WWW ?>/c_images/album1584/<?php echo $data['badge_id']; ?>.gif)"></li>
                            <?php
                        }//Termina while
                        ?>
                    </ul>

                    <div id="badge-list-paging">
                        <?php echo $desde; ?> - <?php echo $getBadges; ?> / <?php echo $count; ?>
                        <br>
                        <?php
                        if ($count >= '17') {
                            ?>
                            Primeiro |
                            &lt;&lt; |
                            <a href="#" id="badge-list-search-next">&gt;&gt;</a> |
                            <a href="#" id="badge-list-search-last">Ultimo</a>
                            <input type="hidden" id="badgeListPageNumber" value="1">
                            <input type="hidden" id="badgeListTotalPages" value="<?php echo $x; ?>">
                            <?php
                        }
                        ?>
                    </div>

                    <script type="text/javascript">
                        document.observe("dom:loaded", function () {
                            window.badgesWidgetid = new BadgesWidget('%habboId%', '%id%');
                        });
                    </script>


                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>