<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN) {
    exit;
}

$t = null;

if (isset($_GET['i']) && is_numeric($_GET['i'])) {
    $i = intval($_GET['i']);
    $s = db::query("SELECT * FROM moderation_forum_threads WHERE id = '" . $i . "' LIMIT 1");

    if ($s->rowCount() >= 1) {
        $t = $s->fetch(2);
    }
}

if ($t == null) {
    die("Thread not found");
}

if ($t['locked'] == "0" && isset($_POST['msg'])) {
    $msg = filter($_POST['msg']);

    if (strlen($msg) <= 12) {
        die("Message is too short. Please post something worthwhile.");
    }

    db::query("INSERT INTO moderation_forum_replies (thread_id,poster,date,message) VALUES ('" . $t['id'] . "','" . HK_USER_NAME . "','" . date('j F Y h:i A') . "','" . $msg . "')");

    if ($t['timestamp'] < 99999999999) {
        db::query("UPDATE moderation_forum_threads SET timestamp = '" . time() . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
    }

    header("Location: index.php?_cmd=forumthread&i=" . $t['id']);
    exit;
}

if (isset($_POST['opt'])) {
    $opt = $_POST['opt'];

    switch ($opt) {
        case 'lock':

            $newState = 1;
            $l = 'locked';

            if ($t['locked'] == "1") {
                $newState = 0;
                $l = 'unlocked';
            }

            fMessage('ok', 'Thread ' . $l . '.');

            db::query("UPDATE moderation_forum_threads SET locked = '" . $newState . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
            break;

        case 'stick':

            fMessage('ok', 'Thread stickied.');

            db::query("UPDATE moderation_forum_threads SET timestamp = '99999999999' WHERE id = '" . $t['id'] . "' LIMIT 1");
            break;

        case 'bump':

            fMessage('ok', 'Thread updated.');

            db::query("UPDATE moderation_forum_threads SET timestamp = '" . time() . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
            break;

        case 'del';

            fMessage('ok', 'Thread deleted.');

            db::query("DELETE FROM moderation_forum_threads WHERE id = '" . $t['id'] . "' LIMIT 1");
            db::query("DELETE FROM moderation_forum_replies WHERE thread_id = '" . $t['id'] . "'");
            break;
    }

    header("Location: index.php?_cmd=forum");
    exit;
}

require_once "top.php";

?>

    <h1>
        <?php if ($t['locked'] >= 1) {
            echo '<img src="images/locked.gif" alt="Locked" title="Thread locked" style="vertical-align: middle;">';
        } ?>
        <?php if ($t['timestamp'] >= 99999999999) {
            echo '<img src="images/sticky.gif" alt="Sticky" title="Sticky topic" style="vertical-align: middle;">';
        } ?>
        Discussion Board - "<?php echo clean($t['subject']); ?>"<br/>
        <small style="font-weight: normal; font-size: 80%;"><?php echo $t['poster']; ?> on <?php echo $t['date']; ?> (<a
                    href="index.php?_cmd=forum">Return to discussion board</a>)
        </small>
    </h1>

<?php if ($users->hasFuse(HK_USER_ID, 'fuse_admin')) { ?>

    <br/>
    <div id="toolbox" style="font-weight: normal; border: 1px dotted #000; margin: 0px; padding: 5px;">
        <form method="post">

            <b>Admin options:</b>

            &nbsp;

            <select name="opt">
                <?php if ($t['timestamp'] < 99999999999) { ?>
                    <option value="stick">Sticky thread</option><?php } ?>
                <option value="bump"><?php if ($t['timestamp'] >= 99999999999) {
                        echo 'Unstick thread';
                    } else {
                        echo 'Bump thread to top';
                    } ?></option>
                <option value="lock"><?php if ($t['locked'] == "1") {
                        echo 'Unlock thread';
                    } else {
                        echo 'Lock thread';
                    } ?></option>
                <option value="del">Delete thread</option>
            </select>

            &nbsp;

            <input type="submit" value="Go">

        </form>
    </div>
    <br/>

<?php } ?>

    <br/>

    <p style="padding: 5px;">
        <?php echo nl2br(clean($t['message'])); ?>
    </p>

    <br/>

<?php

$getReplies = db::query("SELECT * FROM moderation_forum_replies WHERE thread_id = '" . $t['id'] . "'");

echo '<br />';

if ($getReplies->rowCount() >= 1) {
    echo '<b style="font-size: 125%;">Replies</b>';

    while ($r = $getReplies->fetch(2)) {
        echo '<h2 style="font-weight: normal; padding: 8px;">';
        echo '<p><B><small>' . $r['poster'] . ' replied:</small></B></p><br />';
        echo '<p style="padding: 5px;">' . nl2br(clean($r['message'])) . '</p><br />';
        echo '<p><small>' . $r['date'] . '</p></small>';
        echo '</h2>';
        echo '<br />';
    }
} else if ($t['locked'] == "0") {
    echo '<i>This topic does not have any replies yet.</i>';
}

if ($t['locked'] == "0") {
    ?>

    <h2 id="cn-link">
        <a href="#" onclick="t('cn-link'); t('cn-form'); return false">Post reply</a>
    </h2>

    <h2 id="cn-form" style="display: none;">
        <form method="post">

            Message:<br/>
            <textarea name="msg" rows="5" cols="50"></textarea><br/>
            <br/>
            <input type="submit" value="Submit">
            <input type="button" value="Cancel" onclick="t('cn-link'); t('cn-form');">
        </form>
    </h2>

    <?php
}

require_once "bottom.php";

?>