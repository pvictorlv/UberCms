<?php 
$query = Db::query("SELECT * FROM users WHERE id = '".USER_ID."'");

$saldo = 0;
while ($data = $query->fetch(PDO::FETCH_ASSOC)){

$saldo = $data['credits'];
}

?>
<div class="habblet-container ">		
<div class="cbb clearfix green "> 
<h2 class="title">Editar un BOT</h2>
<div class="box-content">
<table width="250" border="0"  cellpadding="0" cellspacing="1" align="left">

<tr>           <td><b>BOT</b></td>
<td><b>Editar</b></td>
            <td><b>Nombre</b></td>
            <td><b>Sala</b></td>
            <td><b>Efecto</b></td>
        </tr>
		<form method="post" action="/bots?editar">
<?php 

$query2 = Db::query("SELECT * FROM bots_effects WHERE user_id ='".USER_ID."'");
while ($data2 = $query2->fetch(PDO::FETCH_ASSOC))
$effect_name=$data2['nombre'];

$query = Db::query("SELECT * FROM bots WHERE owner ='".USER_ID."'");
while ($data = $query->fetch(PDO::FETCH_ASSOC))


{ ?>


       <tr>
            <td><img src="http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $data['look'] ?>&amp;direction=2&amp;head_direction=2&amp;size=s"></td>
            <td><input type="radio" name="select-bot" value="<?php echo $data['id'] ?>" onchange="this.form.submit()">
<input name="habbo" type="hidden" id="habbo" value="%habboName%" /></td>
			<td><?php echo $data['name'] ?></td>
            <td><?php $room=$data['room_id'];$room_info = @Db::query("SELECT * FROM rooms WHERE id='$room'");if($row = $room_info->fetch(PDO::FETCH_ASSOC)){$sala = $row['caption'];}?><?php echo $sala; ?></td>
            <td><?php $effect=$data['effect'];if ($effect == 0){$efecto= 'Ninguno'; }if ($effect >= 1){$efecto= $effect_name; }?> <?php echo $efecto; ?></td>
        </tr><br>
<?php } ?></form>
    
</table>

</div></div></div>


<div class="habblet-container ">		
<div class="cbb clearfix green "> 
<h2 class="title">Tus Efectos Para BOT</h2>
<div class="box-content">
Recuerda Que solo se Pueden usar en BOT`S.
<table width="250" border="0" cellpadding="0" cellspacing="1" align="left">

<tr>         
            <td><b>Nombre</b></td>
            <td><b>ID</b></td>
        </tr>
<?php $query = Db::query("SELECT * FROM bots_effects WHERE user_id ='".USER_ID."'");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){ ?>
<tr>
            <td><img src="<?php echo $data['imagen'] ?>"></td> 
            <td><?php echo $data['nombre'] ?></td>
            <td><?php echo $data['effect'] ?></td>
        </tr>

<?php } ?></table>

</div></div></div>



<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>