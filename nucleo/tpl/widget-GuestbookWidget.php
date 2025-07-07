<?php
global $users, $qryId;



$sql = db::query("SELECT * FROM cms_guestbook_entries WHERE home_id = ? ORDER BY id DESC LIMIT 20", $qryId);
$count = $sql->rowCount();

?>
<div class="movable widget GuestbookWidget" id="widget-%id%"
     style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <?php if (isset($_SESSION['startSessionEditHome'])) {
            if ($_SESSION['startSessionEditHome'] == $qryId) {

                echo '<div id="edit-but-%id%"><img src="%www%/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit" /></div>	
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
            }
        }
        ?>
        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3>

                    <span class="header-left">&nbsp;</span><span class="header-middle">Meu livro de visitas (<span
                            id="guestbook-size"><?php echo $count; ?></span>) <span id="guestbook-type" class="private"></span></span><span
                        class="header-right">&nbsp;</span></h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">
                <div id="guestbook-wrapper" class="gb-private">
                    <ul class="guestbook-entries" id="guestbook-entry-container">
                        <?php
                        if ($count > 0) {
                            while ($data = $sql->fetch(2)) {
                                $on = $users->GetUserVar($data['userid'], 'online');
                                if ($on = "1") {
                                    $status = 'online';
                                } else {
                                    $status = 'offline';
                                }
                                echo '
	<li id="guestbook-entry-' . $data['id'] . '" class="guestbook-entry">
		<div class="guestbook-author">
                <img src="https://habbo.city/habbo-imaging/avatarimage?figure=' . $users->GetUserVar($data['userid'], 'look') . '&amp;size=s" alt="' . $users->GetUserVar($data['userid'], 'username') . '" title="' . $users->GetUserVar($data['userid'], 'username') . '" />
		</div>
			<div class="guestbook-actions">';
                                if (LOGGED_IN) {
                                    if (USER_ID == $qryId) {
                                        echo '<img src="' . WWW . '/web-gallery/images/myhabbo/buttons/delete_entry_button.gif" id="gbentry-delete-' . $data['id'] . '" class="gbentry-delete" style="cursor:pointer" alt="" /><br />';
                                    }
                                }
                                echo '<img src="' . WWW . '/web-gallery/images/myhabbo/buttons/report_button.gif" id="gbentry-report-' . $data['id'] . '" class="gbentry-report" style="cursor:pointer" alt="" />';
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
                            }

                        } else {
                            echo 'Nenhuma mensagem em seu livro de visitas.';
                        }
                        ?>
                        <div id="gb-progress" style="margin: 20px 0 60px 0; visibility: hidden">
                            <div class="progressbar" style="">
                                <img src="%www%/web-gallery/images/progress_bubbles.gif" width="29" height="6" alt="">
                            </div>
                        </div>
                    </ul>
                </div>

                <?php
                if (LOGGED_IN) {
                    ?>
                    <div class="guestbook-toolbar clearfix">
                        <a href="#" class="new-button envelope-icon" id="guestbook-open-dialog">
                            <b><span></span>Publicar uma nova mensagem</b><i></i>
                        </a>
                    </div>
                    <?php
                }
                ?>

                <script type="text/javascript">
                    document.observe("dom:loaded", function () {
                        var gb%id% = new GuestbookWidget('%user_id%', '%id%', 500);
                        gb%id%.monitorScrollPosition();
                        var editMenuSection = $('guestbook-privacy-options');
                        if (editMenuSection) {
                            gb%id%.updateOptionsList('private');
                        }
                    });
                </script>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>