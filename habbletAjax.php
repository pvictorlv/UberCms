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

        $findVoucher = dbquery("SELECT value FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");

        if ($findVoucher->num_rows >= 1) {
            $value = (int)$findVoucher->fetch_assoc()['value'];

            echo '<div class="redeem-result"><div class="rounded rounded-green">You have successfully redeemed <b>' . $value . '</b> credits.</div></div>';

            dbquery("UPDATE users SET credits = credits + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
            dbquery("DELETE FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");
            $core->Mus('updateCredits', USER_ID);
        } else {
            echo '<div class="redeem-result"><div class="rounded rounded-red">Your redeem code could not be found.</div></div>';
        }

        break;

    case 'updatemotto':

        if (!LOGGED_IN) {
            exit;
        }

        if (isset($_POST['motto'])) {
            $motto = filter(uberCore::FilterSpecialChars(substr($_POST['motto'], 0, 40)));

            dbquery("UPDATE users SET motto = '" . $motto . "' WHERE id = '" . USER_ID . "' LIMIT 1");
            $core->Mus('updatemotto', USER_ID);

            die(clean($motto));
        }

        break;

    case 'removeFeedItem':

        if (!LOGGED_IN) {
            exit;
        }

        $usersconfig = dbquery("SELECT username FROM users WHERE id='" . USER_ID . "' LIMIT 1");

        if ($usersconfig->num_rows > 0) {
            $tagsArray = Array();
            $username = $usersconfig->fetch_assoc()['username'];
        }

        dbquery("DELETE FROM users_alerts WHERE user_id = '" . USER_ID . "' OR user_id ='" . $username . "' ORDER BY id ASC LIMIT 1") or die(mysql_error());
        echo "SUCCESS";

        break;
}