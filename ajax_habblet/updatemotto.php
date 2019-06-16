<?php

session_start();
require_once("../global.php");


if(isset($_POST['motto'])){



		$motto = mysql_real_escape_string(htmlspecialchars(substr($_POST['motto'],0,32)));
			mysql_query("UPDATE users SET motto = '".$motto."' WHERE username = '".USER_NAME."' LIMIT 1") or die(mysql_error());

echo $motto;	} else {
				$getCoins = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$myrow = mysql_fetch_assoc($getCoins);
		echo $myrow['motto'];
	}
?>