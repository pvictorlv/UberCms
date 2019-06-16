<?php
require_once('../global.php');

if (!LOGGED_IN) {
    header("Location: " . WWW . "/");
    exit;
}

if (isset($_POST['accountId']) && isset($_POST['tagName'])) {
    if (is_numeric($_POST['accountId'])) {
        $accountId = USER_ID;
        $tagName = strtolower(filter(uberCore::FilterSpecialChars($_POST['tagName'])));

        $sql = db::query("SELECT id FROM users WHERE id = '" . $accountId . "' LIMIT 1");
        if ($sql->rowCount() > 0 && !empty($tagName) && strlen($tagName) <= 20) {
            $getTags = db::query("SELECT NULL FROM user_tags WHERE user_id = '" . $accountId . "'")->rowCount();
            $alreadyTag = db::query("SELECT NULL FROM user_tags WHERE tag = '" . $tagName . "' AND user_id = '" . $accountId . "'")->rowCount();

            if ($alreadyTag == 0 && $getTags < 20) {
                $tagName = strtolower($tagName);
                Db::query('INSERT INTO user_tags (user_id, tag) VALUES (?, ?);', USER_ID, $tagName);
                echo "valid";
            } elseif ($getTags >= 20) {
                echo 'taglimit';
            } else {
                echo 'exists';
            }
        }
    } else {
        echo "invalidtag";
    }
}


exit;
?>