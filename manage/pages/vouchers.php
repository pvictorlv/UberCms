<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) {
    exit;
}

if (isset($_POST['v-code'])) {
    $vCode = filter($_POST['v-code']);
    $vValue = filter($_POST['v-value']);

    if (strlen($vCode) <= 0) {
        fMessage('error', 'Please enter a voucher code.');
    } else if (!is_numeric($vValue) || intval($vValue) <= 0 || intval($vValue) > 5000) {
        fMessage('error', 'Valor inválido de créditos. Deve ser um número entre 1 a 5000.');
    } else {
        dbquery("INSERT INTO credit_vouchers (code,value) VALUES ('" . $vCode . "','" . intval($vValue) . "')");
        fMessage('ok', 'Voucher is now live and redeemable.');
    }
}

require_once "top.php";

?>

    <h1>Codigos vouchers</h1>

    <br/>

    <p>
       Códigos de moedas que podem ser trocados no site e na loja do jogo.
    </p>

    <br/>

    <div style="float: left; width: 49%;">

        <h2>Redeemable vouchers</h2>

        <br/>

        <table width="100%" border="1">
            <thead>
            <td>Codigo</td>
            <td>Valor</td>
            </thead>
            <?php

            $get = dbquery("SELECT code,value FROM credit_vouchers ORDER BY code ASC");

            while ($user = $get->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $user['code'] . '</td>';
                echo '<td>' . $user['value'] . ' credits</td>';
                echo '</tr>';
            }

            ?>
        </table>

    </div>

    <div style="float: right;width: 100%;">
        <br><br>

        <form method="post">

            Codigo:<br/>
            <input type="text" name="v-code">
            <br><br>
            Valores:<br>
            <input type="text" name="v-value"><br><br>
            <input type="submit" value="Adicionar">
        </form>

    </div>

    <div style="clear: both;"></div>

<?php

require_once "bottom.php";

?>