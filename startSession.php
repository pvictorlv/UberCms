<?php
require_once 'global.php';

if (isset($_GET['id'])) {
    if (is_numeric($_GET['id'])) {
        $startid = (int)filter($_GET['id']);
        if ($startid == USER_ID) {

            $sql = dbquery("SELECT id FROM users WHERE id = '" . $startid . "'");
            if ($sql->num_rows >= '1') {

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