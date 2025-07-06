<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['searchString']) && !empty($_POST['searchString'])) {
	$searchString = $gtfo->cleanWord($_POST['searchString']);
	$usuario_sql = db::query("SELECT id FROM users WHERE username LIKE '".$searchString."%'");
	$putId = NULL;
	$i = 0;
	while($usuario = mysql_fetch_array($usuario_sql)) {
		$i++;
		$putId .= 'userid = \''.$usuario['id'].'\'';
			
			if($i != mysql_num_rows($usuario_sql)) {
				$putId .= ' OR ';
			}
	}
}

if(isset($_POST['pending']) && $_POST['pending']) {
	$pending = 1;
}

if(isset($_POST['groupId']) && is_numeric($_POST['groupId'])) {
	if(isset($_POST['pageNumber']) && is_numeric($_POST['pageNumber'])) {
		$pageNumber = $gtfo->cleanWord($_POST['pageNumber']); 
	}
	else { 
		$pageNumber = 1;
	}
	
	$groupId = $gtfo->cleanWord($_POST['groupId']);
	
	switch($pageNumber) {
		case 1:
			$limit = 0;
			break;
		case 2:
			$limit = 20;
			break;
		case 3:
			$limit = 40;
			break;
		case 4:
			$limit = 60;
			break;
		case 5:
			$limit = 80;
			break;
		case 6:
			$limit = 100;
			break;
		case 7:
			$limit = 120;
			break;
		case 8:
			$limit = 140;
			break;
		case 9:
			$limit = 160;
			break;
		case 10:
			$limit = 180;
			break;
		case 11:
			$limit = 200;
			break;
		case 12:
			$limit = 220;
			break;
		case 12:
			$limit = 240;
			break;	
		default:
			$limit = 0;
			break;
	}
	
	$count = mysql_num_rows(db::query("SELECT userid FROM groups_memberships WHERE groupid = '".$groupId."';"));
	$count_real = $count;
	$count_wait = mysql_num_rows(db::query("SELECT userid FROM groups_memberships WHERE groupid = '".$groupId."' AND is_pending = '1';"));
	
	if(isset($pending) && isset($putId)) {
		$sql = db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND (".$putId.") AND is_pending = '1' ORDER BY member_rank LIMIT $limit,20");
		$count = mysql_num_rows(db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND (".$putId.") AND is_pending = '1'"));
		$test = 'if 1';
	}
	elseif(isset($pending) && !isset($putId)) {
		$sql = db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND is_pending = '1' ORDER BY member_rank LIMIT $limit,20");
		$count = mysql_num_rows(db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND is_pending = '1'"));
		$test = 'elseif 2';
	}
	elseif(isset($putId) && !isset($pending)) {
		$sql = db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND (".$putId.") ORDER BY member_rank LIMIT $limit,20");
		$count = mysql_num_rows(db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' AND (".$putId.");"));
		$test = 'elseif 3';
	}
	else {
		$sql = db::query("SELECT userid,member_rank FROM groups_memberships WHERE groupid = '".$groupId."' ORDER BY member_rank LIMIT 20");
		$test = 'else';
	}
	
	$n = $count;
	$x = 0;
		while($n >= 0)
		{
			$n = $n-20;
			$x++;
		}
	header('X-JSON: {"pending":"Lista de espera ('.$count_wait.')","members":"Miembros ('.$count_real.')"}');
?>
<div id="group-memberlist-members-list">
<?php if(mysql_num_rows($sql) > 0) { ?>
	<form method="post" action="#" onsubmit="return false;">
		<ul class="habblet-list two-cols clearfix">
<?php
$counter = 0;
$rights = 0;
$lefts = 0;
while($data = mysql_fetch_array($sql)) {
$counter++;
if($data['member_rank'] == 3) {
	$OWNER = true;
	$ADMIN = false;
	$member = false;
	}
elseif($data['member_rank'] == 2) {
	$OWNER = false;
	$ADMIN = true;
	$member = false;
	}
elseif($data['member_rank'] == 1) {
	$OWNER = false;
	$ADMIN = false;
	$member = true;
	}	
	
if(IsEven($counter)) { 
	$pos = "right"; 
	$rights++;
} else {
	$pos = "left"; 
	$lefts++; 
}
if(IsEven($lefts)) {
	$oddeven = "odd"; 
} else { 
	$oddeven = "even";	
}	
?>

			<li class="<?php echo $oddeven; ?> <?php if($users->IsUserOnline($data['userid'])) { echo 'online'; } else { echo 'offline'; } ?> <?php echo $pos; ?>">
				<div class="item" style="padding-left: 5px; padding-bottom: 4px;">
					<div style="float: right; width: 16px; height: 16px; margin-top: 1px">
						<?php if($data['member_rank'] == 3) { echo '<img src="'.WWW.'/web-gallery/images/groups/owner_icon.gif" width="15" height="15" alt="Due�@" title="Due�@" />'; } 
						elseif($data['member_rank'] == 2) { echo '<img src="'.WWW.'/web-gallery/images/groups/administrator_icon.gif" width="15" height="15" alt="Administrador" title="Administrador" />'; } 
						?>
					</div>
						<input type="checkbox" <?php if(!$OWNER) { ?>id="group-memberlist-<?php if($ADMIN) { echo 'a'; } elseif($MEMBER) { echo 'm'; } ?>-<?php echo $data['userid']; ?>"<?php } else { echo 'disabled="disabled"'; } ?> style="margin: 0; padding: 0; vertical-align: middle"/>
					<a class="home-page-link" href="/home/<?php echo $users->Id2Name($data['userid']); ?>"><span><?php echo $users->Id2Name($data['userid']); ?></span></a>
				</div>
			</li>
<?php
	}
?>
		</ul>
	</form>
<?php } else { ?>	
<p>
No hay KekoMax's a la espera
</p>
<?php } ?>
</div>
<div id="member-list-pagenumbers"><?php 
if($count > 0) { echo $limit+20-19; ?> - <?php echo $limit+20; } else { echo '0'; } ?> / <?php echo $count; ?></div>
<div id="member-list-paging" >
<?php
if($count > 0) {
if($pageNumber != 1){ echo '<a href="#" class="avatar-list-paging-link" id="memberlist-search-first">'; } ?>Primero<?php if($pageNumber != 1) { echo '</a>'; } ?> |
<?php if($pageNumber != 1) { echo '<a href="#" class="avatar-list-paging-link" id="memberlist-search-previous">'; } ?>&lt;&lt;<?php if($pageNumber != 1) { echo '</a>'; } ?> |
<?php if($pageNumber != $x){ echo '<a href="#" class="avatar-list-paging-link" id="memberlist-search-next" >'; } ?>&gt;&gt;<?php if($pageNumber != $x){ echo '</a>'; } ?> |
<?php if($pageNumber != $x){ echo '<a href="#" class="avatar-list-paging-link" id="memberlist-search-last" >'; } ?>�ltimo<?php if($pageNumber != $x){ echo '</a>'; } ?>
<input type="hidden" id="pageNumberMemberList" value="<?php echo $pageNumber; ?>"/>
<input type="hidden" id="totalPagesMemberList" value="<?php echo $x; ?>"/>
</div>
<?php
 }
}
echo '<!-- '.$test.' -->';
?>