<?php

require_once "global.php";

if (!LOGGED_IN) {
    exit;
}

$cmd = '';

if (isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
}

switch (strtolower($cmd)) {
    case 'tag/remove':

        if (isset($_POST['tagId']) && isset($_POST['accountId'])) {
            $tagId = (int)filter($_POST['tagId']);
            db::query("DELETE FROM users_tags WHERE user_id = '" . USER_ID . "' AND id = '" . $tagId . "' LIMIT 1");
            $core->Mus('updateTags', USER_ID);
        }

        break;

    case 'tag/add':
        if (isset($_POST['tagName']) && isset($_POST['accountId'])) {
            $tagName = strtolower(filter(uberCore::FilterSpecialChars($_POST['tagName'])));
            if (!preg_match('#^[a-z0-9\s]+$#i', $tagName) || strlen($tagName) <= 0 || strlen($tagName) > 20) {
                die("invalidtag");
            } else if (count(uberUsers::GetUserTags(USER_ID)) >= 20) {
                die("limitreached");
            } else if (db::query("SELECT COUNT(*) FROM users_tags WHERE tag = '" . $tagName . "' AND user_id = '" . USER_ID . "'")->rowCount() >= 1) {
                die("exists");
            } else {
                db::query("INSERT INTO users_tags (tag,user_id) VALUES ('" . $tagName . "','" . USER_ID . "')");
                $core->Mus('updateTags', USER_ID);
            }
        }

        break;
}

?>