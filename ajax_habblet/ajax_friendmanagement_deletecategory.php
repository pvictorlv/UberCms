<?php
session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getID);
$my_id = $b['id'];
$category_id = FilterText($_POST['categoryId']);

if(!empty($category_id) && is_numeric($category_id)){

mysql_query("DELETE FROM messenger_categorys WHERE id = '".$category_id."' LIMIT 1") or die(mysql_error());
mysql_query("UPDATE messenger_friendships SET category = '0' WHERE user_one_id = '".$my_id."' AND category = '".$category_id."'") or die(mysql_error());

}
?>
<div id="friends-category-title">
    Categorías de Amigos
</div>

<div class="category-default category-item selected-category" id="category-item-0">Amigos</div>
<?php
$get_categorys = mysql_query("SELECT * FROM messenger_categorys WHERE owner_id = '".$my_id."'") or die(mysql_error());
	if(mysql_num_rows($get_categorys) > 0){
	while($crow = mysql_fetch_assoc($get_categorys)){
$get_category = mysql_query("SELECT * FROM messenger_categorys WHERE id = '".$crow['id']."' LIMIT 1") or die(mysql_error());
$row = mysql_fetch_assoc($get_category);
?>
    <div id="category-item-<?php echo $row['id']; ?>" class="category-item ">
        <div class="category-name" id="category-<?php echo $row['id']; ?>">
            <span class="open-category" id="category-name-<?php echo $row['id']; ?>"><?php echo $row['name']; ?></span>
            <span id="category-field-<?php echo $row['id']; ?>" style="display:none"><input class="edit-category-name" maxlength="32" id="category-input-<?php echo $row['id']; ?>" type="text" value="<?php echo $row['name']; ?>"/></span>
        </div>
        <div id="category-button-delete-<?php echo $row['id']; ?>" class="friendmanagement-small-icons friendmanagement-remove delete-category-tip"></div>
        <div id="category-button-edit-<?php echo $row['id']; ?>" class="friendmanagement-small-icons edit-category"></div>

        <div id="category-button-cancel-<?php echo $row['id']; ?>" style="display:none" class="friendmanagement-small-icons friendmanagement-remove cancel-edit-category"></div>
        <div id="category-button-save-<?php echo $row['id']; ?>" style="display:none" class="friendmanagement-small-icons friendmanagement-save save-category"></div>

    </div>
<?php } } ?>

    <input type="text" maxlength="32" id="category-name" class="create-category" /><div id="add-category-button" class="friendmanagement-small-icons add-category-item add-category"></div>