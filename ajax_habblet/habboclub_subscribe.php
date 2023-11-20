<?php
require_once("../global.php");
if (isset($_POST['optionNumber'])) {
    $plantogive = $_POST['optionNumber'];
    if ($plantogive == "1") {
        $price = "15";
        $dias = "31";
        $image = "/web-gallery/v2/images/club/habboclub_basic_small.png";
        $text = "Habbo Club";
        $money = "1";
        $mes = "1";
    } elseif ($plantogive == "2") {
        $price = "45";
        $dias = "93";
        $mes = "3";
        $image = "/web-gallery/v2/images/club/habboclub_basic_small.png";
        $text = "Habbo Club";
        $money = "1";
    } elseif ($plantogive == "3") {
        $price = "25";
        $dias = "31";
        $image = "/web-gallery/v2/images/club/habboclub_vip_small.png";
        $text = "VIP";
        $money = "2";
        $mes = "1";
    } elseif ($plantogive == "4") {
        $price = "65";
        $dias = "93";
        $image = "/web-gallery/v2/images/club/habboclub_vip_small.png";
        $text = "VIP";
        $money = "2";
        $mes = "3";
    } else {
        echo 'Error procesando tu solicitud.';
    };
    if (isset($money) && $money == "1") {
        if (isset($mes)) {
            $meses = $mes;
            if ($meses == "1") {
                $days = "31";
                $amount = 15;
            } elseif ($meses == "3") {
                $days = "90";
                $amount = 45;
            } elseif ($meses == "6") {
                $days = "180";
                $amount = 90;
            } elseif ($meses == "12") {
                $days = "360";
                $amount = 180;
            } else {
                $amount = 0;
                $error = "Plano não encontrado";
                echo $error;
            }
            $coins1 = db::query("SELECT credits FROM users WHERE id = '" . USER_ID . "'")->fetch(2)['credits'];
            $id = USER_ID;
            if ($coins1 >= $amount) {
                $final = $coins1 - $amount;
                $vip_ini = time();
                $check = db::query("SELECT user_id,timestamp_activated FROM users_subscriptions WHERE user_id=? AND subscription_id='2' ORDER BY timestamp_activated DESC LIMIT 1", $id);
                $total_records = $check->rowCount();
                if ($total_records > 0) {
                    echo 'update';
                    db::query("UPDATE users_subscriptions SET timestamp_expire = users_subscriptions.timestamp_expire + ($days * 86400) WHERE subscription_id = '2' AND user_id = '$id'");
                } else {

                    db::query("DELETE FROM users_subscriptions WHERE user_id=" . $id . " AND subscription_id='habbo_club'");
                    db::query("INSERT INTO users_subscriptions(user_id, subscription_id, timestamp_activated, timestamp_expire, timestamp_lastgift) VALUES ('" . $id . "', '2', '" . $vip_ini . "', '" . time() + ($days * 86400) . "', '0')");
                    db::query("UPDATE users SET credits= credits - $amount WHERE id = '" . USER_ID . "'");
                }
                echo '<p><b>Obrigado por se inscrever no HabboClub</b></p>
<p>Sua inscrição ao HC foi ativa.</p>
<p><a href="#" onclick="habboclub.closeSubscriptionWindow();return false;" class="new-button"><b>Ok</b><i></i></a></p>
<div class="clear"></div>';
            } else {
                echo '<img src="/web-gallery/images/piccolo_unhappy.gif" alt="" align="left" style="margin:10px;" />
<p>Erro ao realizar a compra, por favor, tente novamente</p>
<p>Você não tem créditos suficientes, tem apenas ' . $coins1 . ' Moedas, e precisa de ' . $amount . '.<br /></p>
<p>Consiga algumas moedas e tente novamente<br /></p>
<p><a href="credits" onclick="habboclub.closeSubscriptionWindow();return true;" class="new-button"><b>Obter Cr&#233;ditos</b><i></i></a></p>
<div class="clear"></div>';
            };
        } else {
            echo 'Error processando seu pedido.';
        };
    } elseif (isset($money) && $money == "2") {
        if (isset($mes)) {
            $meses = addslashes(trim($mes));
            if ($meses == "1") {
                $days = "31";
                $amount = 25;
            } elseif ($meses == "3") {
                $days = "90";
                $amount = 45;
            } elseif ($meses == "6") {
                $days = "180";
                $amount = 120;
            } elseif ($meses == "12") {
                $days = "360";
                $amount = 240;
            } else {
                $error = "Plano inexistente.";
                echo $error;
            };
            $getCoins = db::query("SELECT credits FROM users WHERE username = '" . USER_NAME . "'");
            $coins1 = $getCoins->fetchColumn();
            $id = USER_ID;
            if ($coins1 >= $amount) {
                $final = $coins1 - $amount;
                $vip_ini = time();
                $check = db::query("SELECT user_id, timestamp_activated FROM users_subscriptions WHERE user_id=? AND subscription_id='1' ORDER BY timestamp_activated DESC LIMIT 1", $id);
                $total_records = $check->rowCount();
                if ($total_records > 0) {
                    $row = $check->fetch(2);
                    $current_exp = strtotime($row['activated']);
                    if ($current_exp > time()) {
                        echo "Você já é membro do clube!";
                        exit;
                    }
                };
                db::query("replace INTO users_subscriptions(user_id, subscription_id, timestamp_activated, timestamp_expire) VALUES (?, '1', ?, ?)", $id, $vip_ini, $meses * 86400);
                db::query("UPDATE users SET credits=? WHERE id = ?", $final, $id);
                echo '<p><b>Obrigado por se inscrever no VIP Club</b>P</b></p>
<p>Sua inscrição VIP foi ativa.</p>
<p><a href="#" onclick="habboclub.closeSubscriptionWindow();return false;" class="new-button"><b>Ok</b><i></i></a></p>
<div class="clear"></div>';
            } else {
                echo '<img src="/web-gallery/images/piccolo_unhappy.gif" alt="" align="left" style="margin:10px;" />
<p>Erro ao realizar a compra, por favor, tente novamente</p>
<p>Você não tem creditos suficientes, tem apenas ' . $coins1 . ' Moedas, e precisa de ' . $amount . '.<br /></p>
<p>Consiga algumas moedas e tente novamente<br /></p>
<p><a href="credits" onclick="habboclub.closeSubscriptionWindow();return true;" class="new-button"><b>Obter Cr&#233;ditos</b><i></i></a></p>
<div class="clear"></div>';
            };
        } else {
            echo 'Error processando seu pedido.';
        };
    };
} else {
    echo 'Error processando seu pedido.';
};
?>