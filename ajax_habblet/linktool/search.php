<?php

require "../../global.php";

$Type = ($_GET["scope"]);
$Data = ($_GET["query"]);
$Query = Array();

if(strlen($Data) > 2)
{
	if($Type == "1")
	{
		$resultType = "habbo";
		$Name = "username";
		$Query = db::query("SELECT id, username FROM users WHERE username LIKE ? LIMIT 5", "%$Data%");
	}
	else if($Type == "2")
	{
		$resultType = "room";
		$Name = "caption";
		$Query = db::query("SELECT id, caption FROM rooms WHERE caption LIKE ? LIMIT 5", "%$Data%");
	}
	else if($Type == "3")
	{
		$resultType = "group";
		$Name = "name";
		$Query = db::query("SELECT id, name FROM groups_details WHERE name LIKE ? LIMIT 5", "%$Data%");
	}
}
?>
<ul>
	<li>Haz clic para a�adirlo al documento</li>
<?php
while ($Row = $Query->fetch(2))
{
?>
    <li><a href="#" class="linktool-result" type="<?php echo $resultType; ?>" 
    	value="<?php echo $Row["id"]; ?>" title="<?php echo $Row[$Name]; ?>"><?php echo $Row[$Name]; ?></a></li>
<?php
}
?>