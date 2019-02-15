<?php
include "../global.php";

$data = filter($_POST["data"]);

if (isset($data)) {
    $q = dbquery("INSERT INTO `movies` (`data`) VALUES ('" . $data . "')");
    echo($db->GetId());
} else {
    header("HTTP/1.0 500 Internal Server Error");
}