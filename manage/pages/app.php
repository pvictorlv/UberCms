<?php
$pagename= "Peticiones de Rango";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}



require_once "top.php";

?>			

<h2 class="title"><?php echo $pagename; ?></h2>
            <div class="box-content">


<?php if(isset($msg)){ ?><p><strong><?php echo $msg; ?></strong></p><?php } ?>

<form action='index?p=application_manage&do=save' method='post' name='theAdminForm' id='theAdminForm'>
 <div class='tableborder'> 
 <div class='tableheaderalt'>Usuarios que enviaron solicitudes para rango. </div>
 <table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='1%' align='center'>ID</td>
  <td class='tablesubheader' width='28%'>Usuario</td>
  <td class='tablesubheader' width='10%' align='center'>Estado</td>
  <td class='tablesubheader' width='10%' align='center'>IP</td>
  <td class='tablesubheader' width='10%' align='center'>Ver</td>
 </tr>
<?php
$get_rares = Db::query("SELECT id,username,appstatus,age,country,timezone,realname,modname,time,experience,message1,message2,message3,users,visitoripaddy FROM applications ORDER BY appstatus DESC")
while($row = $get_rares->fetch(PDO::FETCH_ASSOC)){

if($row['appstatus'] == 1) { $vs="Leida"; }
else if($row['appstatus'] == 0) { $vs="Sin leer"; }
$info = $vs.".";

	printf(" <tr>
  <td class='tablerow1' align='center'>%s</td>
  <td class='tablerow2'><strong>%s</strong><div class='desctext'>%s</div></td>
  <td class='tablerow2' align='center'>%s</td>
  <td class='tablerow2' align='center'>%s</td>
  <td class='tablerow2' align='center'><a href='index.php?_cmd=app_edit&key=%s'>Ver</a></td>
</tr>", $row['id'], htmlspecialchars(stripslashes($row['username'])), htmlspecialchars($info), $vs, "<b>".$row['visitoripaddy']."</b>", $row['id'], $row['id']);
}
?>

 </table>


</div>
        </div>
    </div>
</div>
</div>
    </div>

<?php

require_once "botom.php";

?>