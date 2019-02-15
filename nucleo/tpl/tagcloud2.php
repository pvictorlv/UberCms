<?php

$get = dbquery("SELECT tag, COUNT(id) AS quantity FROM user_tags GROUP BY tag ORDER BY quantity DESC LIMIT 25");
echo '<ul class="tag-list"><li>Habbos gostam de... </li>';
if ($get->num_rows > 0) {
    while ($row = $get->fetch_assoc()) {
        echo '<li><a class="tag" href="%www%/tag/' . $row['tag'] . '" style="font-size:11px;">' . $row['tag'] . '</a></li>';
    }
} else {
    echo 'Nenhuma etiqueta no momento.';
}
echo '</ul>';
