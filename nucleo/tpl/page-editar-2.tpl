<?php
if(isset($_POST['name'])){
$Nombre = $_POST['name'];
$Grupos = mysql_query("SELECT * FROM groups_details WHERE name = '".$Nombre."' LIMIT 1");
$GetGrupo = mysql_fetch_assoc($Grupos);

?>

<script type="text/javascript" src="./manage/LightWindow/javascript/prototype.js"></script>
<script type="text/javascript" src="./manage/LightWindow/javascript/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="./manage/LightWindow/javascript/lightwindow.js"></script>
<link rel="stylesheet" href="./manage/LightWindow/css/lightwindow.css" type="text/css" media="screen" />

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Editando!</h2>
<div class="box-content">
<center>
Para editar basta trocar os valores abaixo. (A edição custa %creditos_grupos% moedas).<br>
</center>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Informação do grupo</h2>
<div class="box-content">
<form action="%www%/editar_grupos?tercero&editar=informacion" method="post">
<center>
<b>Título: <input type="text" name="titulo" id="titulo" value="<?php echo $GetGrupo['name']; ?>"></b>
<br><b>Descrição: <input type="text" name="descripcion" id="descripcion" value="<?php echo $GetGrupo['description']; ?>"></b>
<br>
<br>
<input type="hidden" value="<?php echo $Nombre; ?>" name="nombre" id="nombre">
<input type="submit" value="Feito">
</form>
</center>

</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Emblema do grupo</h2>
<div class="box-content">
<center>
Sua placa atual:<br><br>
<img src="%www%/habbo-imaging/badge.php?badge=<?php echo $GetGrupo['badge']; ?>">
<br>Quer trocar? <a href="%www%/placasgrupos.html" target="_blank">clique aqui</a>, monte seu emblema e cole o código abaixo.
<br>
<br>
<form action="%www%/editar_grupos?tercero&editar=placa" method="post">
<input type="hidden" value="<?php echo $Nombre; ?>" name="nombre" id="nombre">
<input type="text" name="placas" id="placas" value="Digite seu código">
<input type="submit" value="Feito">
</form>
</center>

</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Fundo do grupo</h2>
<div class="box-content">
<center>
O fundo do seu grupo é:<br><br>
<div class="webstore-item-preview <?php echo $GetGrupo['bg']; ?> Background"></center>
<br>Acesse <a href="%www%/ajax_habblet/fondos.php" class="lightwindow page-options" params="lightwindow_width=500,lightwindow_height=380">aqui</a> e escolha outro
<br>
<br>
<form action="%www%/editar_grupos?tercero&editar=fondo" method="post">
<input type="hidden" value="<?php echo $Nombre; ?>" name="nombre" id="nombre">
<input type="text" name="fondo" id="fondo" value="Digite seu código">
<input type="submit" value="Feito">
</form>
</center>

</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
<?php }else{
header("Location: " . WWW . "/error.php");}?>