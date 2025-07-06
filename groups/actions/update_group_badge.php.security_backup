<?php
/*=========================================================+
|| # Azure Files of XDRCMS. All rights reserved.
|| # Copyright © 2012 Xdr.
|+=========================================================+
|| # Xdr 2012. The power of Proyects.
|| # Este es un Software de código libre, libre edición.
|+=========================================================+
*/

$require_login = true;

require_once('../../Kernel/Init.php');

$groupid = FilterText($_POST['groupId']);
$badge = str_replace("NaN", "", $_POST['code']);
$appkey = FilterText($_POST['__app_key']);

if(!is_numeric($groupid)){ exit; }

$check = mysql_query("SELECT member_rank FROM groups_memberships WHERE userid = '".$my_id."' AND groupid = '".$groupid."' AND member_rank > 1 AND is_pending = '0' LIMIT 1") or die(mysql_error());
$is_member = mysql_num_rows($check);

if($is_member > 0){
    $my_membership = mysql_fetch_assoc($check);
    $member_rank = $my_membership['member_rank'];
    if($member_rank < 2){ exit; }
} else {
    exit;
}

$check = mysql_query("SELECT * FROM groups_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($check);
$row = mysql_fetch_assoc($check);

if($valid > 0){ $groupdata = mysql_fetch_assoc($check); } else { exit; }
if($badge !== $row['badge']) {
if($row['badge'] !== "b0711Xs18061s31107s17133") {

$image = "../habbo-imaging/cache/badges/".$row['badge'].".gif";
if(file_exists($image)) {
unlink($image);
}

}
}

mysql_query("UPDATE groups_details SET badge = '".$badge."' WHERE id = '".$groupid."' LIMIT 1");
header("Location:".PATH."/groups/".$groupid."/id/BadgeUpdated"); exit;
?> 