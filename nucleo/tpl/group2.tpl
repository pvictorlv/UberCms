<?php

$name = fixText(($_POST['name']));
$description = substr(fixText(($_POST['description'])), 0, 255);

if(empty($name))
{
	$msg = "[El nombre del Grupo no está definido.]";
	require('group_create_form.php');
	exit;
}

?>
<input type="hidden" name="struts.token.name" value="struts.token" />
<input type="hidden" name="struts.token" value="<?php echo $token; ?>" /><div id="group-logo">
   <img src="<?php echo webgallery; ?>/images/groups/group_icon.gif" alt="" width="46" height="46" />
</div>

<p>
Nombre del Grupo: <b><?php echo $name; ?></b><br>Precio: <b><?php echo $cms_row2["groups_buy_cost"]; ?> Créditos</b>.<br> Tienes: <b><?php echo $myrow['credits']; ?> Créditos</b>
</p>

<div id="group-confirmation-button-area">	
<div class="new-buttons clearfix">
	<a class="new-button" href="#" onclick="GroupPurchase.close(); return false;"><b>Cancelar</b><i></i></a>	
	<a class="new-button" href="#" onclick="GroupPurchase.purchase(); return false;"><b>Comprar este Grupo</b><i></i></a>
</div>
</div>