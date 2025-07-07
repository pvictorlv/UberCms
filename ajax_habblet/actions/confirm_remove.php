<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require '../../global.php';

if(isset($_POST['groupId']) && is_numeric($_POST['groupId']) && isset($_POST['targetAccountId']) && is_numeric($_POST['targetAccountId'])) {

	$groupId = $gtfo->cleanWord($_POST['groupId']);
	$targetIds = $gtfo->cleanWord($_POST['targetAccountId']);
	
	if($core->GetGroupPerm($groupId) >= 2) {
		$check = db::query("SELECT null FROM groups_memberships WHERE groupid = ? AND userid = '".$targetIds."' LIMIT 1")->rowCount();
		
		if($check > 0) {
		$data = db::query("SELECT name FROM groups_details WHERE id = ? LIMIT 1")->fetch(PDO::FETCH_ASSOC);
			?>
<p>
�Seguro que quieres sacar del grupo <?php echo $data['name']; ?> a <?php echo $users->id2name($targetIds); ?>?"
</p>

<p>
<a href="#" class="new-button" id="group-action-cancel"><b>Cancelar</b><i></i></a>
<a href="#" class="new-button" id="group-action-ok"><b>OK</b><i></i></a>
</p>

<div class="clear"></div>

<?php
		}
	}
}
?>