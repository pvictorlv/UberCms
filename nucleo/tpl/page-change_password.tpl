<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Cambiar Contraseña</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Listo! Contraseña Actualizada!<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		Error! Te falta rellenar algunos espacios en blanco.<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

Cambiar la contraseña te puede servir de mucho, como cuando se la dijiste a alguien y no tienes confianza, cambiarla...

<br><br>

<form method="post" action="">
<table>
<tr>
<td>Contraseña Actual <?php if ($error == 1) { ?> <span style="color:red; font-size:10px;">* La contraseña actual no es valida.</span> <?php } ?></td>
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
<td>Nueva Contraseña <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* Contraseña Invalida</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="npassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Escribe tu nueva contraseña con <?php echo $min; ?>-<?php echo $max; ?> digitos.</span><br><br></td>
</tr>

<tr>
<td>Reescribe la nueva contraseña <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* Contraseña Invalida</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="rnpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Reescribe tu nueva contraseña para saber si no eres un BOT.</span><br><br></td>
</tr>

<tr>
<td><input type="submit" name="submit"></td>
</tr>
</table>
</form>
            	
</div> 

</div> 
</div> 