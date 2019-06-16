<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN) {
    exit;
}

if (isset($_POST['msg'])) {
    $subject = $_POST['subj'];
    $body = $_POST['msg'];

    if (strlen($subject) < 1) {
        $subject = 'Sem assunto';
    }

    if (strlen($body) < 20) {
        die('Mensagem muito curta.');
    }

    db::query("INSERT INTO moderation_forum_threads (subject,message,poster,date,timestamp) VALUES ('" . filter($subject) . "','" . filter($body) . "','" . HK_USER_NAME . "','" . date('j F Y h:i A') . "','" . time() . "')");

    fMessage('ok', 'Thread created');

    header("Location: index.php?_cmd=forum");
    exit;
}

require_once "top.php";

?>

<?php

$getTopics = db::query("SELECT * FROM moderation_forum_threads ORDER BY timestamp DESC");

if ($getTopics->rowCount() >= 1) {
    while ($topic = $getTopics->fetch(2)) {
        echo '<h2 style="font-weight: normal;"><a href="index.php?_cmd=forumthread&i=' . $topic['id'] . '">';
        echo '<b style="font-size: 130%;">';

        if ($topic['locked'] >= 1) {
            echo '<img src="images/locked.gif" alt="Locked" title="Thread locked" style="vertical-align: middle;">&nbsp;';
        }

        if ($topic['timestamp'] >= 99999999999) {
            echo '<img src="images/sticky.gif" alt="Sticky" title="Sticky topic" style="vertical-align: middle;">&nbsp;';
        }

        echo clean($topic['subject']) . '</b>&nbsp;';

        $rCount = db::query("SELECT NULL FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'")->rowCount();

        if ($topic['locked'] == "0" || $rCount > 0) {
            echo '(' . $rCount . ' respostas)';
        }

        echo '<br /> ';

        echo 'Criado em ' . $topic['date'] . ' por <b>' . $topic['poster'] . '</b>';
        echo '</a></h2>        <hr /><br>';
    }
} else {
    echo '<br /><center><b><i>Nada encontrado</b></i></center><br />';
}

?>

    <h2 id="cn-link">
        <br><br>
        <a href="#" onclick="t('cn-link'); t('cn-form'); return false">Criar novo tópico</a>
    </h2>

    <h2 id="cn-form" style="display: none;">
        <form method="post">

            Tema:<br/>
            <input type="text" name="subj" size="35" maxlength="120"><br/>
            <br/>Mensagem<br/>
            <textarea name="msg" cols="50" rows="5" minlength="21"></textarea><br/>
            <br/>
            <input type="submit" value="Enviar">
            <input type="button" value="Cancelar" onclick="t('cn-link'); t('cn-form');">
        </form>
    </h2>

<?php

require_once "bottom.php";

?>