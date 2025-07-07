<?php
/*=========================================================+
|| # HabboCMS - Sistema de administración de contenido Habbo.
|+=========================================================+
|| # Copyright © 2010 Kolesias123. All rights reserved.
|| # http://www.infosmart.com.mx
|| # Partes Copyright © 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Base Copyright © 2007-2008 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|+=========================================================+
|| # InfoSmart 2010. The power of Proyects.
|| # Este es un Software de código libre, libre edición.
|+=========================================================+
|| # Todas las imagenes, scripts y temas
|| # Copyright (C) 2010 Sulake Ltd. All rights reserved.
|+=========================================================*/

require_once('../global.php');

function SwitchWordFilter($str)
{

$sql = Db::query("SELECT word FROM wordfilter")

	while($row = $sql->fetch(PDO::FETCH_ASSOC)){
	$str = str_replace($row['word'],getServer("wordfilter_censor"),$str);
	}

function HoloText($str, $advanced=false) {
                $str = stripslashes($str);
                if($advanced != true){ $str = htmlspecialchars($str,ENT_COMPAT,"UTF-8"); }
                return $str;
        }

$x = HoloText($_GET['x']);

if($x !== "topic" && $x !== "post"){ exit; }

$message = SwitchWordFilter(textInJS(HoloText($_POST['message'], false, true)));
$topicName = SwitchWordFilter(textInJS(HoloText($_POST['topicName'])));

if(empty($topicName)){ $topicName = "Previa"; } ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<tr class="post-list-index-preview">
	<td class="post-list-row-container">
		<a href="/home/<?php echo clean($users->GetUserVar(USER_ID, 'username')); ?>" class="post-list-creator-link post-list-creator-info"><?php echo clean($users->GetUserVar(USER_ID, 'username')); ?></a><br />
            &nbsp;&nbsp;<?php if(IsUserOnline('".USER_ID."')){ ?><img alt="online" src="/web-gallery/images/myhabbo/habbo_online_anim_big.gif" /><?php } else { ?><img alt="offline" src="/web-gallery/images/myhabbo/habbo_offline_big.gif" /><?php } ?>
		<div class="post-list-posts post-list-creator-info">Mensajes: <?php echo clean($users->GetUserVar(USER_ID, 'postcount')); ?></div>
		<div class="clearfix">
            <div class="post-list-creator-avatar"><img src="http://www.habbo.co.uk/habbo-imaging/avatarimage?figure=<?php echo clean($users->GetUserVar(USER_ID, 'look')); ?>&size=b&direction=2&head_direction=2&gesture=sml" alt="<?php echo $name; ?>" /></div>
            <div class="post-list-group-badge">
                	<?php if(GetUserGroup(USER_ID) !== false){ ?>
                	<a href="/groups/<?php echo GetUserGroup(USER_ID); ?>/id"><img src="/habbo-imaging/badges/<?php echo GetUserGroupBadge($my_id); ?>.gif" /></a>
		<?php } ?>
            </div>
            <div class="post-list-avatar-badge">
		<?php if(GetUserBadge(USER_ID) !== false){ ?>
			<img src="http://images.habbo.com/c_images/album1584/<?php echo GetUserBadge(USER_ID); ?>.gif" />
		<?php } ?>
	</div>
        </div>
        <div class="post-list-motto post-list-creator-info"><?php echo clean($users->GetUserVar(USER_ID, 'motto')); ?></div>
	</td>
	<td class="post-list-message" valign="top" colspan="2">
            <a href="#" id="edit-post-message" class="resume-edit-link">&laquo; Modificar</a>
        <span class="post-list-message-header"><?php echo $topicName; ?></span><br />
        <span class="post-list-message-time"><?php echo $date_name; ?></span>
        <div class="post-list-report-element">
        </div>
        <div class="post-list-content-element">
            <?php echo $message; ?>
        </div>
	<div>&nbsp;</div><div>&nbsp;</div>

        <div>
			<?php if($x == "topic"){ ?>
		        <a id="topic-form-cancel-preview" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
		        <a id="topic-form-save-preview" class="new-button green-button save-icon" href="#"><b><span></span>Guadar</b><i></i></a>
			<?php } else { ?>
				<a id="post-form-cancel" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a>
		        <a id="post-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
			<?php } ?>
	</div>
	</td>
</tr>
</table>