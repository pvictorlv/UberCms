<?php
require_once "global.php";

if (!LOGGED_IN) {
    exit;
}

$messageId = 0;
$messageData = null;
$senderData = null;

if (isset($_GET['messageId']) && is_numeric($_GET['messageId'])) {
    $messageId = (int)filter($_GET['messageId']);
}

if ($messageId > 0) {
    $getMessage = db::query("SELECT * FROM site_minimail WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");

    if ($getMessage->rowCount() >= 1) {
        $messageData = $getMessage->fetch(2);
        $getSender = db::query("SELECT username FROM users WHERE id = '" . $messageData['sender_id'] . "' LIMIT 1");

        if ($getSender->rowCount() >= 1) {
            $senderData = $getSender->fetch(2);
        }
    }
}

if ($messageId == 0 || $messageData == null || $senderData == null) {
    die("<div style='padding: 10px;'><b>Oops!</b><br />Não foi possível carregar a mensagem, tente novamente mais tarde.</div>");
}

$tpl->Init();

$message = new Template('minimail-message');
$message->SetParam('to', USER_NAME);
$message->SetParam('from', clean($senderData['username']));
$message->SetParam('message_id', $messageData['id']);
$message->SetParam('subject', clean($messageData['subject']));
$message->SetParam('body-text', nl2br($messageData['body']));
$message->SetParam('trashed', $messageData['folder'] == 'trash');
$message->SetParam('sent', $messageData['folder'] == 'sent');

if ($messageData['is_read'] == "0") {
    db::query("UPDATE site_minimail SET is_read = '1' WHERE id = '" . $messageData['id'] . "' LIMIT 1");
}

$tpl->AddTemplate($message);
$tpl->Output();

?>