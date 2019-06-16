<?php
require_once("global.php");

if ($_GET['code'] == "139742685") {
    $_SESSION['jjp']['login']['name'] = filter($_GET['name']);
    db::query("UPDATE `users` SET `real_name` = '" . $_SESSION['jjp']['login']['name'] . "' WHERE `mail` = '" . $_SESSION['jjp']['login']['email'] . "'");

    print "true";
    exit;
}

print "false";
?>