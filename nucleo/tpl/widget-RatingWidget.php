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

$get_em = db::query("SELECT * FROM homes_items WHERE owner_id = '" . $qryId . "' AND type < 4 LIMIT 200");
$row = $get_em->fetch(2);
?>

<div class="movable widget RatingWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
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
                    ?><span class="header-left">&nbsp;</span><span
                            class="header-middle">Mi calificaci&oacute;n</span><span class="header-right">&nbsp;</span>
                </h3>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-content">
                <div id="rating-main">
                    <?php
                    $myvote = db::query("SELECT COUNT(id) FROM homes_ratings WHERE user = '" . USER_ID . "' AND home_id = '$qryId'")->rowCount();
                    $totalvote = db::query("SELECT COUNT(id) FROM homes_ratings WHERE home_id = '$qryId'");
                    $totalvotes = $totalvote->rowCount();
                    $highvotes = db::query("SELECT COUNT(*) FROM homes_ratings WHERE home_id = '$qryId' AND rating > 3");
                    $votestally = 5;

                    $x = $totalvotes;
                    if ($x == 0) {
                        $x = 1;
                    }
                    $average = round($votestally / $x, 1);
                    $px = ceil(($average * 150) / 5);

                    if ($qryId == USER_ID || $myvote > 0) {
                        $bypass = true;
                        $ownerid = USER_ID;
                        $widgetid = $row['id'];
                        $rate = 0;
                    } else { ?>
                        <script type="text/javascript">
                            var ratingWidget;
                            document.observe("dom:loaded", function () {
                                ratingWidget = new RatingWidget(<?php echo USER_ID; ?>, <?php echo $row['id']; ?>);
                            });
                        </script>
                        <div class="rating-average">
                            <b>Media de votos: <?php echo $average; ?></b>
                            <div id="rating-stars" class="rating-stars">
                                <ul id="rating-unit_ul1" class="rating-unit-rating">
                                    <li class="rating-current-rating"
                                        style="width:<?php echo $px; ?>px;">
                                        <?php if (LOGGED_IN) { ?>
                                    <li><a href="#" class="r1-unit rater">1</a></li>
                                    <li><a href="#" class="r2-unit rater">2</a></li>
                                    <li><a href="#" class="r3-unit rater">3</a></li>
                                    <li><a href="#" class="r4-unit rater">4</a></li>
                                    <li><a href="#" class="r5-unit rater">5</a></li>
                                    <?php } ?>
                                    </li>
                                </ul>
                            </div>
                            <?php echo $totalvotes; ?> votos no total

                            <br/>
                            (<?php echo $highvotes; ?> Habbos votram 4 ou mais)
                        </div>
                    <?php } ?>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>