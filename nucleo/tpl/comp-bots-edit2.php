

<?php

if(isset($_POST['select-bot']))
{

$bot = $_POST['select-bot'];
		
	
}

$total = @Db::query("SELECT * FROM bots_speech WHERE bot_id = '$bot'");
$total = $total->rowCount();
?>

<?php
$query = Db::query("SELECT * FROM users WHERE id = '".USER_ID."'");

$saldo = 0;
while ($data = $query->fetch(PDO::FETCH_ASSOC)){

$saldo = $data['credits'];
}

if (isset($_POST['dice'])){

$bot_res = $_POST['bot_res'];
$dice = $_POST['dice'];
$modo = $_POST['modo'];



$query = Db::query("SELECT * FROM bots_speech WHERE bot_id = '$bot_res'");
if ($query->rowCount() < 30){
$data = $query->fetch(PDO::FETCH_ASSOC);

$response_id = $_POST['response_id'];
$eliminar = $_POST['eliminar'];
$modo = $_POST['modo'];

if (empty($dice)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}

else {

Db::query("UPDATE bots_speech SET text = '$dice', shout = '$modo' WHERE id = '$response_id'");

if ($eliminar == 1){
Db::query("DELETE FROM bots_speech WHERE id = '$response_id'");
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

$error = "";

if(isset($_POST['agregarfrase']))
{

$bot_res = $_POST['bot_res'];
$dice = $_POST['dice'];
$modo = $_POST['modo'];


	$user_info = @Db::query("SELECT * FROM users WHERE id='".$_POST["habbo"]."'");
	if($rew = $user_info->fetch(PDO::FETCH_ASSOC))
	
		$name = $rew['username'];

		if (empty($dice)) {
echo "<b><font color='#009900'>Lo Sentimos, No pueden Haber Campos Vacios.</font><b>";
}

else {
		
		$check_bot = Db::query("SELECT * FROM bots_speech WHERE bot_id='$bot_res'");
				if($check_bot->rowCount() > 20)
		{
			$error.= "¡Solo se Permite 20 Frases por BOT!<br /><br />";
		}
		else {
		
		

Db::query("INSERT INTO bots_speech (bot_id, text, shout) VALUES ('$bot_res', '$dice', '$modo')");



}
}
}
?>
<?php
if (isset($_POST['select-bot'])) {
?>
<div class="cbb clearfix red ">
<h2 class="title"><span style="float: left;">Frases al Azar</span> <span style="float: right; font-weight: normal; font-size: 75%;">(<?php echo $total ?> Frases)</span></h2>
<div style="height:600px;overflow:auto;width:99.5%;">
<center><b style="font-size:15px; color:#000000;">Agregar Frases</b></center><br />
<div class="box-content">
<form method="post">
<b>Frase que dira El BOT:<input name="dice" type="text" value="Bienvenidos a mi Sala" size="35"/></b><br>
<input type="hidden" name="bot_res" value="<?php echo $bot; ?>">
<select name="modo">
<option value="0">Decir</option>
<option value="1">Gritar</option>
</select>
                    <input type="submit" value="Agregar" name="agregarfrase"  class="new-button fill" />
 </form></div>

<hr><br><center><b style="font-size:15px; color:#000000;">Editar Frases</b></center><br /><br />
<?php
$color = '#FFFFFF';
 $query=Db::query("SELECT * FROM bots_speech WHERE bot_id = '$bot' ORDER BY ID DESC");
$cuantos2 =$data['valor'];

while ($data=$query->fetch(PDO::FETCH_ASSOC)){ 

if ($color == '#FFFFFF'){
	
	$color = '#FFE4C4';
	}else{
	$color = '#FFFFFF';	
	}?>

<div style="width:100%;height:150px;padding-top:10px;background-color:<?php echo $color ?>;">
<div class="box-content">
<table cellspacing="0" cellpadding="0" style="width:100%;">

<form method="post" action="">
<tr>

Frase que el BOT dira:<input type="text" name="dice" size="37" value="<?php echo $data['text'] ?>"><br>
En Modo:<select name="modo">
<option value="0">Decir</option>
<option value="1">Gritar</option>
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