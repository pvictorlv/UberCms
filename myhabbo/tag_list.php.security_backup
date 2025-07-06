<?php
define('Xukys', true);
define('NOWHOS', true);
include '../global.php';
?>
<div id="profile-tags-container">
<?php
	$accountId = $gtfo->cleanWord($_POST['accountId']);
	$sql = mysql_query("SELECT * FROM users_tags WHERE user_id = '".$accountId."'");
	if(mysql_num_rows($sql) > 0)
	{
	while($data = mysql_fetch_array($sql))
	{

?>
    <span class="tag-search-rowholder">
        <a href="http://xukys-hotel.com/tag/<?php echo fixText($data['tag'], true, false, true, false, false); ?>" class="tag"><?php echo fixText($data['tag'], true, false, true, false, false); ?></a><div class="tag-id" style="display:none"><?php echo $data['id']; ?></div><?php if(USER_ID == $data['user_id']) { ?><img border="0" class="tag-delete-link" onmouseover="this.src='<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'" onmouseout="this.src='<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif'" src="<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif"><?php } ?>
    </span>
<?php
	$query = mysql_query("SELECT user_id FROM users_tags WHERE tag = '".$data['tag']."' AND user_id = '".USER_ID."' AND user_id != '".$data['user_id']."' LIMIT 1");
	if(mysql_num_rows($query) > 0)
	{

?>
    <img id="tag-img-added" border="0" class="tag-none-link" src="<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_added.gif" style="display:none">    
<?php
	}
?>
<?php
	}
	}
	else
	{
		echo "No hay ning�n \'YoSoy\'";
	}
?>
</div>

<script type="text/javascript">
    
        TagHelper.setTexts({
            buttonText: "OK",
            tagLimitText: "�Has alcanzado el l�mite de \'YoSoys\'! Elimina uno antes si quieres a�adir otro nuevo."
        });
    
</script>
