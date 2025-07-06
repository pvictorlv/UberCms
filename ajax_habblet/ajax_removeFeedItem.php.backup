<?php
require_once("../global.php");

		if (!LOGGED_IN)
		{
			echo 'Fuck You ;)';exit;
		}


if ($_POST["feedItemIndex"])
		{
$ospina = $_POST["feedItemIndex"];
db::query("DELETE FROM cms_alerts WHERE id = '".$ospina."'") or die(mysql_error());
echo "Eliminado";
		}else{};

?>