<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Bloquea peticiones de amigos</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		¡Listo! Ajustes actualizados!<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		¡Error! Revisa bien tus datos!<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

Aquí podrás cambiar la configuración de las peticiones de tus amigos, podrás impedir que te envie peticiones al igual que volver a activarlas, por motivos de seguridad deberás saber la contraseña actual, para verificar que eres el dueño de esta cuenta.

<br>
<br>

<form method="post" action="">
<table>
<tr>
<td>Contraseña actual <?php if ($error == 1) { ?> <span style="color:red; font-size:10px;">* La contraseña no coincide o es inválida.</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="cpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Ingrese la contraseña actual, por motivos de seguridad.</span><br><br></td>
</tr>
<tr>
<td></td>
</tr>

<tr>
<td> </td>
</tr>
<tr>
<td>Petición de amigos</td>
</tr>

<tr>
<td><select name="block">
  	<option value="1">Bloquear</option>
  	<option value="0">Desbloquear</option>
 	</select></td>
</tr>

<tr>
<td><span style="color:#c0bdbd;">Porfavor selecciona la opción que deseas.</span><br><br></td>
</tr>

<tr>
<td>Confirmar</td>
</tr>
   
<tr>
<td><select name="rblock">
  	<option value="1">Bloquear</option>
  	<option value="0">Desbloquear</option>
  	</select></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Porfavor confirma tu acción.</span><br><br></td>
</tr>



<tr>
<td><i></i></td>
</tr>
</table>
<p align="right"><a href="#" id="settings-submit" class="new-button green-button enabled-button"><b>Salvar cambios</b><i></i></a></p>
</form>

<br />

            	
</div> 

</div> 
</div> 