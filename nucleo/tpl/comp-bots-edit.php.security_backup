<?php
$error = "";
$precio = "3";

$query = mysql_query("SELECT * FROM users WHERE id = '".USER_ID."'");

$saldo = 0;
while ($data = mysql_fetch_array($query)){

$saldo = $data['credits'];
}


$bot = "";
$error = "";
if(isset($_POST['select-bot']))
{

$bot = $_POST['select-bot'];
		
	
}

$bot_info = @mysql_query("SELECT * FROM bots WHERE id='$bot'");
if($row = mysql_fetch_assoc($bot_info))

?>

<div class="cbb clearfix blue ">
<h2 class="title"><span style="float: left;">Editar BOTS</span> <span style="float: right; font-weight: normal; font-size: 75%;">:D</span></h2>
<script type="text/javascript">
function c(op){
var d = document.getElementById("add");
if (op == "select-bot"){
d.innerHTML = '<textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>';
}
}
</script> 
<div style="text-shadow: #808080 1px 1px 0px;padding-top:5px;padding-left:5px;color:#000;font-weight:bold;font-size:11px;float:center;">
<?php echo $error; ?>
<?php $query = mysql_query("SELECT * FROM bots WHERE id ='$bot'");
while ($data = mysql_fetch_array($query)){
$bot_nombre =$data['name'];
}
 ?>
<b>BOTS:</b><?php
if (isset($_POST['select-bot'])) {

echo "<font color='#009900'>Estas editando al BOT $bot_nombre</font>";
}

 else {
?>
<img src="/images/bot.png" align="right" hspace="2" />
Hola, Aqui Podras Editar Tus BOTS, colocarles Efectos Editar Su Ropa Su Sala, Crearles Respuestas para Cuando un Usuario diga alguna Palabra, O Frases Para que las Diga Al Azar Sin Nesesidad de que un usuario Hable.<br><br>Recuerda Que Esto a Sido Creado por Zakite0 y es el Primer Hotel en Tenerlo, si algun Otro Hotel lo Llega a Tener Se Considera Como Copia de Habbo.PS<br><br>NOTAS:<br><br>* Puedes Tener un Maximo de 20 BOTS<br><br>* Maximo 20 Respuestas por BOT<br><br>* Maximo 20 Frases por BOT<br><br>* Cada BOT tiene un Costo de 3 Vip Coins<br><br>* Puedes Comprar los Efectos que Desees<br><br>* Pero Claro Solo sele Puede Colocar Uno ala Vez<br><br>* Cada Efecto Tiene un Costo de 1 PeSo<br><br>* Al Comprar un Efecto Puedes Usarlo en cuantos BOTS Desees<br><br><font color='#FF1000'>* Un Look que Aparece Al editar tu BOT es el que tu Tienes Puesto</font><br> Asi que Podras Colocarle la Ropa Que desees con tan solo Colocartela Tu.<br><br>* Al comprar un BOT No Podras Eliminarlo Pero Sus Frases y Respuestas Si.

<?php } ?>


<?php 
$bot_room = $row['room_id'];
$query = mysql_query("SELECT * FROM rooms WHERE id ='$bot_room'");
while ($rooms2 = mysql_fetch_array($query)){
$room_name = $rooms2['caption'];
} ?>
<?php
if (isset($_POST['select-bot'])) {
?>

<form method="post">
<b>Nombre:</b><input name="nombre" type="text" id="habbo" value="<?php echo $row['name'] ?>" /> Esribe un Nombre Para el BOT<br>
<b>Mision:</b><input name="mision" type="text" id="habbo" value="<?php echo $row['motto'] ?>" /> Esribe una Mision Para el BOT<br>
<b>Sala:</b><select name="sala">
<option value="<?php echo $row['room_id'] ?>"><?php echo $room_name; ?> (Actual)</option>
<?php $query = mysql_query("SELECT * FROM rooms WHERE owner ='".USER_NAME."'");
while ($data = mysql_fetch_array($query)){ ?>
<option value="<?php echo $data['id'] ?>"><?php echo $data['caption'] ?></option>
<?php } ?>
</select>Sala Para el BOT<br>
Modo Caminar:<select name="estado">
<option value="<?php echo $row['walk_mode'] ?>">(Actual)</option>
<option value="stand">Quieto</option>
<option value="freeroam">Caminar Libremente</option></select>Se Puede Mover de Sitio?<br>
<hr>
Selecciona un Look Para tu BOT
<?php
$query = mysql_query("SELECT * FROM users WHERE id = '".USER_ID."'") or die(mysql_error()); 
while ($data2 = mysql_fetch_array($query)){
$look=$data2['look'];
$id = $data2['id']; }
?><br>
<input type="radio" name="look" value="<?php echo $row[look] ?>" checked><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $row[look] ?>&amp;direction=2&amp;head_direction=2&amp;size=s"></img>
<input type="radio" name="look" value="<?php echo $look; ?>"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $look; ?>&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="ch-3049-1336.hd-600-8.lg-3088-1341-1340.sh-3180-110-1336.hr-678-37"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=ch-3049-1336.hd-600-8.lg-3088-1341-1340.sh-3180-110-1336.hr-678-37&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="hr-828-45.lg-285-64.ch-215-110.hd-180-2.sh-290-62.he-1607-"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-45.lg-285-64.ch-215-110.hd-180-2.sh-290-62.he-1607-&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="hd-180-7.sh-290-110.lg-270-91.ch-809-62.hr-828-45"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hd-180-7.sh-290-110.lg-270-91.ch-809-62.hr-828-45&amp;direction=2&amp;head_direction=2&amp;size=s"></img>Seleccion un Look.<br>
<hr>
<center> Rotacion y Posicion </center>
<input type="radio" name="rotacion" value="<?php echo $row[rotation] ?>" checked><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=<?php echo $row[rotation] ?>&head_direction=<?php echo $row[rotation] ?>&size=s"></img> |
<input type="radio" name="rotacion" value="0"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=0&head_direction=0&size=s"></img> |
<input type="radio" name="rotacion" value="1"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=1&head_direction=1&size=s"></img> |
<input type="radio" name="rotacion" value="2"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=2&head_direction=2&size=s"></img> |
<input type="radio" name="rotacion" value="3"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=3&head_direction=3&size=s"></img> |
<input type="radio" name="rotacion" value="4"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=4&head_direction=4&size=s"></img> |
<input type="radio" name="rotacion" value="5"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=5&head_direction=5&size=s"></img> |
<input type="radio" name="rotacion" value="6"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=6&head_direction=6&size=s"></img> |
<input type="radio" name="rotacion" value="7"><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=7&head_direction=7&size=s"></img> |<br><br>
<hr>
Posicion X<input name="posicionx" type="text" id="habbo" value="<?php echo $row['x'] ?>" size="2" onkeypress="return onlyNumbersDano(event)" />
Posicion Y<input name="posiciony" type="text" id="habbo" value="<?php echo $row['y'] ?>" size="2" onkeypress="return onlyNumbersDano(event)" /><br>Para saber La Pocision X y Y Ve a tu sala Hazte Donde Quieres Colocar el BOT y escribe<br> :Coords y Te saldran los Datos Que nesesitas Para Llenar Esto.<br>
<hr>

<b><center>EFECTO DEL BOT</CENTER></B>

<select name="efecto">
<option value="<?php echo $row['effect'] ?>"><?php $effect=$row['effect'];if ($effect == 0){$efecto_nombre= 'Ninguno'; }if ($effect >= 1){$efecto_nombre= $row[effect]; } ?><?php echo $efecto_nombre; ?> (Actual)</option>
<?php $query = mysql_query("SELECT * FROM bots_effects WHERE user_id ='".USER_ID."'");

while ($data11 = mysql_fetch_array($query)){ ?>
<option value="<?php echo $data11['effect'] ?>"><?php echo $data11['nombre'] ?></option>
<?php } ?>
<option value="0">Sin Efecto</option>
</select>
<br>

¿Haz Terminado? Click al siguiente Boton, Asegurate De que Todos los Campos esten Correctos.<br><br>
<input name="habbo" type="hidden" id="habbo" value="%habboName%" />
<input name="editarbot" type="hidden" id="habbo" value="<?php echo $bot; ?>" />

<?php
$me = mysql_real_escape_string(USER_NAME);
$query = mysql_query("SELECT * FROM users WHERE username = '".$me."'");
while ($data = mysql_fetch_array($query)){
$rango = $data['rank'];
$vip = $data['vip'];
}
if ($rango >= 2){ ?>
                    <center><input type="submit" value="Actualizar BOT" name="edit-bot" /></center><?php } ?>
					<?php
$me = mysql_real_escape_string(USER_NAME);
$query = mysql_query("SELECT * FROM users WHERE username = '".$me."'");
while ($data = mysql_fetch_array($query)){
$rango = $data['rank'];
$vip = $data['vip'];
}
if ($rango == 1){ ?><center>
<input name="button2" type="button" 
onclick='alert("Debes ser Premium Para poder Comprar o Editar BOTS.")' value="Actualizar BOT" /></center>
<?php } ?>

<?php } ?>
</form>




<?php

		
if(isset($_POST['edit-bot']))
{
	$user_info = @mysql_query("SELECT * FROM users WHERE username='". clean($_POST["habbo"]) ."'");
	if($row = mysql_fetch_assoc($user_info))
	{
		$id = $row['id'];
		$owner = $row['id'];
		$pixeles = $row['activity_points'];
		$creditos2 = $row['credits'];
		$tranferencia = 'Creditos y Pixeles';
		$nombre = $_POST['nombre'];
$mision = $_POST['mision'];
$ropa = $_POST['look'];
$posicionx = $_POST['posicionx'];
$posiciony = $_POST['posiciony'];
$sala = $_POST['sala'];
$estado = $_POST['estado'];
$rotacion = $_POST['rotacion'];
$effect = $_POST['efecto'];
$editarbot = $_POST['editarbot'];


		
		$check_bot = mysql_query("SELECT * FROM bots WHERE owner='". $id ."'");
		$check_user = mysql_query("SELECT * FROM users WHERE id='". $id ."'");
		$check_stats = mysql_query("SELECT * FROM user_stats WHERE id='". $id ."'");

		
		if(mysql_num_rows($check_bot) > 20)
		{
			$error.= "¡Por Ahora Solo se Permite 20 BOT por Usuario!<br /><br />";
		}
		else
		{
			if($mostrar = mysql_fetch_assoc($check_stats))
			{
				$respetos = $mostrar['Respect'];
				if($saldo >= 0)

				{
					
					mysql_query("UPDATE bots SET room_id = '$sala', name= '$nombre', motto = '$mision', look = '$ropa', x ='$posicionx', y ='$posiciony', rotation = '$rotacion', walk_mode = '$estado', effect = '$effect', owner = '$owner' WHERE id = '$editarbot'");
					$error.= "<font color='#009900'>Bot Actualizado<br> PARA ACTUALIZAR EL BOT DEBES ESCRIBIR :update_bots  Y LUEGO :unload PARA RECARGAR LA SALA.<br /></font>";
				}
				else
				{
					$error.= "<font color='#FF0000'>No tienes suficientes PeSos para realizar la compra!!<br /><br /></font>";
				}
			}
		}
	}
}

?>





</div>
</div>
<?php
$query = mysql_query("SELECT * FROM users WHERE id = '".USER_ID."'");

$saldo = 0;
while ($data = mysql_fetch_array($query)){

$saldo = $data['credits'];
}

if (isset($_POST['rare'])){

$bot_res = $_POST['bot_res'];
$rare = $_POST['rare'];
$contesta = $_POST['contesta'];



$query = mysql_query("SELECT * FROM bots_responses WHERE bot_id = '$bot_res'");
if (mysql_num_rows($query) < 30){
$data = mysql_fetch_array($query);

$response_id = $_POST['response_id'];
$eliminar = $_POST['eliminar'];
$modo = $_POST['modo'];

if (empty($rare)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}

else 

if (empty($contesta)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}


else {

mysql_query("UPDATE bots_responses SET keywords = '$rare', response_text = '$contesta', mode = '$modo' WHERE id = '$response_id'");

if ($eliminar == 1){
mysql_query("DELETE FROM bots_responses WHERE id = '$response_id'");
 }
header("Location: /bots/editar");
}

}else{
header ("Location: /bots/editar?error=monto");
die;
}
}


?>

<?php 
if (isset($_GET['exito'])){ ?>
<script>
alert('BOT Actualizado, Recuerda Escribir en el Hotel :update_bots y luego :unload en la sala Del BOT.');
</script>
<?php } ?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'monto'){ ?>
<script>
alert('UPPS¡¡ a Habido Un Error Lo Sentimos. ');
</script>
<?php } ?>


<?php
$total = mysql_query("SELECT * FROM bots_responses WHERE bot_id = '$bot'");
$total = mysql_num_rows($total);
?>
<?php

$error = "";

if(isset($_POST['agregar']))
{

$bot_res = $_POST['bot_res'];
$dice = $_POST['dice'];
$contesta = $_POST['contesta'];
$modo = $_POST['modo'];


	$user_info = @mysql_query("SELECT * FROM users WHERE id='".$_POST["habbo"]."'");
	if($rew = mysql_fetch_assoc($user_info))
	
		$name = $rew['username'];


if (empty($dice)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}

else 

if (empty($contesta)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}


else {
		
		$check_bot = mysql_query("SELECT * FROM bots_responses WHERE bot_id='$bot_res'");
				if(mysql_num_rows($check_bot) > 20)
		{
			$error.= "¡Solo se Permite 20 Respuestas por BOT!<br /><br />";
		}
		else {
		
		

mysql_query("INSERT INTO bots_responses (bot_id, keywords, response_text, mode) VALUES ('$bot_res', '$dice', '$contesta', '$modo')");



}
}
}
?>
<?php
if (isset($_POST['select-bot'])) {
?>
<div class="cbb clearfix red ">
<h2 class="title"><span style="float: left;">Respuestas BOT</span> <span style="float: right; font-weight: normal; font-size: 75%;">(<?php echo $total ?> Respuestas)</span></h2>
<div style="height:600px;overflow:auto;width:99.5%;">
<center><b style="font-size:15px; color:#000000;">Agregar Respuestas</b></center><br />
<div class="box-content">
<form method="post">
<b>Cuando un Usuario dice:<input name="dice" type="text" value="Hola;Buenas;ola"/><br></b>Puedes Separar las Palabras por <b>Punto y Coma</b>.<br><br>
<b>El BOT Respondera:<input name="contesta" type="text"   value="Hola, ¿Como Estas? ¡Bienvenido a la Sala!" size="40"/><br>
<input type="hidden" name="bot_res" value="<?php echo $bot; ?>">
<select name="modo">
<option value="say">Decir</option>
<option value="shout">Gritar</option>
<option value="whisper">Susurrar</option>
</select>
                    <input type="submit" value="Agregar" name="agregar"  class="new-button fill" />
 </form></div>

<hr><br><center><b style="font-size:15px; color:#000000;">Editar Respuestas</b></center><br /><br />
<?php
$color = '#FFFFFF';
 $query=mysql_query("SELECT * FROM bots_responses WHERE bot_id = '$bot' ORDER BY ID DESC");
$cuantos2 =$data['valor'];

while ($data=mysql_fetch_array($query)){ 

if ($color == '#FFFFFF'){
	
	$color = '#CAFF70';
	}else{
	$color = '#FFFFFF';	
	}?>

<div style="width:100%;height:150px;padding-top:10px;background-color:<?php echo $color ?>;">
<div class="box-content">
<table cellspacing="0" cellpadding="0" style="width:100%;">

<form method="post" action="">
<tr>

Cuando un Usuario Diga:<input type="text" name="rare" size="30" value="<?php echo $data['keywords'] ?>"><br>
El BOT contestara:<input type="text" name="contesta" size="37" value="<?php echo $data['response_text'] ?>"><br>
En Modo:<select name="modo">
<option value="say">Decir</option>
<option value="shout">Gritar</option>
<option value="whisper">Susurrar</option>
</select><br><br>Eliminar: <input type="radio" name="eliminar" value="0" checked>No | <input type="radio" name="eliminar" value="1" onchange="this.form.submit()">Si, Eliminar.<br></td>
<td><div style="margin-top:15px;margin-right:20px;" align="right" class="redeem-redeeming-button"><input type="hidden" name="response_id" value="<?php echo $data['id'] ?>"><input type="hidden" name="bot_res" value="<?php echo $bot; ?>">

<input type="submit" value="Actualizar" class="new-button fill">

</form></div>
</td>
</tr>
</table>
</div></div>
<?php } ?>

</div>
</div><?php } ?>







