<?php
ob_start();
require '../global.php';
if (!LOGGED_IN) {
    exit;
}

if (isset($_POST['ownerId']) && isset($_POST['lastEntryId']) && isset($_POST['widgetId'])) {
    $ownerId = filter($_POST['ownerId']);
    $lastEntryId = filter($_POST['lastEntryId']);
    $widgetId = filter($_POST['widgetId']);

    $sql = db::query("SELECT * FROM cms_guestbook_entries WHERE home_id = '" . $ownerId . "' AND id < '" . $lastEntryId . "' ORDER BY id DESC LIMIT 20");
    $last = db::query("SELECT id FROM cms_guestbook_entries WHERE home_id = '" . $ownerId . "' AND id < '" . $lastEntryId . "' ORDER BY id ASC LIMIT 1")->fetch(2);
    $i = 0;
    if ($sql->rowCount() > 0) {
        while ($data = $sql->fetch(2)) {
            $i++;
            if (uberUsers::IsUserOnline($data['userid'])) {
                $status = 'online';
            } else {
                $status = 'offline';
            }
            echo '
		<li id="guestbook-entry-' . $data['id'] . '" class="guestbook-entry">
			<div class="guestbook-author">
					<img src="%www%/habbo-imaging/avatarimage.php?figure=' . $users->GetUserVar($data['userid'], 'look') . '&amp;size=s" alt="' . $users->GetUserVar($data['userid'], 'username') . '" title="' . $users->GetUserVar($data['userid'], 'username') . '" />
			</div>
				<div class="guestbook-actions">';
            if (LOGGED_IN) {
                if (USER_ID == $ownerId) {
                    echo '<img src="' . WWW . '/web-gallery/images/myhabbo/buttons/delete_entry_button.gif" id="gbentry-delete-' . $data['id'] . '" class="gbentry-delete" style="cursor:pointer" alt="" /><br />';
                }
            }
            echo '<img src="%www%/web-gallery/images/myhabbo/buttons/report_button.gif" id="gbentry-report-' . $data['id'] . '" class="gbentry-report" style="cursor:pointer" alt="" />';
            echo '</div>
			<div class="guestbook-message">
				<div class="' . $status . '">
					<a href="/home/' . $users->GetUserVar($data['userid'], 'username') . '">' . $users->GetUserVar($data['userid'], 'username') . '</a>
				</div>
				<p>' . fixText(uberCore::BBcode($data['message']), false, false, true, false, true) . '</p>
			</div>
			<div class="guestbook-cleaner">&nbsp;</div>
			<div class="guestbook-entry-footer metadata">' . $data['time'] . '</div>
		</li>';
            if ($i == $sql->rowCount()) {
                if ($data['id'] == $last['id']) {
                    header('X-JSON: {"lastPage":"true"}');
                } else {
                    header('X-JSON: {"lastPage":"false"}');
                }
            }
        }

    } else {
        echo '';
    }
}
ob_end_flush();
?>