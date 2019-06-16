<?php
$error = "";
$precio = "3";

//global $users;

//$saldo = ;

if (isset($_POST['buy-bot'])) {
    $user_info = db::query("SELECT * FROM users WHERE username=?", $_POST["habbo"]);
    if ($row = $user_info->fetch(2)) {
        $id = $row['id'];
        $pixeles = $row['activity_points'];
        $creditos2 = $row['vip_points'];
        $tranferencia = 'Compra de un BOT';
        $nombre = $_POST['nombre'];
        $mision = $_POST['mision'];
        $ropa = $_POST['look'];
        $posicionx = $_POST['posicionx'];
        $posiciony = $_POST['posiciony'];
        $sala = $_POST['sala'];
        $estado = $_POST['estado'];
        $rotacion = $_POST['rotacion'];


        $check_bot = db::query("SELECT count(id) FROM bots WHERE owner = ?", $id)->fetchColumn();

        if ($check_bot > 20) {
            $error .= "Não pode ter mais de 20 bots!<br /><br />";
        } else {

            if ($saldo >= $precio) {
                $creditos_totales = $saldo - $precio;


                db::query("UPDATE users SET vip_points = vip_points - $precio WHERE id = '$id'");
                db::query('INSERT INTO `bots`(`room_id`, `name`, `motto`, `look`, `x`, `y`, `rotation`, `walk_mode`, `owner`) VALUES (?,?,?,?,?,?,?,?,?)',
                    $sala, $nombre, $mision, $ropa, $posicionx, $posiciony, $rotacion, $estado, $id);


                $error .= "<span style=\"color: #009900; \">Felicidades!! Acabas de recibir  un BOT Ahora Tienes " . $creditos_totales . " Vip Coins<br> PARA VER EL BOT DEBES ESCRIBIR :update_bots  Y LUEGO :unload PARA RECARGAR LA SALA.<br /></span>";
            } else {
                $error .= "<span style=\"color: #FF0000; \">No tienes suficientes Vip Coins para realizar la compra!!<br /><br /></span>";
            }

        }
    }
}

?>
<script type="text/javascript">
    <!--
    /*
     Enable only numbers
     Author: Dano
     Website: www.danonino.org
     Licence: �?
     */
    function onlyNumbersDano(evt) {
        var keyPressed = (evt.which) ? evt.which : event.keyCode
        return !(keyPressed > 31 && (keyPressed < 48 || keyPressed > 57));
    }

    //-->
</script>
<div class="cbb clearfix blue ">
    <h2 class="title"><span style="float: left;">Crear un BOT por <?php echo $precio; ?> Vip Coins</span> <span
                style="float: right; font-weight: normal; font-size: 75%;">O Simplemente Informate Que Son.</span></h2>
    <span style="float: left;"><div
                style="text-shadow: #808080 1px 1px 0px;padding-top:5px;padding-left:5px;color:#000;font-weight:bold;font-size:11px;float:center;">
<?php echo $error; ?>
            <b> Crear un BOT:</b>

<form method="post">
<b>Nombre:</b><input name="nombre" type="text" id="habbo" value="LxCMS"/> Esribe un Nombre Para el BOT<br>
<b>Mision:</b><input name="mision" type="text" id="habbo" value="BOT de %habboName%"/> Esribe una Mision Para el BOT<br>
<b>Sala:</b><select name="sala">
<?php $query = db::query("SELECT * FROM rooms WHERE owner ='" . USER_NAME . "'");

while ($data = mysqli_fetch_array($query)) { ?>
    <option value="<?php echo $data['id'] ?>"><?php echo $data['caption'] ?></option>
<?php } ?>
</select> Selecciona la Sala Donde quieres Colocar un BOT.<br>
Modo Caminar:<select name="estado">
<option value="stand">Quieto</option>
<option value="freeroam">Caminar Libremente</option></select> Selecciona si tu BOT se Puede Mover de Sitio.<br>
<hr>
Selecciona un Look Para tu BOT
    <?php
    $query = db::query("SELECT * FROM users WHERE id = '" . USER_ID . "'") or die(mysqli_error());
    while ($data2 = mysqli_fetch_array($query)) {
        $look = $data2['look'];
        $id = $data2['id'];
    }
    ?><br>
<input type="radio" name="look" value="<?php echo $look; ?>"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=<?php echo $look; ?>&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="ch-3049-1336.hd-600-8.lg-3088-1341-1340.sh-3180-110-1336.hr-678-37"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=ch-3049-1336.hd-600-8.lg-3088-1341-1340.sh-3180-110-1336.hr-678-37&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="hr-828-45.lg-285-64.ch-215-110.hd-180-2.sh-290-62.he-1607-" checked><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-45.lg-285-64.ch-215-110.hd-180-2.sh-290-62.he-1607-&amp;direction=2&amp;head_direction=2&amp;size=s"></img> |
<input type="radio" name="look" value="hd-180-7.sh-290-110.lg-270-91.ch-809-62.hr-828-45"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hd-180-7.sh-290-110.lg-270-91.ch-809-62.hr-828-45&amp;direction=2&amp;head_direction=2&amp;size=s"></img>Recuerda Que El primer Look es el de Tu Habbo.<br>
<hr>
<center> Rotacion y Posicion </center>
<input type="radio" name="rotacion" value="0"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=0&head_direction=0&size=s"></img> |
<input type="radio" name="rotacion" value="1"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=1&head_direction=1&size=s"></img> |
<input type="radio" name="rotacion" value="2"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=2&head_direction=2&size=s"></img> |
<input type="radio" name="rotacion" value="3"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=3&head_direction=3&size=s"></img> |
<input type="radio" name="rotacion" value="4" checked><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=4&head_direction=4&size=s"></img> |
<input type="radio" name="rotacion" value="5"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=5&head_direction=5&size=s"></img> |
<input type="radio" name="rotacion" value="6"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=6&head_direction=6&size=s"></img> |
<input type="radio" name="rotacion" value="7"><img
            src="http://www.habbo.es/habbo-imaging/avatarimage?figure=hr-828-42&direction=7&head_direction=7&size=s"></img> |<br><br>
<hr>
Posicion X<input name="posicionx" type="text" id="habbo" value="4" size="2" onkeypress="return onlyNumbersDano(event)"/>
Posicion Y<input name="posiciony" type="text" id="habbo" value="1" size="2" onkeypress="return onlyNumbersDano(event)"/><br>Para saber La Pocision X y Y Ve a tu sala Hazte Donde Quieres Colocar el BOT y escribe<br> :Coords y Te saldran los Datos Que nesesitas Para Llenar Esto.<br>
<hr>
<br>

�Haz Terminado? Click al siguiente Boton, Asegurate De que Todos los Campos esten Correctos.<br><br>
<input name="habbo" type="hidden" id="habbo" value="%habboName%"/>


    <?php
    $me = mysqli_real_escape_string(USER_NAME);
    $query = db::query("SELECT * FROM users WHERE username = '" . $me . "'");
    while ($data = mysqli_fetch_array($query)) {
        $rango = $data['rank'];
        $vip = $data['vip'];
    }
    if ($rango >= 2) { ?>
        <center><input type="submit" value="Comprar BOT Ahora" name="buy-bot"/></center><?php } ?>
    <?php
    $me = mysqli_real_escape_string(USER_NAME);
    $query = db::query("SELECT * FROM users WHERE username = '" . $me . "'");
    while ($data = mysqli_fetch_array($query)) {
        $rango = $data['rank'];
        $vip = $data['vip'];
    }
    if ($rango == 1) { ?>
        <center>
<input name="button2" type="button"
       onclick='alert("Debes ser Premium Para poder Comprar BOTS.")' value="Comprar BOT Ahora"/></center>
    <?php } ?>



</form></div></span>
    <span style="float: right;">
Que son los BOT?:

<br><br/>
 <img src="/images/bot.png" align="right" hspace="2"/>

Son Habbos, Robot Que Hablan<br> Responden, Caminan Etc.<br> Son Maquinas Programadas <br>por ti o Cualquier Usuario que Los Posea.<br><br>Podras Colocarlos en tu<br> Imperio, Sala, MacDonals.<br> o Cualquier Otro Sitio Que Desees.<br><br>

</span>
</div>
