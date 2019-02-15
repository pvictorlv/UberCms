<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../global.php';
require "../inc/recaptchalib.php";

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['topicId']) && is_numeric($_POST['topicId']) &&
 isset($_POST['message']) && isset($_POST['recaptcha_challenge_field']) && isset($_POST['recaptcha_response_field']) && isset($_POST['page'])) {

	$groupId = $gtfo->cleanWord($_POST['groupId']);
	$group__id = $groupId;
	$qryId = $groupId;
	if(is_numeric($qryId)) {
		$qryId = $qryId.'/id';
	}
	$topicId = $gtfo->cleanWord($_POST['topicId']);
	$message = $gtfo->cleanWord($_POST['message']);
	$recaptcha_challenge_field = $gtfo->cleanWord($_POST['recaptcha_challenge_field']);
	$recaptcha_response_field = $gtfo->cleanWord($_POST['recaptcha_response_field']);
	$page = $gtfo->cleanWord($_POST['page']);
	$_GET['page'] = $page;

	$sql_group = dbquery("SELECT * FROM groups_details WHERE id = '" . $group__id . "' LIMIT 1");
	if(!mysql_num_rows($sql_group)) { die(); }
	$row_group = mysql_fetch_array($sql_group);
	
	$resp = recaptcha_check_answer ('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		
							
	if (!$resp->is_valid) {
			header('X-JSON: {"captchaError":"true"}');
			die();
		}
	$GroupData = dbquery("SELECT forumType,perso_link FROM groups_details WHERE id = '".$groupId."' LIMIT 1;");
	if(mysql_num_rows($GroupData)) {
		$TopicData = dbquery("SELECT type,user_id FROM groups_forum_topics WHERE id = '".$topicId."' LIMIT 1");
		if(mysql_num_rows($TopicData)) {
			$group_rank = $core->GetGroupPerm($groupId);
			
			$GroupData = mysql_fetch_array($GroupData);
			$forumType = mysql_fetch_array($TopicData);
			
			if($forumType['user_id']) {
				define('IS_CREATOR', true);
			} else {
				define('IS_CREATOR', false);
			}
			
			if($group_rank == 1) {
				define('IS_MEMBER', true);
			} else {
				define('IS_MEMBER', false);
			}
			
			if($group_rank == 2) {
				define('IS_ADMIN', true);
			} else {
				define('IS_ADMIN', false);
			}
			
			if($group_rank == 3) {
				define('IS_OWNER', true);
			} else {
				define('IS_OWNER', false);
			}
			
			
			if($GroupData['forumType'] && !$users->IsMember(USER_ID, $groupId)) {
				
			} elseif(!$forumType['type']) {
				dbquery("INSERT INTO groups_forum_replies (user_id, content, date, topic_id, group_id) VALUES ('".USER_ID."', '".$message."', '".time()."', '".$topicId."', '".$groupId."')");
?>
<div class="postlist-header clearfix">
							<?php if($checkTopicArray['type']) { ?>
							<span class="topic-closed"><img src="<?php echo WWW; ?>/web-gallery/images/groups/status_closed.gif" title="Asunto Privado"> Asunto Privado</span>
							<?php } if(!$checkTopicArray['type'] && LOGGED_IN || 
										$checkTopicArray['type'] && LOGGED_IN && IS_ADMIN ||
										$checkTopicArray['type'] && LOGGED_IN && IS_OWNER ||
										$checkTopicArray['type'] && LOGGED_IN && IS_CREATOR) { ?>
								<a href="#" id="create-post-message" class="create-post-link verify-email">Crear respuesta</a>
								<?php } ?>
								<input type="hidden" id="email-verfication-ok" value="1"/>
							<?php if(IS_ADMIN || IS_OWNER || IS_CREATOR) { ?>
								<a href="#" id="edit-topic-settings" class="edit-topic-settings-link">Editar Ajustes &raquo;</a>
								<input type="hidden" id="settings_dialog_header" value="Editar Ajustes"/>
							<?php }
	$count = mysql_num_rows(dbquery("SELECT null FROM groups_forum_replies WHERE topic_id = '".$topicId."';"));
	$n = $count;
	$x = 0;
		while($n >= 0)
		{
			$n = $n-10;
			$x++;
		}
	$RepliesPage = 1;
	if(isset($_GET['page']) && is_numeric($_GET['page'])) {
		$RepliesPage = $gtfo->cleanWord($_GET['page']);
		if($RepliesPage == 1 || $RepliesPage == '-1') {
			$limit = 0;
		} else {
			$limit = $RepliesPage*10-10;
		}
	} else { 
		$limit = 0;
		$RepliesPage = 1;
	}

							?>
								<div class="page-num-list">
									<input type="hidden" id="current-page" value="<?php echo $RepliesPage; ?>"/>
							Ver página:
							
						<?php
						$anterior = $RepliesPage-1;
						if($RepliesPage != 1 && $RepliesPage <= $x ||
						   $RepliesPage != 0 && $RepliesPage <= $x) {
								echo '<a title="Primera página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/1">&lt;&lt;</a>
								';
								echo '<a title="Página anterior" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$anterior.'">&lt;</a>
								';
							}
						
						if($x > 6 && $RepliesPage > 6 && $RepliesPage < $x) {
							$i = $RepliesPage-5;
						} elseif($RepliesPage == $x) {
							$i = $RepliesPage-10;
						} else {
							$i = 0;
						}
						$break = 0;
						$next = $RepliesPage+1;
						while($x != $i) {
							$break++;
							$i++;
							if($i == $RepliesPage) {
								echo $i.'
								';
							} else {
								echo '<a href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$i.'">'.$i.'</a>
								';
							}
							
							if($break >= 10) {
								break;
							}
							
						}
							if($x != 1 && $RepliesPage <> $x) {
								echo '<a title="Página siguiente" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$next.'">&gt;</a>
								';
								echo '<a title="Última página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$x.'">&gt;&gt;</a>';
							}
						?>
						</div>
							</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<?php 
$GetTopic = dbquery("SELECT id,user_id,date,type,title FROM groups_forum_topics WHERE id = '".$topicId."' LIMIT 1;");

if(mysql_num_rows($GetTopic)) {
	$i = 0;
	$dataTopic = mysql_fetch_array($GetTopic);
	$first_username = $users->id2name($dataTopic['user_id']);
	$FirstUserData = mysql_fetch_array(dbquery("SELECT look,motto FROM users where id = '".$dataTopic['user_id']."' LIMIT 1;"));
				}

	$GetReplies = dbquery("SELECT id,user_id,content,date,is_edited,is_first FROM groups_forum_replies WHERE topic_id = '".$topicId."' LIMIT ".$limit.",10;");


if(mysql_num_rows($GetReplies)) {
	while($dataReplies = mysql_fetch_array($GetReplies)) {
	$first_username = $users->id2name($dataReplies['user_id']);
	$FirstUserData = mysql_fetch_array(dbquery("SELECT look,motto FROM users where id = '".$dataReplies['user_id']."' LIMIT 1;"));
?>
<tr class="post-list-index-<?php if(IsEven($i)) { echo 'even'; } else { echo 'odd'; } ?>">
	<td class="post-list-row-container">
		<a href="/home/<?php echo $dataReplies['user_id']; ?>/id" class="post-list-creator-link post-list-creator-info"><?php write($first_username); ?></a>
				<?php
				if(!$users->IsUserOnline($dataReplies['user_id'])) {
				?>
				<img alt="offline" src="http://images.xukys-hotel.com/web-gallery/images/myhabbo/habbo_offline.gif"/>
				<?php } else { ?>
				<img alt="online" src="http://images.xukys-hotel.com/web-gallery/images/myhabbo/habbo_online_anim.gif"/>
				<?php } 
				$GetCountMsgOnReplies = mysql_fetch_array(dbquery("SELECT COUNT(id) AS count FROM groups_forum_replies WHERE user_id = '" . $dataReplies['user_id'] . "'"));
				$AllCount             = $GetCountMsgOnReplies['count'];
				?>
		<div class="post-list-posts post-list-creator-info">Mensaje: <?php echo $AllCount; ?></div>
		<div class="clearfix">
			<div class="post-list-creator-avatar"><img src="http://images.xukys-hotel.com/habbo-imaging/avatarimage.php?figure=<?php echo $FirstUserData['look']; ?>&amp;size=b" alt=""/></div>
			<div class="post-list-group-badge">
				<?php
				$groupFavoriteData = $users->GetFavoriteGroupArray($dataReplies['user_id']);
				if($groupFavoriteData != false) {
				?>
				<a href="/groups/<?php echo $groupFavoriteData['id']; ?>/id">
					<img src="http://images.xukys-hotel.com/habbo-imaging/badge.php?badge=<?php echo $groupFavoriteData['badge']; ?>" alt="" />
				</a>
				<?php } ?>
			</div>
			<div class="post-list-avatar-badge"><img src="http://images.xukys-hotel.com/c_images/album1584/<?php echo $users->GetFirstBadge($dataReplies['user_id']); ?>.gif"/></div>
		</div>
		<div class="post-list-motto post-list-creator-info"><?php write($FirstUserData['motto']); ?></div>
	</td>
	<td class="post-list-message" valign="top" colspan="2">
		<?php if(LOGGED_IN) { ?>
		<a href="#" class="quote-post-link verify-email" id="quote-post-<?php echo $dataReplies['id']; ?>-message">Con Cita</a>
		<?php } if(LOGGED_IN && USER_ID == $dataReplies['user_id'] && !$checkTopicArray['type']) { ?>
		<a href="#" class="edit-post-link verify-email" id="edit-post-<?php echo $dataReplies['id']; ?>-message">Editar</a>
		<?php } ?>
		<span class="post-list-message-header"><?php if($i != 0) { echo 'RE: '; } ?><?php write($dataTopic['title']); ?></span>
		<br/>
		<span class="post-list-message-time">
		<?php echo date('d-M-Y', $dataReplies['date']); ?>
		(<?php echo date('H:i', $dataReplies['date']); ?>)</span>

		<div class="post-list-report-element">
		<?php if(IS_ADMIN && !$checkTopicArray['type'] ||
				IS_OWNER && !$checkTopicArray['type']) { ?>
			<a href="#" id="delete-post-<?php echo $dataReplies['id']; ?>" class="delete-button delete-post"></a>
			<?php } ?>
			<?php if(LOGGED_IN && USER_ID != $dataReplies['user_id'] ) { ?>
			<a href="#" id="report-post-<?php echo $dataReplies['id']; ?>" class="create-report-button report-post"></a>
			<?php } ?>
		</div>
		<div class="post-list-content-element">
		<?php if($dataReplies['is_edited']) { ?>
		<span class="post-list-message-edited">Última edición:</span><br />
		<?php } ?>
		<?php echo fixText(uberCore::BBcode($dataReplies['content']), false, false, true, false, true); ?>
		
		<input type="hidden" id="<?php echo $dataReplies['id']; ?>-message" value="<?php write($dataReplies['content']); ?>"/>
		</div>
		<div>
		</div>
	</td>
</tr>
<?php
	$i++;
	}
}
?>
<tr id="new-post-entry-message" style="display:none;">

	<td class="new-post-entry-label"><div class="new-post-entry-label" id="new-post-entry-label">Mensaje:</div></td>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" style="margin: 5px; width: 98%;">
		<tr>
		<td>
		<input type="hidden" id="edit-type" />
		<input type="hidden" id="post-id"  />
        <a href="#" class="preview-post-link" id="post-form-preview">Previa &raquo;</a>
        <input type="hidden" id="spam-message" value="¡Se ha detectado spam!"/>
		<textarea id="post-message" class="new-post-entry-message" rows="5" name="message" ></textarea>
    <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("post-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Rojo"],
            "orange" : ["#fe6301", "Naranja"],
            "yellow" : ["#ffce00", "Amarillo"],
            "green" : ["#6cc800", "Verde"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Azul"],
            "gray" : ["#828282", "Gris"],
            "black" : ["#000000", "Negro"]
        };
        bbcodeToolbar.addColorSelect("Color", colors, false);
    </script>
<div id="linktool-inline">
    <div id="linktool-scope">
        <label for="linktool-query-input">Crear link:</label>
        <input type="radio" name="scope" class="linktool-scope" value="1" checked="checked"/>Habbos
        <input type="radio" name="scope" class="linktool-scope" value="2"/>Salas
        <input type="radio" name="scope" class="linktool-scope" value="3"/>Grupos&nbsp;
    </div>
    <div class="linktool-input">
        <input id="linktool-query" type="text" size="30" name="query" value=""/>
        <input id="linktool-find" class="search" type="submit" title="Buscar" value=""/>
    </div>
    <div class="clear" style="height: 0;"><!-- --></div>
    <div id="linktool-results" style="display: none">
    </div>
    <script type="text/javascript">
        linkTool = new LinkTool(bbcodeToolbar.textarea);
    </script>
</div>
	    <div id="discussion-captcha">

<h3>
<label for="bean_captcha" class="registration-text">Teclea el código de seguridad que aparece en la imagen</label>
</h3>

<div id="captcha-code-error"></div>

<p></p>

<div class="register-label" id="recaptcha-reload">
    <p>
        <img src="http://images.xukys-hotel.com/web-gallery/v2/images/shared_icons/reload_icon.gif" width="15" height="15" alt=""/>
        <a id="recaptcha-reload-link" href="#">Intenta con palabras diferentes</a>
    </p>
</div>

<script type="text/javascript">
document.observe("dom:loaded", function() {
    Event.observe($("recaptcha-reload"), "click", function(e) {Event.stop(e); Utils.reloadRecaptcha()});
});
</script>

<div id="recaptcha_challenge">
  <div id="recaptcha_image"></div>

  <p>
    <input type="text" name="recaptcha_response_field" id="recaptcha_response_field" value="" class="registration-text required-captcha" />
  </p>
</div></div>
        <div class="button-area">
            <a id="post-form-cancel" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
            <a id="post-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
        </div>
        </td>
        </tr>
        </table>
	</td>
</tr>
</table>
<div id="new-post-preview" style="display:none;">
</div>
    <div class="postlist-footer clearfix">
	<?php if($checkTopicArray['type']) { ?>
							<span class="topic-closed"><img src="<?php echo WWW; ?>/web-gallery/images/groups/status_closed.gif" title="Asunto Privado"> Asunto Privado</span>
	<?php } if($checkTopicArray['type'] == 0 && LOGGED_IN || 
										$checkTopicArray['type'] && LOGGED_IN && IS_ADMIN ||
										$checkTopicArray['type'] && LOGGED_IN && IS_OWNER ||
										$checkTopicArray['type'] && LOGGED_IN && IS_CREATOR) { ?>
            <a href="#" id="create-post-message-lower" class="create-post-link verify-email">Crear respuesta</a>
			<?php } ?>
        <div class="page-num-list">
    Ver página:
						<?php
						$anterior = $RepliesPage-1;
						if($RepliesPage != 1 && $RepliesPage <= $x) {
								echo '<a title="Primera página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/1">&lt;&lt;</a>
								';
								echo '<a title="Página anterior" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$anterior.'">&lt;</a>
								';
							}
						
						if($x > 6 && $RepliesPage > 6 && $RepliesPage < $x) {
							$i = $RepliesPage-5;
						} elseif($RepliesPage == $x) {
							$i = $RepliesPage-10;
						} else {
							$i = 0;
						}
						$break = 0;
						$next = $RepliesPage+1;
						while($x != $i) {
							$break++;
							$i++;
							if($i == $RepliesPage) {
								echo $i.'
								';
							} else {
								echo '<a href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$i.'">'.$i.'</a>
								';
							}
							
							if($break >= 10) {
								break;
							}
							
						}
							if($x != 1 && $x <> $RepliesPage) {
								echo '<a title="Página siguiente" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$next.'">&gt;</a>
								';
								echo '<a title="Última página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$x.'">&gt;&gt;</a>';
							}
						?>
	</div>
    </div>
<script type="text/javascript">
L10N.put("myhabbo.discussion.error.topic_name_empty", "El Asunto no puede estar vacío");
L10N.put("register.error.security_code", "El código de seguridad no era válido. Por favor, inténtalo de nuevo.");
Discussions.initialize("<?php echo $group__id; ?>", "<?php write($forumType['perso_link']); ?>", "<?php echo $topicId; ?>");
Discussions.captchaPublicKey = "6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0";
</script>
<?php

		} elseif($forumType['type'] && $group_rank >= 2) {
		dbquery("INSERT INTO groups_forum_replies (user_id, content, date, topic_id, group_id) VALUES ('".USER_ID."', '".$message."', '".time()."', '".$topicId."', '".$groupId."')");
?>			
<div class="postlist-header clearfix">
							<?php if($checkTopicArray['type']) { ?>
							<span class="topic-closed"><img src="<?php echo WWW; ?>/web-gallery/images/groups/status_closed.gif" title="Asunto Privado"> Asunto Privado</span>
							<?php } if(!$checkTopicArray['type'] && LOGGED_IN || 
										$checkTopicArray['type'] && LOGGED_IN && IS_ADMIN ||
										$checkTopicArray['type'] && LOGGED_IN && IS_OWNER ||
										$checkTopicArray['type'] && LOGGED_IN && IS_CREATOR) { ?>
								<a href="#" id="create-post-message" class="create-post-link verify-email">Crear respuesta</a>
								<?php } ?>
								<input type="hidden" id="email-verfication-ok" value="1"/>
							<?php if(IS_ADMIN || IS_OWNER || IS_CREATOR) { ?>
								<a href="#" id="edit-topic-settings" class="edit-topic-settings-link">Editar Ajustes &raquo;</a>
								<input type="hidden" id="settings_dialog_header" value="Editar Ajustes"/>
							<?php }
	$count = mysql_num_rows(dbquery("SELECT null FROM groups_forum_replies WHERE topic_id = '".$topicId."';"));
	$n = $count;
	$x = 0;
		while($n >= 0)
		{
			$n = $n-10;
			$x++;
		}
		
	if(isset($_GET['page']) && is_numeric($_GET['page'])) {
		$RepliesPage = $gtfo->cleanWord($_GET['page']);
		if($RepliesPage == 1) {
			$limit = 0;
		} else {
			$limit = $RepliesPage*10-10;
		}
	} else { 
		$limit = 0;
		$RepliesPage = 1;
	}

							?>
								<div class="page-num-list">
									<input type="hidden" id="current-page" value="<?php echo $RepliesPage; ?>"/>
							Ver página:
							
						<?php
						$anterior = $RepliesPage-1;
						if($RepliesPage != 1 && $RepliesPage <= $x) {
								echo '<a title="Primera página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/1">&lt;&lt;</a>
								';
								echo '<a title="Página anterior" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$anterior.'">&lt;</a>
								';
							}
						
						if($x > 6 && $RepliesPage > 6 && $RepliesPage < $x) {
							$i = $RepliesPage-5;
						} elseif($RepliesPage == $x) {
							$i = $RepliesPage-10;
						} else {
							$i = 0;
						}
						$break = 0;
						$next = $RepliesPage+1;
						while($x != $i) {
							$break++;
							$i++;
							if($i == $RepliesPage) {
								echo $i.'
								';
							} else {
								echo '<a href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$i.'">'.$i.'</a>
								';
							}
							
							if($break >= 10) {
								break;
							}
							
						}
							if($x != 1 && $RepliesPage <> $x) {
								echo '<a title="Página siguiente" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$next.'">&gt;</a>
								';
								echo '<a title="Última página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$x.'">&gt;&gt;</a>';
							}
						?>
						</div>
							</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<?php 
$GetTopic = dbquery("SELECT id,user_id,date,type,title FROM groups_forum_topics WHERE id = '".$topicId."' LIMIT 1;");

if(mysql_num_rows($GetTopic)) {
	$i = 0;
	$dataTopic = mysql_fetch_array($GetTopic);
	$first_username = $users->id2name($dataTopic['user_id']);
	$FirstUserData = mysql_fetch_array(dbquery("SELECT look,motto FROM users where id = '".$dataTopic['user_id']."' LIMIT 1;"));
				}

	$GetReplies = dbquery("SELECT id,user_id,content,date,is_edited,is_first FROM groups_forum_replies WHERE topic_id = '".$topicId."' LIMIT ".$limit.",10;");


if(mysql_num_rows($GetReplies)) {
	while($dataReplies = mysql_fetch_array($GetReplies)) {
	$first_username = $users->id2name($dataReplies['user_id']);
	$FirstUserData = mysql_fetch_array(dbquery("SELECT look,motto FROM users where id = '".$dataReplies['user_id']."' LIMIT 1;"));
?>
<tr class="post-list-index-<?php if(IsEven($i)) { echo 'even'; } else { echo 'odd'; } ?>">
	<td class="post-list-row-container">
		<a href="/home/<?php echo $dataReplies['user_id']; ?>/id" class="post-list-creator-link post-list-creator-info"><?php write($first_username); ?></a>
				<?php
				if(!$users->IsUserOnline($dataReplies['user_id'])) {
				?>
				<img alt="offline" src="http://images.xukys-hotel.com/web-gallery/images/myhabbo/habbo_offline.gif"/>
				<?php } else { ?>
				<img alt="online" src="http://images.xukys-hotel.com/web-gallery/images/myhabbo/habbo_online_anim.gif"/>
				<?php } 
				$GetCountMsgOnTopics = mysql_fetch_array(dbquery("SELECT COUNT(id) AS first_count FROM groups_forum_topics WHERE user_id = '".$dataReplies['user_id']."'"));
				$first = $GetCountMsgOnTopics['first_count'];
				$GetCountMsgOnReplies = mysql_fetch_array(dbquery("SELECT COUNT(id) AS second_count FROM groups_forum_replies WHERE user_id = '".$dataReplies['user_id']."'"));
				$second = $GetCountMsgOnReplies['second_count'];
				$AllCount = $first+$second;
				?>
		<div class="post-list-posts post-list-creator-info">Mensaje: <?php echo $AllCount; ?></div>
		<div class="clearfix">
			<div class="post-list-creator-avatar"><img src="http://images.xukys-hotel.com/habbo-imaging/avatarimage.php?figure=<?php echo $FirstUserData['look']; ?>&amp;size=b" alt=""/></div>
			<div class="post-list-group-badge">
				<?php
				$groupFavoriteData = $users->GetFavoriteGroupArray($dataReplies['user_id']);
				if($groupFavoriteData != false) {
				?>
				<a href="/groups/<?php echo $groupFavoriteData['id']; ?>/id">
					<img src="http://images.xukys-hotel.com/habbo-imaging/badge.php?badge=<?php echo $groupFavoriteData['badge']; ?>" alt="" />
				</a>
				<?php } ?>
			</div>
			<div class="post-list-avatar-badge"><img src="http://images.xukys-hotel.com/c_images/album1584/<?php echo $users->GetFirstBadge($dataReplies['user_id']); ?>.gif"/></div>
		</div>
		<div class="post-list-motto post-list-creator-info"><?php write($FirstUserData['motto']); ?></div>
	</td>
	<td class="post-list-message" valign="top" colspan="2">
		<?php if(LOGGED_IN) { ?>
		<a href="#" class="quote-post-link verify-email" id="quote-post-<?php echo $dataReplies['id']; ?>-message">Con Cita</a>
		<?php } if(LOGGED_IN && USER_ID == $dataReplies['user_id'] && !$checkTopicArray['type']) { ?>
		<a href="#" class="edit-post-link verify-email" id="edit-post-<?php echo $dataReplies['id']; ?>-message">Editar</a>
		<?php } ?>
		<span class="post-list-message-header"><?php if($i != 0) { echo 'RE: '; } ?><?php write($dataTopic['title']); ?></span>
		<br/>
		<span class="post-list-message-time">
		<?php echo date('d-M-Y', $dataReplies['date']); ?>
		(<?php echo date('H:i', $dataReplies['date']); ?>)</span>

		<div class="post-list-report-element">
		<?php if(IS_ADMIN && !$checkTopicArray['type'] ||
				IS_OWNER && !$checkTopicArray['type']) { ?>
			<a href="#" id="delete-post-<?php echo $dataReplies['id']; ?>" class="delete-button delete-post"></a>
			<?php } ?>
			<?php if(LOGGED_IN && USER_ID != $dataReplies['user_id'] ) { ?>
			<a href="#" id="report-post-<?php echo $dataReplies['id']; ?>" class="create-report-button report-post"></a>
			<?php } ?>
		</div>
		<div class="post-list-content-element">
		<?php if($dataReplies['is_edited']) { ?>
		<span class="post-list-message-edited">Última edición:</span><br />
		<?php } ?>
		<?php echo fixText(uberCore::BBcode($dataReplies['content']), false, false, true, false, true); ?>
		
		<input type="hidden" id="<?php echo $dataReplies['id']; ?>-message" value="<?php write($dataReplies['content']); ?>"/>
		</div>
		<div>
		</div>
	</td>
</tr>
<?php
	$i++;
	}
}
?>
<tr id="new-post-entry-message" style="display:none;">

	<td class="new-post-entry-label"><div class="new-post-entry-label" id="new-post-entry-label">Mensaje:</div></td>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" style="margin: 5px; width: 98%;">
		<tr>
		<td>
		<input type="hidden" id="edit-type" />
		<input type="hidden" id="post-id"  />
        <a href="#" class="preview-post-link" id="post-form-preview">Previa &raquo;</a>
        <input type="hidden" id="spam-message" value="¡Se ha detectado spam!"/>
		<textarea id="post-message" class="new-post-entry-message" rows="5" name="message" ></textarea>
    <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("post-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Rojo"],
            "orange" : ["#fe6301", "Naranja"],
            "yellow" : ["#ffce00", "Amarillo"],
            "green" : ["#6cc800", "Verde"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Azul"],
            "gray" : ["#828282", "Gris"],
            "black" : ["#000000", "Negro"]
        };
        bbcodeToolbar.addColorSelect("Color", colors, false);
    </script>
<div id="linktool-inline">
    <div id="linktool-scope">
        <label for="linktool-query-input">Crear link:</label>
        <input type="radio" name="scope" class="linktool-scope" value="1" checked="checked"/>Habbos
        <input type="radio" name="scope" class="linktool-scope" value="2"/>Salas
        <input type="radio" name="scope" class="linktool-scope" value="3"/>Grupos&nbsp;
    </div>
    <div class="linktool-input">
        <input id="linktool-query" type="text" size="30" name="query" value=""/>
        <input id="linktool-find" class="search" type="submit" title="Buscar" value=""/>
    </div>
    <div class="clear" style="height: 0;"><!-- --></div>
    <div id="linktool-results" style="display: none">
    </div>
    <script type="text/javascript">
        linkTool = new LinkTool(bbcodeToolbar.textarea);
    </script>
</div>
	    <div id="discussion-captcha">

<h3>
<label for="bean_captcha" class="registration-text">Teclea el código de seguridad que aparece en la imagen</label>
</h3>

<div id="captcha-code-error"></div>

<p></p>

<div class="register-label" id="recaptcha-reload">
    <p>
        <img src="http://images.xukys-hotel.com/web-gallery/v2/images/shared_icons/reload_icon.gif" width="15" height="15" alt=""/>
        <a id="recaptcha-reload-link" href="#">Intenta con palabras diferentes</a>
    </p>
</div>

<script type="text/javascript">
document.observe("dom:loaded", function() {
    Event.observe($("recaptcha-reload"), "click", function(e) {Event.stop(e); Utils.reloadRecaptcha()});
});
</script>

<div id="recaptcha_challenge">
  <div id="recaptcha_image"></div>

  <p>
    <input type="text" name="recaptcha_response_field" id="recaptcha_response_field" value="" class="registration-text required-captcha" />
  </p>
</div></div>
        <div class="button-area">
            <a id="post-form-cancel" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
            <a id="post-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
        </div>
        </td>
        </tr>
        </table>
	</td>
</tr>
</table>
<div id="new-post-preview" style="display:none;">
</div>
    <div class="postlist-footer clearfix">
	<?php if($checkTopicArray['type']) { ?>
							<span class="topic-closed"><img src="<?php echo WWW; ?>/web-gallery/images/groups/status_closed.gif" title="Asunto Privado"> Asunto Privado</span>
	<?php } if($checkTopicArray['type'] == 0 && LOGGED_IN || 
										$checkTopicArray['type'] && LOGGED_IN && IS_ADMIN ||
										$checkTopicArray['type'] && LOGGED_IN && IS_OWNER ||
										$checkTopicArray['type'] && LOGGED_IN && IS_CREATOR) { ?>
            <a href="#" id="create-post-message-lower" class="create-post-link verify-email">Crear respuesta</a>
			<?php } ?>
        <div class="page-num-list">
    Ver página:
						<?php
						$anterior = $RepliesPage-1;
						if ($RepliesPage != '1' && $RepliesPage <= $x) {
								echo '<a title="Primera página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/1">&lt;&lt;</a>
								';
								echo '<a title="Página anterior" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$anterior.'">&lt;</a>
								';
							}
						
						if($x > 6 && $RepliesPage > 6 && $RepliesPage < $x) {
							$i = $RepliesPage-5;
						} elseif($RepliesPage == $x) {
							$i = $RepliesPage-10;
						} else {
							$i = 0;
						}
						$break = 0;
						$next = $RepliesPage+1;
						while($x != $i) {
							$break++;
							$i++;
							if($i == $RepliesPage) {
								echo $i.'
								';
							} else {
								echo '<a href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$i.'">'.$i.'</a>
								';
							}
							
							if($break >= 10) {
								break;
							}
							
						}
							if($x != 1 && $x <> $RepliesPage) {
								echo '<a title="Página siguiente" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$next.'">&gt;</a>
								';
								echo '<a title="Última página" href="/groups/'.$qryId.'/discussions/'.$topicId.'/id/page/'.$x.'">&gt;&gt;</a>';
							}
						?>
	</div>
    </div>
<script type="text/javascript">
L10N.put("myhabbo.discussion.error.topic_name_empty", "El Asunto no puede estar vacío");
L10N.put("register.error.security_code", "El código de seguridad no era válido. Por favor, inténtalo de nuevo.");
Discussions.initialize("<?php echo $group__id; ?>", "<?php write($GroupData['perso_link']); ?>", "<?php echo $topicId; ?>");
Discussions.captchaPublicKey = "6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0";
</script>
<?php			
		}
	}
} else { die('?'); } 

}
?>