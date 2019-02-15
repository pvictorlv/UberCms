<?php

$getUser = dbquery("SELECT id,username,online,account_created,look,motto FROM users WHERE id = '" . $user_id . "' LIMIT 1");

if (mysql_num_rows($getUser) < 0)
{
	exit;
}

$userData = mysql_fetch_assoc($getUser);


$status = 'offline';
if ($userData['online'] == "1") { $status = 'online'; }

?>
<div class="movable widget ProfileWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;"> 
<div class="%skin%"> 
	<div class="widget-corner" id="widget-%id%-handle"> 
		<div class="widget-headline"><h3>
<?php				if(isset($_SESSION['startSessionEditHome'])) { if($_SESSION['startSessionEditHome'] == $user_id) { 

echo '<img src="'.WWW.'/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit">
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
} } ?>
		<span class="header-left">&nbsp;</span><span class="header-middle">Elemento en mantenimiento</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div> 
	<div class="widget-body"> 
		<div class="widget-content"> 
		<center>¡Estamos trabajando en este elemento en estos instantes! </center>
		</div> 
	</div> 
</div> 
</div> 