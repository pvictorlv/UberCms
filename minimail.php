<?php
include "global.php";

if (!LOGGED_IN) {
    exit;
}

$cmd = '';

if (isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
}

switch (strtolower($cmd)) {
    case 'confirmreport':

        echo 'Não foi possível denunciar a mensagem. Por favor, entre em contato com a moderação do hotel.';
        break;

    case 'sendmessage':

        $replyData = null;

        if (isset($_POST['messageId'])) {
            $messageId = (int)$_POST['messageId'];
            $getMessage = db::query("SELECT subject,sender_id FROM site_minimail WHERE folder = 'inbox' AND id = ? AND receiver_id = ? LIMIT 1", $messageId, USER_ID);

            if ($getMessage->rowCount() >= 1) {
                $replyData = $getMessage->fetch(2);
            }
        }

        $recipientIds = Array();
        $subject = '';
        $body = '';

        if ($replyData != null) {
            $subject = 'RE: ' . ($replyData['subject']);
            $recipientIds[] = $replyData['sender_id'];
        } else {
            if (isset($_POST['recipientIds'])) {
                $recipientIds = explode(',', $_POST['recipientIds']);
            }

            if (isset($_POST['subject'])) {
                $subject = ($_POST['subject']);
            }
        }

        if (isset($_POST['body'])) {
            $body = nl2br(uberCore::BBcode($_POST['body']));
        }

        $sub_len = strlen($subject);
        if ($sub_len < 1 || $sub_len > 120 || strlen($body) > 4096) {
            die("Message could not be sent. No subject, or body/subject is too long.");
        }

        foreach ($recipientIds as $r) {
            if (db::query("SELECT count(user_one_id) FROM messenger_friendships WHERE user_one_id = ? AND user_two_id = '" . USER_ID . "' LIMIT 1", $r)->fetchColumn() >= 1
            ) {
                db::query("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "',?,'inbox','0',?,'" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "',?)", $r, $subject, $body);
            }
        }

        db::query("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "','" . USER_ID . "','sent','1',?,'" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "',?)", $subject, $body);
        header('X-JSON: {"message":"El mensaje ha sido enviado.","totalMessages":' . db::query("SELECT count(id) FROM site_minimail WHERE folder = 'inbox'")->fetchColumn() . '}');

        $tpl->Init();

        $msgs = new Template('minimail-tabcontent');
        $msgs->SetParam('label', 'inbox');

        $tpl->AddTemplate($msgs);
        $tpl->Output();

        break;

        break;

    case 'preview':

        if (!isset($_POST['body'])) {
            exit;
        }

        die(nl2br(clean($_POST['body'])));

    case 'recipients':

        echo '/*-secure-' . LB;
        echo '[';

        $getBuddies = db::query("SELECT user_two_id FROM messenger_friendships WHERE user_one_id = ?", USER_ID);
        $i = 0;

        while ($buddy = $getBuddies->fetch(2)) {
            if ($i > 0) {
                echo ',';
            }

            echo '{"id":' . $buddy['user_two_id'] . ',"name":"' . clean($users->Id2name($buddy['user_two_id'])) . '"}';

            $i++;
        }

        echo ']';
        echo LB . ' */';

        break;

    case 'emptytrash':

        db::query("DELETE FROM site_minimail WHERE folder = 'trash' AND receiver_id = ?", USER_ID);
        header('X-JSON: {"message":"Lixeira esvaziada!","totalMessages":0}');

        $tpl->Init();

        $msgs = new Template('minimail-tabcontent');
        $msgs->SetParam('label', 'trash');

        $tpl->AddTemplate($msgs);
        $tpl->Output();

        break;

    case 'undeletemessage':

        if (!isset($_POST['messageId'], $_POST['label']) || !is_numeric($_POST['messageId'])) {
            exit;
        }

        $messageId = (int)($_POST['messageId']);
        $label = ($_POST['label']);

        db::query("UPDATE site_minimail SET folder = 'inbox', is_read = '1' WHERE id = ? AND receiver_id = '" . USER_ID . "' LIMIT 1", $messageId);
        header('X-JSON: {"message":"Mensagem restaurada.","totalMessages":' . db::query("SELECT count(id) FROM site_minimail WHERE folder = ?")->fetchColumn() . '}');

        $tpl->Init();

        $msgs = new Template('minimail-tabcontent');
        $msgs->SetParam('label', $_POST['label']);

        $tpl->AddTemplate($msgs);
        $tpl->Output();

        break;

    case 'deletemessage':

        if (!isset($_POST['messageId'], $_POST['label']) || !is_numeric($_POST['messageId'])) {
            exit;
        }

        $messageId = (int)$_POST['messageId'];
        $label = filter($_POST['label']);

        if ($label == 'trash' || $label == 'sent') {
            db::query("DELETE FROM site_minimail WHERE id = ? AND receiver_id = '" . USER_ID . "' LIMIT 1", $messageId);
            header('X-JSON: {"message":"Mensagem apagada","totalMessages":' . db::query('SELECT count(id) FROM site_minimail WHERE folder = ?')->fetchColumn() . '}');
        } else {
            db::query("UPDATE site_minimail SET folder = 'trash', is_read = '1' WHERE id = ? AND receiver_id = '" . USER_ID . "' LIMIT 1", $messageId);
            header('X-JSON: {"message":"A mensagem foi enviada para a lixeira. Você ainda pode recupera-la caso deseje.","totalMessages":' . db::query("SELECT count(id) FROM site_minimail WHERE folder = ?", $label)->fetchColumn() . '}');
        }

        $tpl->Init();

        $msgs = new Template('minimail-tabcontent');
        $msgs->SetParam('label', $_POST['label']);

        $tpl->AddTemplate($msgs);
        $tpl->Output();

        break;

    case 'loadmessages':

        if (!isset($_POST['label'])) {
            exit;
        }

        $tpl->Init();

        $msgs = new Template('minimail-tabcontent');
        $label = $_POST['label'];
        $msgs->SetParam('label', $label);

        if (isset($_POST['unreadOnly'])) {
            $msgs->SetParam('unreadOnly', $_POST['unreadOnly']);
        }

        $tpl->AddTemplate($msgs);
        $tpl->Output();

        break;

    default:

        die($cmd);
}

?>