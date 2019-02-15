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
if (isset($_GET['key'])){
$key = filter($_GET['key']);
$check = mysql_query("SELECT * FROM applications WHERE id = '$key' LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);

	
		$rare = mysql_fetch_assoc($check);
		$editor_mode = true;
dbquery("UPDATE applications SET `appstatus` = '1'");
}	


require_once "top.php";

?>	

<h2 class="title"><?php echo $pagename; ?></h2>
            <div class="box-content">

<div class='tableborder'>
<div class='tableheaderalt'>Aplicacion de: <?php echo $rare['username']; ?>.</div>

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Nombre</b><div class='graytext'>Nombre del usuario de la Aplicacion.</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='1username' value="<?php echo $rare['username']; ?>"  size='30' maxlength='0' class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>ID</b><div class='graytext'>ID del Usuario</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='2username' value="<?php echo $rare['userid']; ?>"  size='5' maxlength='0' class='textinput'></td>
</tr>


<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Nombre real</b><div class='graytext'>Nombre real del usuario</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='value' value="<?php echo $rare['realname']; ?>" size='30' maxlength='0 class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>¿Ha sido Staff?</b><div class='graytext'>Si ha sido Staff alguna vez y en qué hoteles</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='releasestate' value="<?php echo $rare['timezone']; ?>" size='30' maxlength='0'class='textinput'></td>
</tr> 

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Tiempo disponible</b><div class='graytext'>Cuanto tiempo puede dedicarle al hotel.</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['time']; ?>" size='30' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Edad</b><div class='graytext'>¿Cuántos Años tiene?</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['age']; ?>" size='1' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Pais</b><div class='graytext'>Nacionalidad del usuario</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['country']; ?>" size='30' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Holograph</b><div class='graytext'>Conocimientos del Holograph</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['experience']; ?>" size='65' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Administración</b><div class='graytext'>Conocimientos en la Administración</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['message1']; ?>" size='65' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Razon de unido</b><div class='graytext'>Por que quieren hacer parte del Equipo administrativo. </div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['message2']; ?>" size='65' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Otros</b><div class='graytext'>Si el aplicante decidio añadir algo más, estará aquí.</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['message3']; ?>" size='65' maxlength='0'class='textinput'></td>
</tr>

<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>IP</b><div class='graytext'>La IP del usuario</div></td>
<td class='tablerow2'  width='60%'  valign='middle'><input type='text' name='category' value="<?php echo $rare['visitoripaddy']; ?>" size='20' maxlength='0'class='textinput'></td>
</tr>



<tr>
<tr><td align='center' class='tablesubheader' colspan='2' ><a href="index.php?_cmd=app">Regresar</a></td></tr></table></div><br />

</div>
        </div>
    </div>
</div>
</div>
    </div>

<?php

require_once "botom.php";

?>