<?php
session_start();
require_once("../global.php");
$getID = dbquery("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getID);
$userid = $b['id'];
$pagesize = HoloText($_POST['pageSize']);
if(isset($_POST['friendList'])){

    foreach($_POST['friendList'] as $valelim)
    {
       dbquery("DELETE FROM messenger_friendships WHERE user_one_id = '".$userid."' AND user_two_id = '".$valelim."'");
       dbquery("DELETE FROM messenger_friendships WHERE user_two_id = '".$userid."' AND user_one_id = '".$valelim."'");
    }
} elseif(isset($_POST['friendId'])){
	$friendid = $_POST['friendId'];
	dbquery("DELETE FROM messenger_friendships WHERE user_one_id = '".$userid."' AND user_two_id = '".$friendid."'");
	dbquery("DELETE FROM messenger_friendships WHERE user_two_id = '".$userid."' AND user_one_id = '".$friendid."'");
} else{
	echo "Error";
}

header("location: ajax_friendmanagement.php?pageNumber=1&pageSize=".$pagesize); exit;


?>

