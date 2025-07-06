<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['topicId']) && is_numeric($_POST['topicId'])) {
	$groupId = $gtfo->cleanWord($_POST['groupId']);
	$topicId = $gtfo->cleanWord($_POST['topicId']);
	$checkTopic = db::query("SELECT type,sticky,title FROM groups_forum_topics WHERE id = ?' AND group_id = '".$groupId."' LIMIT 1;");
	
	if($core->GetGroupPerm($groupId) < 2) {
?>	
<div class="postlist-header clearfix">
        Imposible realizar ajustes <br />
</div><a href="#" class="new-button" id="general-info-dialog-button"><b>OK</b><i></i></a>
<div class="clear"></div>
<?php
die();
	}	
	if($checkTopic->rowCount()) {
	$TopicData = $checkTopic->fetch(PDO::FETCH_ASSOC);
?>
<form action="#" method="post" id="topic-settings-form">
	<div id="topic-name-area">
	    	<div class="topic-name-input">
	    		<span class="topic-name-text" id="topic_name_text">Asunto: (m�x 32 caracteres)</span>
	    	</div>
	    	<div class="topic-name-input">
	    		<input type="text" size="40" maxlength="32" name="topic_name" id="topic_name" onKeyUp="GroupUtils.validateGroupElements('topic_name', 32, 'myhabbo.topic.name.max.length.exceeded');" value="<?php write($TopicData['title']); ?>"/>
			</div>
            <div id="topic-name-error"></div>
            <div id="topic_name_message_error" class="error"></div>
    </div>
	<div id="topic-type-area">
		<div class="topic-type-label">
			<span class="topic-type-label">Tipo:</span>
		</div>
	    <div class="topic-type-input">
	    	<input type="radio" name="topic_type" id="topic_open" value="0" <?php if(!$TopicData['type']) { echo 'checked="true"'; } ?> /> P�blico<br />
			<input type="radio" name="topic_sticky" id="topic_normal" value="0" <?php if(!$TopicData['sticky']) { echo 'checked="true"'; } ?> /> Normal
	    </div>
	    <div class="topic-type-input">
	    	 <input type="radio" name="topic_type" id="topic_closed" value="1" <?php if($TopicData['type']) { echo 'checked="true"'; } ?> /> Privado<br />
			 <input type="radio" name="topic_sticky" id="topic_sticky" value="1" <?php if($TopicData['sticky']) { echo 'checked="true"'; } ?> /> Asunto complejo
	    </div>
	</div>
	<br clear="all"/>
	<br clear="all"/>
	<div id="topic-button-area" class="topic-button-area">
		<a href="#" class="new-button cancel-topic-settings" id="cancel-topic-settings"><b>Cancelar</b><i></i></a>
		<a href="#" class="new-button delete-topic" id="delete-topic"><b>Eliminar</b><i></i></a>
		<a href="#" class="new-button save-topic-settings" style="float:left; margin:0px;" id="save-topic-settings"><b>Ok</b><i></i></a>
	</div>
</form>
<div class="clear"></div>
<?php
	} else {
?>
<div class="postlist-header clearfix">
        Imposible realizar ajustes <br />
</div><a href="#" class="new-button" id="general-info-dialog-button"><b>OK</b><i></i></a>
<div class="clear"></div>
<?php
	}
}
?>