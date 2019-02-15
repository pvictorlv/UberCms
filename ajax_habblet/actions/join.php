<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(!LOGGED_IN) { die(); }

if(isset($_GET['groupId']) && is_numeric($_GET['groupId'])) {

	$requestGroupId = $gtfo->cleanWord($_GET['groupId']);
	
	$group_sql = dbquery("SELECT type FROM groups_details WHERE id = '".$requestGroupId."' LIMIT 1;");
	$group = mysql_fetch_array($group_sql);
	
	if(mysql_num_rows($group_sql) > 0) {
		if($group['type'] == 0) {
			$checkLimit500 = mysql_fetch_array(dbquery("SELECT count(userid) AS count FROM groups_memberships WHERE groupid = '".$requestGroupId."';"));
			
			if($checkLimit500['count'] >= 500)
			{
					die('<p>Al parecer el grupo al que intentas unirte tiene el máximo de cupo llenado (500 miembros).</p>
					<p><a href="#" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a></p>
					<div class="clear"></div>');
			}
			
			$check_user_member_sql = dbquery("SELECT userid FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".USER_ID."' LIMIT 1;");
			if(mysql_num_rows($check_user_member_sql) == 0) {
				dbquery("INSERT INTO groups_memberships (userid, groupid, member_rank) VALUES ('".USER_ID."', '".$requestGroupId."', '1')");
				?>
					<p>¡Enhorabuena, ya eres miembro del Grupo! </p>
					<p><a href="#" class="new-button" id="group-action-ok"><b>OK</b><i></i></a></p>
					<div class="clear"></div>
				<?php				
			}
			else {
			?>
<p id="dialog-errors">
Tu ya eres miembro de este grupo o tienes una peticion en espera.<br />
</p>

<p>

<a href="/groups/<?php echo $requestGroupId; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a>
</p>

<div class="clear"></div>			
			<?php
			}
		} elseif($group['type'] == 1) {
		
			$check_user_member_sql = dbquery("SELECT userid FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".USER_ID."' LIMIT 1;");
			if(mysql_num_rows($check_user_member_sql) == 0) {
				dbquery("INSERT INTO groups_memberships (userid, groupid, member_rank, is_pending) VALUES ('".USER_ID."', '".$requestGroupId."', '1', '1')");
				?>
					<p>Tu solicitud ha sido enviada.</p>
					<p><a href="#" class="new-button" id="group-action-ok"><b>OK</b><i></i></a></p>
					<div class="clear"></div>
				<?php				
			}
		else {
			?>
<p id="dialog-errors">
myhabbo.groups.already_member<br />
</p>

<p>

<a href="/groups/<?php echo $requestGroupId; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a>
</p>

<div class="clear"></div>			
			<?php
			}
		
		} elseif($group['type'] == 2) {
		
			$check_user_member_sql = dbquery("SELECT userid FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".USER_ID."' LIMIT 1;");
			if(mysql_num_rows($check_user_member_sql) == 0) {

				?>
					<p id="dialog-errors">myhabbo.groups.cannot_join_group_closed<br /></p>
					<p><a href="/groups/<?php echo $requestGroupId; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a></p>
					<div class="clear"></div>
				<?php				
			}
		else {
			?>
<p id="dialog-errors">
myhabbo.groups.already_member<br />
</p>

<p>

<a href="/groups/<?php echo $requestGroupId; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a>
</p>

<div class="clear"></div>			
			<?php
			}
		
		} elseif($group['type'] == 3) {
			
			$check_user_member_sql = dbquery("SELECT userid FROM groups_memberships WHERE groupid = '".$requestGroupId."' AND userid = '".USER_ID."' LIMIT 1;");
			if(mysql_num_rows($check_user_member_sql) == 0) {
				dbquery("INSERT INTO groups_memberships (userid, groupid, member_rank) VALUES ('".USER_ID."', '".$requestGroupId."', '1')");
				?>
					<p>¡Enhorabuena, ya eres miembro del Grupo! </p>
					<p><a href="#" class="new-button" id="group-action-ok"><b>OK</b><i></i></a></p>
					<div class="clear"></div>
				<?php				
			}
			else {
			?>
				<p id="dialog-errors">
				myhabbo.groups.already_member<br />
				</p>

				<p>

				<a href="/groups/<?php echo $requestGroupId; ?>/id" class="new-button" id="error-dialog-cancel"><b>Cerrar</b><i></i></a>
				</p>

				<div class="clear"></div>			
			<?php
			}
		}

	}









}

?>