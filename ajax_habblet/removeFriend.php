<?php
session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getID->fetch(PDO::FETCH_ASSOC);
$userid = $b['id'];
$pagesize = HoloText($_POST['pageSize']);
if(isset($_POST['friendList'])){

    foreach($_POST['friendList'] as $valelim)
    {
       db::query("DELETE FROM messenger_friendships WHERE user_one_id = ?' AND user_two_id = '".$valelim."'");
       db::query("DELETE FROM messenger_friendships WHERE user_two_id = ?' AND user_one_id = '".$valelim."'");
    }
} elseif(isset($_POST['friendId'])){
	$friendid = $_POST['friendId'];
	db::query("DELETE FROM messenger_friendships WHERE user_one_id = ?' AND user_two_id = '".$friendid."'");
	db::query("DELETE FROM messenger_friendships WHERE user_two_id = ?' AND user_one_id = '".$friendid."'");
} else{
	echo "Error";
}

header("location: ajax_friendmanagement.php?pageNumber=1&pageSize=".$pagesize); exit;


?>

