<?php

require_once('global.php');
require_once('nucleo/class.gtfo.php');
$ownerid = filter($_GET['ownerId']);
$widgetid = filter($_GET['ratingId']);
$rate = filter($_GET['givenRate']);


if (is_numeric($ownerid) && is_numeric($widgetid) && is_numeric($rate)) {
    $myvote = $db->result(dbquery("SELECT COUNT(*) FROM " . PREFIX . "ratings WHERE raterid = '" . $user->id . "' AND userid = '" . $ownerid . "'"));
    if ($myvote < 1 && $ownerid != $user->id && $rate > 0 && $rate < 6) {
        dbquery("INSERT INTO " . PREFIX . "ratings (userid,rating,raterid) VALUES ('" . $ownerid . "','" . $rate . "','" . $user->id . "')");
    }
}

$totalvotes = dbquery("SELECT COUNT(*) FROM " . PREFIX . "ratings WHERE userid = '" . $ownerid . "'");
$highvotes = dbquery("SELECT COUNT(*) FROM " . PREFIX . "ratings WHERE userid = '" . $ownerid . "' AND rating > 3");
$votestally = dbquery("SELECT SUM(rating) FROM " . PREFIX . "ratings WHERE userid = '" . $ownerid . "'");

$x = $totalvotes;
if ($x == 0) {
    $x = 1;
}
$average = round($votestally / $x, 1);
$px = ceil(($average * 150) / 5);
?>
<script type="text/javascript">
    var ratingWidget;

    ratingWidget = new RatingWidget(<?php echo $gtfo->cleanWord($ownerid); ?>, <?php echo $gtfo->cleanWord($widgetid); ?>);

</script>
<div class="rating-average">
    <b><?php echo $lang->loc['average.rating']; ?>: <?php echo $average; ?></b><br/>
    <div id="rating-stars" class="rating-stars">
        <ul id="rating-unit_ul1" class="rating-unit-rating">
            <li class="rating-current-rating" style="width:<?php echo $px; ?>px;"/>

        </ul>
    </div>
    <?php echo $totalvotes; ?> votos

    <br/>
    (<?php echo $highvotes; ?> Totais)
</div>