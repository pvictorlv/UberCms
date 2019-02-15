<?php
$Type = $_GET["scope"];
$Data = filter($_GET["query"]);
$Query = Array();

if(strlen($Data) > 2)
{
	if($Type == "1")
	{
		$resultType = "habbo";
		$Name = "username";
		$Query = dbquery("SELECT id, username FROM users WHERE username LIKE '%" . $Data . "%' LIMIT 5");
	}
	else if($Type == "2")
	{
		$resultType = "room";
		$Name = "caption";
		$Query = dbquery("SELECT id, caption FROM rooms WHERE caption LIKE '%" . $Data . "%' LIMIT 5");
	}
	else if($Type == "3")
	{
		$resultType = "group";
		$Name = "name";
		$Query = dbquery("SELECT id, name FROM groups_details WHERE name LIKE '%" . $Data . "%' LIMIT 5");
	}
}
?>
<ul>
	<li>Clique para adicionar ao documento</li>
<?php
while ($Row = $Query->fetch_assoc())
{
?>
    <li><a href="#" class="linktool-result" type="<?php echo $resultType; ?>" 
    	value="<?php echo $Row["id"]; ?>" title="<?php echo $Row[$Name]; ?>"><?php echo $Row[$Name]; ?></a></li>
<?php
}
?>