<?php

function restoreWaitingItems($userId)
{
    Db::query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . $userId . "'");
}

function CleanText($str, $filterHTML = true)
{
    $str = stripslashes(trim($str));

    if ($filterHTML) {
        $str = htmlentities($str);
    }

    $str = nl2br($str);

    return $str;
}

function HoloText($str, $advanced = false)
{
    $str = stripslashes($str);
    if ($advanced != true) {
        $str = htmlspecialchars($str, ENT_COMPAT, "UTF-8");
    }
    return $str;
}

function getData($id)
{
    return db::query("SELECT * FROM users WHERE  id = ? LIMIT 1", $id);

}


function FilterText($str, $antihtml = true)
{
    $str = stripslashes($str);

    if ($antihtml)
        $str = htmlentities(html_entity_decode($str));

    $str = db::Scape($str);
    $str = @mb_convert_encoding($str, "UTF-8", "auto");
    $str = str_replace('&amp;', '&', $str);

    //$str = str_replace("\ h", "&#92;", $str);
    $str = str_replace("'", "&#39;", $str);

    // Devolver cadena filtrada.
    return $str;
}

function SwitchWordFilter($str)
{

    $sql = db::query("SELECT word FROM wordfilter");

    while ($row = $sql->fetch(2)) {
        $str = str_replace($row['word'], getServer("wordfilter_censor"), $str);
    }

    return $str;

}

function textInJS($str, $clean = false)
{
    $str = str_replace("¡", "�", $str);
    $str = str_replace("¿", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("ñ", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("á", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("é", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("ó", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("ú", "�", $str);
    $str = str_replace("��", "�", $str);
    $str = str_replace("�", "�", $str);

    if ($clean == true) {
        $str = str_replace("�", "N", $str);
        $str = str_replace("�", "n", $str);
        $str = str_replace("�", "A", $str);
        $str = str_replace("�", "a", $str);
        $str = str_replace("�", "E", $str);
        $str = str_replace("�", "e", $str);
        $str = str_replace("�", "O", $str);
        $str = str_replace("�", "o", $str);
        $str = str_replace("�", "U", $str);
        $str = str_replace("�", "u", $str);
        $str = str_replace("�", "I", $str);
        $str = str_replace("�", "i", $str);
    }

    return $str;
}

function GetUserGroup($userId)
{

    $check = Db::query("SELECT groupid FROM groups_memberships WHERE userid = '" . $userId . "' AND is_current = '1' LIMIT 1");
    $has_fave = $check->rowCount();

    if ($has_fave > 0) {

        $row = $check->fetch(PDO::FETCH_ASSOC);
        $groupid = $row['groupid'];

        return $groupid;

    } else {

        return false;

    }
}

function GetUserBadge($strName)
{

    $check = Db::query("SELECT id FROM users WHERE (id = ? OR username = ?) AND badge_status = '1' LIMIT 1",
        $strName, $strName);
    $exists = $check->rowCount();

    if ($exists > 0) {
        $usrrow = $check->fetch(PDO::FETCH_ASSOC);
        $check = Db::query("SELECT * FROM user_badges WHERE user_id = '" . $usrrow['id'] . "' LIMIT 1");
        $hasbadge = $check->rowCount();
        if ($hasbadge > 0) {
            $badgerow = $check->fetch(PDO::FETCH_ASSOC);
            return $badgerow['badge_id'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function IsUserOnline($intUID, $inWeb = false)
{

    $result = Db::query("SELECT online FROM users WHERE id = '" . FilterText($intUID) . "' LIMIT 1");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $time_compare = (time() - 501);

    if ($inWeb == false) {
        if ($row['online'] >= $time_compare) {
            return true;
        } else {
            return false;
        }
    } else {
        if ($row['web_online'] >= $time_compare) {
            return true;
        } else {
            return false;
        }
    }

}


$H = date('H');
$i = date('i');
$s = date('s');
$m = date('m');
$d = date('d');
$F = date('F');
$Y = date('Y');
$j = date('j');
$n = date('n');
$M = date('M');
$A = date('A');
$y = date('y');

$date_normal = date('d-m-Y', mktime($m, $d, $Y));
$date_reversed = date('Y-m-d', mktime($m, $d, $y));
$date_name = $d . "-" . $F . "-" . $Y . " " . $H . ":" . $i . ":" . $s;

function replacee($str)
{
    $str = str_replace("\\r\\n", "<br>", $str);


    return ($str);
}

function getHC($id)
{
    $sql = Db::query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_club' AND user_id = '" . $id . "' LIMIT 1");

    if ($sql->rowCount() == 0) {
        return 0;
    }

    $data = $sql->fetch(PDO::FETCH_ASSOC);
    $diff = $data['timestamp_expire'] - time();

    if ($diff <= 0) {
        return 0;
    }

    return ceil($diff / 86400);

}

function getVIP($id)
{
    $sql = Db::query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_vip' AND user_id = '" . $id . "' LIMIT 1");

    if ($sql->rowCount() == 0) {
        return 0;
    }

    $data = $sql->fetch(PDO::FETCH_ASSOC);
    $diff = $data['timestamp_expire'] - time();

    if ($diff <= 0) {
        return 0;
    }

    return ceil($diff / 86400);

}


?>