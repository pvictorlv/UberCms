<?php

$folder = '';
$unreadMode = false;
global $label;
if (isset($unreadOnly) && $unreadOnly == "true") {
    $unreadMode = true;
}

if (isset($label)) {
    $folder = $label;
}

if ($folder != 'inbox' && $folder != 'sent' && $folder != 'trash') {
    $folder = 'inbox';
}

$isReadClause = '';

if ($unreadMode) {
    $isReadClause = " AND is_read = '0'";
}

$count = db::query('SELECT count(id) FROM site_minimail WHERE folder = ? AND receiver_id = ?' . $isReadClause . " ORDER BY id DESC", $folder, USER_ID)->fetchColumn();

$messageCount = $count;

$navigator = '';

if ($messageCount > 0) {
    $navigator = '<div class="progress"></div> ' . $messageCount . ' - ' . $messageCount . ' of ' . $messageCount . '</p>';
}

?>

<a href="#" class="new-button compose"><b>Escrever</b><i></i></a>

<div class="clearfix labels nostandard">
    <ul class="box-tabs">
        <li <?php if ($folder == 'inbox') {
            echo 'class="selected"';
        } ?>><a href="#" label="inbox">Caixa de entrada</a><span class="tab-spacer"></span></li>
        <li <?php if ($folder == 'sent') {
            echo 'class="selected"';
        } ?>><a href="#" label="sent">Enviados</a><span class="tab-spacer"></span></li>
        <li <?php if ($folder == 'trash') {
            echo 'class="selected"';
        } ?>><a href="#" label="trash">Lixeira</a><span class="tab-spacer"></span></li>
    </ul>
</div>


<div id="message-list" class="label-inbox">
    <div class="new-buttons clearfix">
        <div class="labels inbox-refresh"><a href="#" class="new-button green-button" label="<?php echo $folder; ?>"
                                             style="float: left; margin: 0"><b>Atualizar caixa de entrada</b><i></i></a>
        </div>
    </div>
    <div style="clear: both; height: 1px"></div>

    <?php if ($folder == 'trash' && $messageCount >= 1) { ?>
        <div class="trash-controls notice">
            As mensagens dessa pasta s�o apagadas automaticamente ap�s 30 dias <a href="#" class="empty-trash">Esvaziar
                lixeira</a>
        </div>
    <?php } ?>

    <div class="navigation">
        <?php if ($folder == 'inbox') { ?>
            <div class="unread-selector"><input type="checkbox" class="unread-only" <?php if ($unreadMode) {
                echo 'checked';
            } ?>/> Sem ler</div><?php } ?>
        <?php echo $navigator; ?>
    </div>

    <?php

    if ($messageCount > 0) {

        $getMessages = db::query('SELECT * FROM site_minimail WHERE folder = ? AND receiver_id = ?' . $isReadClause . " ORDER BY id DESC", $folder, USER_ID);
        while ($message = $getMessages->fetch(2)) {
            $getSender = db::query("SELECT username,look FROM users WHERE id = '" . $message['sender_id'] . "' LIMIT 1");
            $senderData = Array();

            if ($getSender->rowCount()) {
                $senderData = $getSender->fetch(2);
            } else {
                continue;
            }

            echo '	<div class="message-item ' . (($message['is_read'] == "0") ? 'unread' : 'read') . ' " id="msg-' . $message['id'] . '">
		<div class="message-preview" status="' . (($message['is_read'] == "0") ? 'unread' : 'read') . '">
			<span class="message-tstamp" isotime="' . $message['isodate'] . '" title="' . $message['date'] . '">
			    ' . $message['date'] . '
			</span>
			<img src="http://avatar-retro.com/habbo-imaging/avatarimage?figure=' . clean($senderData['look']) . '&direction=2&head_direction=2&size=s" />
			<span class="message-sender" title="' . clean($senderData['username']) . '">' . $senderData['username'] . '</span>
			
			<span class="message-subject" title="' . clean($message['subject']) . '">&ldquo;' . clean($message['subject']) . '&rdquo;</span>
		</div>
		<div class="message-body" style="display: none;">
		    <div class="contents"></div>
            <div class="message-body-bottom"></div>
		</div>		
	</div>';
        }
    } else {
        echo '	<p class="no-messages">';

        switch ($folder) {
            default:
            case 'inbox':

                if ($unreadMode) {
                    echo 'Nenhuma mensagem recebida';
                } else {
                    echo 'Nenhuma mensagem recebida';
                }

                break;

            case 'sent':

                echo 'Nenhuma mensagem enviada';
                break;

            case 'trash':

                echo 'Nenhuma mensagem apagada';
                break;
        }

        echo '	</p> ';
    }

    if ($navigator != '') {
        echo '<div class="navigation">' . $navigator . '</div>';
    }

    ?>

</div>