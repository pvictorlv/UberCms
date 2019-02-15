<?php

function restoreWaitingItems($userId)
	{
		mysql_query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . $userId . "'");
	}

function CleanText($str, $filterHTML = true)
	{
		$str = stripslashes(trim($str));

		if ($filterHTML)
		{
			$str = htmlentities($str);
		}
		
		$str = nl2br($str);
		
		return $str;
	}

function HoloText($str, $advanced=false) {
        $str = stripslashes($str);
        if($advanced != true){ $str = htmlspecialchars($str,ENT_COMPAT,"UTF-8"); }
        return $str;
}

function getData($id)
{
	$sql = mysql_query("SELECT * FROM users WHERE username = '" . $id . "' OR id = '" . $id . "' LIMIT 1");
	$exist = mysql_num_rows($sql);
		
	if($exist > 0)
	{
		return $sql;
	}
	else
	{
		return false;
	}
}


function FilterText($str, $antihtml = true)
	{
		$str = stripslashes($str);

		if($antihtml)
			$str = htmlentities(html_entity_decode($str));

		$str = mysql_real_escape_string($str);
		$str = @mb_convert_encoding($str, "UTF-8", "auto");
		$str = str_replace('&amp;', '&', $str);

		//$str = str_replace("\ h", "&#92;", $str);
		$str = str_replace("'", "&#39;", $str);
		
		// Devolver cadena filtrada.
		return $str;
	}

function SwitchWordFilter($str)
{

$sql = mysql_query("SELECT word FROM wordfilter") or die(mysql_error());

	while($row = mysql_fetch_assoc($sql)){
	$str = str_replace($row['word'],getServer("wordfilter_censor"),$str);
	}

return $str;

}

function textInJS($str, $clean = false){
	$str = str_replace("¡","�",$str);
	$str = str_replace("¿","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("ñ","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("á","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("é","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("ó","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("ú","�",$str);
	$str = str_replace("��","�",$str);
	$str = str_replace("�","�",$str);
	
	if($clean == true)
	{
	$str = str_replace("�","N",$str);
	$str = str_replace("�","n",$str);
	$str = str_replace("�","A",$str);
	$str = str_replace("�","a",$str);
	$str = str_replace("�","E",$str);
	$str = str_replace("�","e",$str);
	$str = str_replace("�","O",$str);
	$str = str_replace("�","o",$str);
	$str = str_replace("�","U",$str);
	$str = str_replace("�","u",$str);
	$str = str_replace("�","I",$str);
	$str = str_replace("�","i",$str);
	}
	
	return $str;
}

function GetUserGroup($userId){

$check = mysql_query("SELECT groupid FROM groups_memberships WHERE userid = '".$userId."' AND is_current = '1' LIMIT 1") or die(mysql_error());
$has_fave = mysql_num_rows($check);

	if($has_fave > 0){

		$row = mysql_fetch_assoc($check);
		$groupid = $row['groupid'];

		return $groupid;

	} else {

		return false;

	}
}

function GetUserBadge($strName)
{ 

	$check = mysql_query("SELECT id FROM users WHERE (id = '".FilterText($strName)."' OR username = '".FilterText($strName)."') AND badge_status = '1' LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);

		if($exists > 0){
			$usrrow = mysql_fetch_assoc($check);
			$check = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$usrrow['id']."' LIMIT 1") or die(mysql_error());
			$hasbadge = mysql_num_rows($check);
			if($hasbadge > 0){
				$badgerow = mysql_fetch_assoc($check);
				return $badgerow['badge_id'];
                } else {
				return false;
			}
		} else {
			return false;
		}
}

function IsUserOnline($intUID, $inWeb = false)
{

$result = mysql_query("SELECT online FROM users WHERE id = '".FilterText($intUID)."' LIMIT 1") or die(mysql_error());
$row = mysql_fetch_assoc($result);
$time_compare = (time() - 501);

if($inWeb == false)
{
	if($row['online'] >= $time_compare){ return true; } else { return false; }
}
else
{
	if($row['web_online'] >= $time_compare){ return true; } else { return false; }
}
	
}



$H = date('H');
$i = date('i');
$s = date('s');
$m = date('m');
$d = date('d');
$F = date('F');
$Y = date('Y');
$j = date('j');
$n = date('n');
$M = date('M');
$A = date('A');
$y = date('y');

$date_normal = date('d-m-Y', mktime($m, $d, $Y));
$date_reversed = date('Y-m-d', mktime($m, $d, $y));
$date_name = $d . "-" . $F . "-" . $Y . " " . $H . ":" . $i . ":" . $s;

function replacee($str)
{
$str = str_replace("\\r\\n","<br>",$str);

 
 return ($str);
}

function getHC($id)
	{
		$sql = mysql_query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_club' AND user_id = '".$id."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}

		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
		
	}

	function getVIP($id)
	{
		$sql = mysql_query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_vip' AND user_id = '".$id."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}
		
		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
		
	}

	
?>