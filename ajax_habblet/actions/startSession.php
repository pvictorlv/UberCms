<?php
define('Xukys', true);
require_once('../../global.php');

if(isset($_GET['id'])) {
	if(is_numeric($_GET['id'])) {
			$qryId = $gtfo->cleanWord($_GET['id']);
			
			$sql = dbquery("SELECT * FROM groups_memberships WHERE userid = '".USER_ID."' AND groupid = '".$qryId."';");
			$is_member = mysql_num_rows($sql);
			$row = mysql_fetch_array($sql);
			
			if($is_member > 0) {
				define('IS_MEMBER', true);
			}
			else {
				define('IS_MEMBER', false);
			}
				if(IS_MEMBER && $row['member_rank'] >= 2) {	
						$_SESSION['startSessionEditGroup'] = $qryId;
						$_SESSION['startSessionEditGroupTimeStart'] = time();
						$_SESSION['startSessionEditGroupTimeStop'] = time()-1740;
						if(isset($_SESSION['startSessionEditHome'])) {
							unset($_SESSION['startSessionEditHome']);
						}
						
						header('Location: /groups/'.$qryId.'/id');
					}
				}
			}
?>