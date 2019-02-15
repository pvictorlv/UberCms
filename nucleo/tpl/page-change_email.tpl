<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Cambiar E-Mail</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Listo! Tu Correo ha sido Actualizado!<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		Error! Te falta rellenar algunos espacios en blanco.<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

Cambiar el E-Mail puede servirte para cuando tu cambies de correo, y que en ese mismo te envien las noticias del Hotel.

<br><br>

<form method="post" action="">
<table>
<tr>
<td>Contraseña Actual <?php if ($error == 1) { ?> <span style="color:red; font-size:10px;">* La Contraseña actual es incorrecta.</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="cpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Por seguridad escribe tu contraseña que tienes actualmente.</span><br><br></td>
</tr>
<tr>
<td><br></td>
</tr>

<tr>
<td>Nuevo Email <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* E-Mail Nuevo invalido</span> <?php } ?></td>
</tr>
<tr>
<td><input type="email" name="nemail"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Escribe el correo que remplazaras por el actual.</span><br><br></td>
</tr>

<tr>
<td>Reescribe el Nuevo Correo<?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* E-Mail Nuevo invalido</span> <?php } ?></td>
</tr>
<tr>
<td><input type="email" name="rnemail"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Reescribe tu nuevo correo para saber si no eres un BOT.</span><br><br></td>
</tr>

<tr>
<td>
	<input type="submit" name="submit">
	<div class="settings-buttons">
		<a href="#" class="new-button" style="" id="profileForm-submit"><b>Salvar</b><i></i></a>
		<noscript>&lt;input type="submit" value="Salvar" name="submit" class="submit" /&gt;</noscript>
	</div>

</td>
</tr>
</table>
</form>
            	
</div> 
</tr>
<tr>

</div> 
</div> 