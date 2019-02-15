<?php
require_once('../../global.php');

if(!LOG_IN)
{
	header("Location: " . SITE);
	exit;
}

$accountId = FilterText($_POST['accountId']);
$tagId = fixText(FilterText($_POST['tagId']));

if($Users->userExist($accountId) && !empty($tagId) && is_numeric($tagId))
{
	if($Users->alreadyTag($accountId, $tagId))
	{
		$Users->removeTag($accountId, $tagId);
	}
}

$getTags = query("SELECT * FROM users_tags WHERE userID = '" . $myid . "'");
$myTags = mysql_num_rows($getTags);
?>
<div id="profile-tags-container">
	<?php
	if($myTags > 0) {
	while($row = mysql_fetch_assoc($getTags)) {
	?>
    <span class="tag-search-rowholder">
        <a href="<?php echo SITE; ?>/tag/<?php echo $row['tag']; ?>" class="tag"
        ><?php echo $row['tag']; ?></a><div class="tag-id" style="display:none"><?php echo $row['id']; ?></div><img border="0" class="tag-delete-link" onMouseOver="this.src='<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'" onMouseOut="this.src='<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif'" src="<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif"
        />
    </span>
	<?php } } else { ?>
	No hay ning�n 'YoSoy'
	<?php } ?>
    <img id="tag-img-added" border="0" class="tag-none-link" src="<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_added.gif" style="display:none"/>    
</div>

<script type="text/javascript">
    
        TagHelper.setTexts({
            buttonText: "OK",
            tagLimitText: "�Has alcanzado el l�mite de \'YoSoys\'! Elimina uno antes si quieres a�adir otro nuevo."
        });
    
</script>
