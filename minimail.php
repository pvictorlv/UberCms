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
            $messageId = (int)filter($_POST['messageId']);
            $getMessage = dbquery("SELECT subject,sender_id FROM site_minimail WHERE folder = 'inbox' AND id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");

            if ($getMessage->num_rows >= 1) {
                $replyData = $getMessage->fetch_assoc();
            }
        }

        $recipientIds = Array();
        $subject = '';
        $body = '';

        if ($replyData != null) {
            $subject = 'RE: ' . filter($replyData['subject']);
            $recipientIds[] = $replyData['sender_id'];
        } else {
            if (isset($_POST['recipientIds'])) {
                $recipientIds = explode(',', $_POST['recipientIds']);
            }

            if (isset($_POST['subject'])) {
                $subject = filter($_POST['subject']);
            }
        }

        if (isset($_POST['body'])) {
            $body = nl2br(uberCore::BBcode(filter($_POST['body'])));
        }

        $sub_len = strlen($subject);
        if ($sub_len < 1 || $sub_len > 120 || strlen($body) > 4096) {
            die("Message could not be sent. No subject, or body/subject is too long.");
        }

        foreach ($recipientIds as $r) {
            if (dbquery("SELECT NULL FROM users WHERE id = '" . (int)$r . "' LIMIT 1")->num_rows == 1
                && dbquery("SELECT NULL FROM messenger_friendships WHERE user_one_id = '" . (int)$r . "' AND user_two_id = '" . USER_ID . "' LIMIT 1")->num_rows == 1
            ) {
                dbquery("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "','" . $r . "','inbox','0','" . $subject . "','" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "','" . $body . "')");
            }
        }

        dbquery("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "','" . USER_ID . "','sent','1','" . $subject . "','" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "','" . ($body) . "')");
        header('X-JSON: {"message":"El mensaje ha sido enviado.","totalMessages":' . dbquery("SELECT NULL FROM site_minimail WHERE folder = 'inbox'")->num_rows . '}');

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

        $getBuddies = dbquery("SELECT user_two_id FROM messenger_friendships WHERE user_one_id = '" . USER_ID . "'");
        $i = 0;

        while ($buddy = $getBuddies->fetch_assoc()) {
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

        dbquery("DELETE FROM site_minimail WHERE folder = 'trash' AND receiver_id = '" . USER_ID . "'");
        header('X-JSON: {"message":"Basura vacia!","totalMessages":' . dbquery("SELECT NULL FROM site_minimail WHERE folder = 'trash'")->num_rows . '}');

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

        $messageId = (int)filter($_POST['messageId']);
        $label = filter($_POST['label']);

        dbquery("UPDATE site_minimail SET folder = 'inbox', is_read = '1' WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
        header('X-JSON: {"message":"Mensagem restaurada.","totalMessages":' . dbquery("SELECT NULL FROM site_minimail WHERE folder = '" . $label . "'")->num_rows . '}');

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
            dbquery("DELETE FROM site_minimail WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
            header('X-JSON: {"message":"Mensaje Borrado","totalMessages":' . dbquery("SELECT NULL FROM site_minimail WHERE folder = '" . $label . "'")->num_rows . '}');
        } else {
            dbquery("UPDATE site_minimail SET folder = 'trash', is_read = '1' WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
            header('X-JSON: {"message":"El mensaje ha sido enviado a la papelera. Se puede recuperar, si lo desea.","totalMessages":' . dbquery("SELECT NULL FROM site_minimail WHERE folder = '" . $label . "'")->num_rows . '}');
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