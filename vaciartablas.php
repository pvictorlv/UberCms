<?php
include "global.php";
$q = db::query("SELECT * FORM furniture WHERE type = 's'");
$arr = $q->fetch(2);
echo "[";
foreach ($arr as $key => $value) {
    $$key = $value;
    echo "[\"$type\",\"$sprite_id\",\"shelves_norja\",\"34082\",\"0\",\"1\",\"1\",\"#ffffff,#F7EBBC\",\"Beige Bookcase\",\"For nic naks and books.\",\"\",\"142872\",\"5\"]";
}
echo "]";