<?php
include '../global.php';
if (!LOGGED_IN) {
    exit;
}

if (isset($_POST['ownerId']) && isset($_POST['message']) && isset($_POST['scope']) && isset($_POST['query']) && isset($_POST['widgetId']) && isset($_SESSION['Guestbook_posted_on'])) {
    $ownerId = filter($_POST['ownerId']);
    $message = filter($_POST['message']);
    $widgetId = filter($_POST['widgetId']);

    if (is_numeric($ownerId) && is_numeric($widgetId)) {

        dbquery("INSERT INTO cms_guestbook_entries (id, message, time, home_id, userid) VALUES (NULL, '" . $message . "', '" . $_SESSION['Guestbook_posted_on'] . "', '" . $ownerId . "', '" . USER_ID . "');");
        ?>

        <li id="guestbook-entry--1" class="guestbook-entry">
            <div class="guestbook-author">
                <img
                    src="../../habbo-imaging/avatarimage.php?figure=<?php echo $users->GetUserVar(USER_ID, 'look'); ?>&amp;size=s"
                    alt="<?php echo USER_NAME; ?>" title="<?php echo USER_NAME; ?>"/>
            </div>
            <div class="guestbook-message">
                <div class="<?php if ($users->IsUserOnline(USER_ID)) {
                    echo 'online';
                } else {
                    echo 'offline';
                } ?>">
                    <a href="/home/<?php echo USER_NAME; ?>"><?php echo USER_NAME; ?></a>
                </div>
                <p><?php echo fixText($core->BBcode($message), false, false, true, false, true); ?></p>
            </div>
            <div class="guestbook-cleaner">&nbsp;</div>
            <div class="guestbook-entry-footer metadata"><?php echo $_SESSION['Guestbook_posted_on']; ?></div>
        </li>

        <?php
    }
    unset($_SESSION['Guestbook_posted_on']);
}
?>