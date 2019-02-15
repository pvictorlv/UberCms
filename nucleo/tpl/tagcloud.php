<?php

$get = dbquery('SELECT tag, COUNT(id) AS quantity FROM user_tags GROUP BY tag ORDER BY quantity DESC LIMIT 20');

if ($get->num_rows > 0) {
    echo '<ul class="tag-list">';

    $tagsArray = Array();

    while ($row = $get->fetch_assoc()) {
        $tagsArray[$row['tag']] = $row['quantity'];
    }

    $spread = (max(array_values($tagsArray)) - min(array_values($tagsArray)));

    if ($spread <= 0) {
        $spread = 1;
    }

    $step = 100 / $spread;

    shuffle_assoc($tagsArray);

    foreach ($tagsArray as $key => $value) {
        $size = ceil(100 + (($value - min(array_values($tagsArray))) * $step));
        echo '<li><a class="tag" href="%www%/tag/' . $key . '" style="font-size: ' . $size . '%;">' . $key . ' </a></li>';
    }

    echo '<ul class="tag-list">
';
} else {
    echo '<b><a href="%www%/tag/xd" target="_new">xd</a></b> <b><a href="%www%/tag/staff" target="_new">Staff</a></b> <b><a href="%www%/tag/habbo" target="_new">Habbo</a></b> <b><a href="%www%/tag/Facebook" target="_new">Facebook</a></b> <b><a href="%www%/tag/Silver" target="_new">Silver</a></b></ul>';
}

?>