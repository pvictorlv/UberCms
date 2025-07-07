<?php
$query = Db::query("SELECT * FROM user_historial WHERE user_id = '".USER_ID."'");

$saldo = 0;
while ($data = $query->fetch(PDO::FETCH_ASSOC)){

if ($data['tipo'] == 'sumar'){

$saldo += $data['valor'];
}elseif($data['tipo'] == 'restar'){

$saldo -= $data['valor'];
}
}

if (isset($_POST['rare'])){

$rare = htmlspecialchars(htmlentities($_POST['rare']));

if (is_numeric($rare)){

$me = htmlspecialchars(USER_NAME);
$query = Db::query("SELECT * FROM users WHERE username = '".$me."'");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
$vip = $data['vip'];
}
$query = Db::query("SELECT * FROM site_tienda WHERE tipo = 'rare' AND valor = '$rare'");

if ($query->rowCount() > 0){

$data = $query->fetch(PDO::FETCH_ASSOC);
$id = USER_ID;
$tranferencia = 'Efecto BOT Comprado';
$valor_rare = $data['precio'];
$imagen = $data['imagen'];
$nombre = $data['nombre'];
$id_item = $data['valor'];

if ($valor_rare <= $saldo) {

Db::query("INSERT INTO user_historial (user_id, tipo, texto, valor, fecha) VALUES ('$id', 'restar', '$tranferencia', '$valor_rare', '".time()."')");


$query55 = Db::query("SELECT comprados FROM site_tienda WHERE tipo='rare' AND valor ='$rare'") 
$dataj = $query55->fetch(PDO::FETCH_ASSOC); 

$id2 = $dataj['comprados'];
$cantidad = "1";

$autoid = $id2 + $cantidad;


Db::query("UPDATE site_tienda SET comprados = '$autoid' WHERE valor = '$rare' AND tipo = 'rare'");
Db::query("INSERT INTO `bots_effects`(`user_id`, `effect`, `nombre`, `imagen`) values ('".$id."', '$rare','$nombre','$imagen')")

header("Location: /bots/efectos?exito");

}else{
header ("Location: /bots/efectos?error=monto");
die;
}
}else{
header ("Location: /bots/efectos?error=db");
die;	
	}
}
}

?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'db'){ ?>
<script>
alert('El articulo que estas intentando comprar, no se ha encontrado');
</script>
<?php }
if (isset($_GET['exito'])){ ?>
<script>
alert('Compra efectiva, Gracias por tu Compra.');
</script>
<?php } ?>
<?php
if (isset($_GET['error']) && $_GET['error'] == 'monto'){ ?>
<script>
alert('No eres Premium o El articulo que estas intentando comprar, sobrepasa tu saldo actual. ');
</script>
<?php } ?>


<?php
$total = Db::query("SELECT * FROM site_tienda WHERE tipo ='rare' AND otro ='bot_effect'");
$total = $total->rowCount();
?>
<div class="cbb clearfix red ">
<h2 class="title"><span style="float: left;">Efectos Para BOTS</span> <span style="float: right; font-weight: normal; font-size: 75%;">(<?php echo $total ?> disponibles)</span></h2>
<div style="height:400px;overflow:auto;width:99.5%;">


<?php
$color = '#FFFFFF';
 $query=Db::query("SELECT * FROM site_tienda WHERE tipo ='rare' AND otro ='bot_effect' ORDER BY ID DESC");
$cuantos2 =$data['valor'];

while ($data=$query->fetch(PDO::FETCH_ASSOC)){ 

if ($color == '#FFFFFF'){
	
	$color = '#C2FFD5';
	}else{
	$color = '#FFFFFF';	
	}?>

<div style="width:100%;height:100px;padding-top:10px;background-color:<?php echo $color ?>;">
<table cellspacing="0" cellpadding="0" style="width:100%;">
<tr>
<td style="padding-left:20px;"><img src="<?php echo $data['imagen'] ?>"></td>
<td><b style="font-size:15px; color:#0EA800;"><?php echo $data['nombre'] ?></b><br><b style="font-size:15px;"><?php echo $data['precio'] ?> PeSos </b></td>
<td><div style="margin-top:15px;margin-right:20px;" align="right" class="redeem-redeeming-button"><form method="post" action=""><input type="hidden" name="rare" value="<?php echo $data['valor'] ?>">

<input type="submit" value="Comprar Ahora" class="new-button fill">

</form></div>
</td>
</tr>
</table>
</div>
<?php } ?>
</div>
</div>