<?php
session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getID->fetch(PDO::FETCH_ASSOC);
$my_id = $b['id'];

?>
<select id="category-list-select" name="category-list">
    <option value="0">Amigos</option>
	<?php
	$get_categorys = Db::query("SELECT * FROM messenger_categorys WHERE owner_id = ?'")
	if($get_categorys->rowCount() > 0){
		while($crow = $get_categorys->fetch(PDO::FETCH_ASSOC)){
	$get_category = Db::query("SELECT * FROM messenger_categorys WHERE id = ? LIMIT 1")
	$row = $get_category->fetch(PDO::FETCH_ASSOC);
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
	<?php } } ?>
</select>
<div class="friend-del"><a class="new-button red-button cancel-icon" href="#" id="delete-friends"><b><span></span>Eliminar amigos</b><i></i></a></div>
<div class="friend-move"><a class="new-button" href="#" id="move-friend-button"><b><span></span>Mover</b><i></i></a></div>  