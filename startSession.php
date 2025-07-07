<?php
require_once 'global.php';

if (isset($_GET['id'])) {
    if (is_numeric($_GET['id'])) {
        $startid = (int)($_GET['id']);
        if ($startid == USER_ID) {

            $sql = db::query("SELECT id FROM users WHERE id = ?", $startid);
            if ($sql->rowCount() >= '1') {

                if (isset($_SESSION['startSessionEditGroup'])) {
                    unset($_SESSION['startSessionEditGroup']);
                }

                $_SESSION['startSessionEditHome'] = USER_ID;
                header('Location: /home/' . USER_NAME . '/');

            }
        }
    }
}

?>