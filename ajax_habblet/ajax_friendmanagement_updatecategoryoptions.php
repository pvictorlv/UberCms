<?php
session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getID);
$my_id = $b['id'];

?>
<select id="category-list-select" name="category-list">
    <option value="0">Amigos</option>
	<?php
	$get_categorys = mysql_query("SELECT * FROM messenger_categorys WHERE owner_id = '".$my_id."'") or die(mysql_error());
	if(mysql_num_rows($get_categorys) > 0){
		while($crow = mysql_fetch_assoc($get_categorys)){
	$get_category = mysql_query("SELECT * FROM messenger_categorys WHERE id = '".$crow['id']."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($get_category);
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
	<?php } } ?>
</select>
<div class="friend-del"><a class="new-button red-button cancel-icon" href="#" id="delete-friends"><b><span></span>Eliminar amigos</b><i></i></a></div>
<div class="friend-move"><a class="new-button" href="#" id="move-friend-button"><b><span></span>Mover</b><i></i></a></div>  