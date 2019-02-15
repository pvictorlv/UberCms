<?php
####################################################
## InfoCMS - Emulación del sitio de Habbo Hotel.  ##
####################################################
## Este Software basado en PHP, Curl y HTML es de ##
## libre edición y código libre, cualquier		  ##
## modificación es permitida siempre y cuando	  ##
## respete para lo que fue diseñado.			  ##
####################################################
## Copyright © 2010. Kolesias123 & InfoSmart.	  ##
## http://www.infosmart.com.mx/					  ##
####################################################
## Copyright © 2010. Sulake Corporation Oy.		  ##
## http://www.sulake.com/ ~ http://www.habbo.es/  ##
####################################################

if(!$nowInclude)
{
	require_once('../../Kernel/Init.php');
}

if(!LOG_IN)
{
	header("Location: " . SITE);
	exit;
}

$groupId = FilterText($_POST['groupId']);
$tagMsgCode = CleanText($_POST['tagMsgCode'], true);

$existGroup = query_rows("SELECT null FROM users_groups WHERE id = '" . $groupId . "' LIMIT 1");

if($existGroup > 0) {

$getTags = query("SELECT * FROM users_groups_tags WHERE groupID = '" . $groupId . "'");
?>
<div id="profile-tags-container">
	<?php
	while($row = mysql_fetch_assoc($getTags)) { 
	?>
    <span class="tag-search-rowholder">
        <a href="<?php echo SITE; ?>/tag/<?php echo $row['tag']; ?>" class="tag"
        ><?php echo $row['tag']; ?></a><div class="tag-id" style="display:none"><?php echo $row['id']; ?></div><img border="0" class="tag-delete-link" onMouseOver="this.src='<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'" onMouseOut="this.src='<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif'" src="<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif"
        />
    </span>
	<?php } ?>
    <img id="tag-img-added" border="0" class="tag-none-link" src="<?php echo SITE; ?>/web-gallery/images/buttons/tags/tag_button_added.gif" style="display:none"/>    
</div>

<script type="text/javascript">
    
        TagHelper.setTexts({
            buttonText: "OK",
            tagLimitText: "¡Has alcanzado el límite de \'YoSoys\'! Elimina uno antes si quieres añadir otro nuevo."
        });
    
</script>
<?php } exit; ?>