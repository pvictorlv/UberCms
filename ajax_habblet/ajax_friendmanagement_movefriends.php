<?php
session_start();
require_once("../global.php");
$getID = db::query("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = $getID->fetch(PDO::FETCH_ASSOC);
$my_id = $b['id'];

$friend_id = HoloText($_POST['friendList']);
$move_category = HoloText($_POST['moveCategoryId']);
$pagesize = HoloText($_POST['pageSize']);
$categoryid = HoloText($_POST['categoryId']);

if(empty($move_category)){
$move_category = "0";
}
if(empty($categoryid)){
$categoryid = "0";
}

if(is_numeric($friend_id) && is_numeric($move_category)){

Db::query("UPDATE messenger_friendships SET category = '".$move_category."' WHERE user_two_id = ? AND user_one_id = '".$my_id."' LIMIT 1")

}
?>
<div id="friend-list" class="clearfix">
<div id="friend-list-header-container" class="clearfix">
    <div id="friend-list-header">
        <div class="page-limit">
            <div class="big-icons friend-header-icon">Amigos
                <br />Ver
           		<?php if($pagesize == 30){ ?>
                30 |
                <a class="category-limit" id="pagelimit-50">50</a> |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 50){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				50 |
                <a class="category-limit" id="pagelimit-100">100</a>
                <?php }elseif($pagesize == 100){ ?>
                <a class="category-limit" id="pagelimit-30">30</a> |
				<a class="category-limit" id="pagelimit-50">50</a> |
                100
                <?php } ?>
            </div>
        </div>
    </div>
	<div id="friend-list-paging">
		<?php
		if($page <> 1){
		$pageminus = $page - 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageminus."\">&lt;&lt;</a> |";
		}
		$afriendscount = Db::query("SELECT COUNT(*) FROM messenger_friendships WHERE user_one_id = ? AND category = '".$categoryid."'")
		$friendscount = $afriendscount, 0->fetchColumn();
		$pages = ceil($friendscount / $pagesize);
		if($pages == 1){
		echo "1";
		}else{
		$n = 0;

		while ($n < $pages) {
			$n++;
			if($n == $page){
			echo $n." |";
			} else {
			echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$n."\">".$n."</a> |";
			}
		}

		if($page <> $pages){
		$pageplus = $page + 1;
		echo "<a href=\"#\" class=\"friend-list-page\" id=\"page-".$pageplus."\">&gt;&gt;</a>";
		}
		}
		?>
        </div>
    </div>

<form id="friend-list-form">
     <table id="friend-list-table" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="friend-list-header">
                <th class="friend-select" />
                <th class="friend-name">
					<a class="sort">Nombre</a>
				</th>
                <th class="friend-login">
					<a class="sort">Último acceso</a>
				</th>
                <th class="friend-remove">Quitar</th>
            </tr>
		</thead>
		<tbody>
           <?php
		   $i = 0;
		   $offset = $pagesize * $page;
		   $offset = $offset - $pagesize;
		   $offset = $offser + 30;
		   $getem = Db::query("SELECT * FROM messenger_friendships WHERE user_one_id = ? AND category = '".$categoryid."' LIMIT ".$pagesize." OFFSET ".$offset."")

		   while ($row = $getem->fetch(PDO::FETCH_ASSOC)) {
		           $i++;

		           if($i%2==1){
		               $even = "odd";
		           } else {
		               $even = "even";
		           }

		           		$friendsql = Db::query("SELECT * FROM users WHERE id = ?'");


		           $friendrow = $friendsql->fetch(PDO::FETCH_ASSOC);
				   ?>
		    <tr class="<?php echo $even; ?>">
				<td><input type="checkbox" name="friendList" value="<?php echo $friendrow['id']; ?>" /></td>
				<td class="friend-name">
				<?php echo $friendrow['username']; ?>
				</td>
				<td class="friend-login" title="<?php echo $friendrow['last_online']; ?>"><?php echo timestamp($friendrow['last_online']); ?></td>
				<td class="friend-remove"><div id="remove-friend-button-<?php echo $friendrow['id']; ?>" class="friendmanagement-small-icons friendmanagement-remove remove-friend"></div></td>
			</tr>
			<?php } ?>
        </tbody>
    </table>
    <a class="select-all" id="friends-select-all" href="#">Seleccionar todo</a> |
    <a class="deselect-all" href=#" id="friends-deselect-all">Quitar selección</a>
</form>
<div id="category-options" class="clearfix">
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
