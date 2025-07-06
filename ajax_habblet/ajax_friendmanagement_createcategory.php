<?php


session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getID->fetch(PDO::FETCH_ASSOC);
$my_id = $b['id'];

$category_name = HoloText($_POST['name']);
$security_time = $_SESSION['create_category'] + (1);

if(!empty($category_name) && (empty($_SESSION['create_category']) || $security_time < time())){

Db::query("INSERT INTO messenger_categorys (name,owner_id) VALUES ('".$category_name."','".$my_id."')")
$_SESSION['create_category'] = time();

}
?>
<div id="friends-category-title">
    Categorías de Amigos
</div>

<div class="category-default category-item selected-category" id="category-item-0">Amigos</div>
<?php
$get_categorys = Db::query("SELECT * FROM messenger_categorys WHERE owner_id = ?'")
	if($get_categorys->rowCount() > 0){
	while($crow = $get_categorys->fetch(PDO::FETCH_ASSOC)){
$get_category = Db::query("SELECT * FROM messenger_categorys WHERE id = ? LIMIT 1")
$row = $get_category->fetch(PDO::FETCH_ASSOC);
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