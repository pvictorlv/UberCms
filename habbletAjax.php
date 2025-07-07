<?php
require_once "global.php";

$cmd = '';

if (isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
}

switch (strtolower($cmd)) {
    case 'new_redeemvoucher':

        if (!LOGGED_IN) {
            exit;
        }

        echo '<div class="redeem-redeeming"><div><input type="text" name="voucherCode" value="" class="redeemcode" size="8" /></div><div class="redeem-redeeming-button"><a href="#" class="new-button green-button redeem-submit"><b><span></span>Redeem</b><i></i></a></div></div>';

        $findVoucher = db::query("SELECT value, cur_uses, max_uses, type FROM items_vouchers WHERE voucher = ? LIMIT 1", $_POST['voucherCode']);

        if ($findVoucher->rowCount() >= 1) {
            $value = (int)$findVoucher->fetchColumn();
            $curUses = (int)$findVoucher->fetchColumn(1);
            $maxUses = (int)$findVoucher->fetchColumn(2);
            $type = $findVoucher->fetchColumn(3);
            if ($curUses >= $maxUses) {
                echo '<div class="redeem-result"><div class="rounded rounded-red">Código já utilizado.</div></div>';
                exit;
            }

            echo '<div class="redeem-result"><div class="rounded rounded-green">Código gerado com sucesso! Total: <b>' . $value . '</b>.</div></div>';
            if ($type == 'credits') {
                db::query("UPDATE users SET credits = credits + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
            } else if ($type == 'pixels') {
                db::query("UPDATE users SET activity_points = activity_points + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
            } else if ($type == 'vippoints') {
                db::query("UPDATE users SET diamonds = diamonds + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
            }

            db::query("UPDATE items_vouchers SET cur_uses = cur_uses + 1 WHERE voucher = ? LIMIT 1", $_POST['voucherCode']);
            $core->Mus('updateCredits', USER_ID);
        } else {
            echo '<div class="redeem-result"><div class="rounded rounded-red">Código inválido.</div></div>';
        }

        break;

    case 'updatemotto':

        if (!LOGGED_IN) {
            exit;
        }

        if (isset($_POST['motto'])) {
            $motto = uberCore::FilterSpecialChars(substr($_POST['motto'], 0, 40));

            db::query("UPDATE users SET motto = ? WHERE id = '" . USER_ID . "' LIMIT 1", $motto);
            $core->Mus('updatemotto', USER_ID);

            die(clean($motto));
        }

        break;

    case 'removeFeedItem':

        if (!LOGGED_IN) {
            exit;
        }

        $usersconfig = db::query("SELECT username FROM users WHERE id='" . USER_ID . "' LIMIT 1");

        if ($usersconfig->rowCount() > 0) {
            $tagsArray = Array();
            $username = $usersconfig->fetchColumn();
        }

        db::query("DELETE FROM users_alerts WHERE user_id = '" . USER_ID . "' OR user_id ='" . $username . "' ORDER BY id ASC LIMIT 1") or die(mysql_error());
        echo "SUCCESS";

        break;
}