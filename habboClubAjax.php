<?php
require_once "global.php";

$cmd = '';

if (isset($_GET['cmd'])) {
    $cmd = filter($_GET['cmd']);
}

$type = $_POST['optionNumber'];

switch ($type) {
    case 1:
        $price = 15;
        $days = 31;
        break;
    case 2:
        $price = 45;
        $days = 93;
        break;
    case 3:
        $price = 25;
        $days = 31;
        break;
    case 4:
        $price = 60;
        $days = 93;
        break;
}


switch (strtolower($cmd)) {
    case "habboclub_confirm":

        if (!LOGGED_IN) {
            exit;
        }

        $sub = ($type == 1 || $type == 2) ? '%shortname% Club' : 'Club VIP';
        $image = ($type == 1 || $type == 2) ? 'habboclub_basic_small' : 'habboclub_vip_small';

        $tpl->Init();
        $hc_confirm = new Template('habboclub-confirm', '');
        $hc_confirm->SetParam('sub', $sub);
        $hc_confirm->SetParam('price', $price);
        $hc_confirm->SetParam('days', $days);
        $hc_confirm->SetParam('type', $type);
        $hc_confirm->SetParam('image', $image);
        $tpl->AddTemplate($hc_confirm);
        $tpl->Output();

        break;

    case "habboclub_subscribe":

        if (!LOGGED_IN) {
            exit;
        }

        $sub = ($type == 1 || $type == 2) ? '%shortname% Club' : 'Club VIP';

        if ($users->getCredits(USER_ID) < $price) {
            $tpl->Init();
            $hc_error = new Template('habboclub-error', '');
            $hc_error->SetParam('sub', $sub);
            $hc_error->SetParam('price', $price);
            $tpl->AddTemplate($hc_error);
            $tpl->Output();

        } else {
            dbquery("UPDATE users SET credits = credits - {$price} WHERE id = " . USER_ID . " LIMIT 1");

            if ($type == 1 || $type == 2) {
                // Club System
                $users->AddOrUpdateClub(USER_ID, 'habbo_club', $days);
            } else {
                // VIP System
                $users->AddOrUpdateClub(USER_ID, 'habbo_vip', $days);
            }
        }

        break;
}


?>