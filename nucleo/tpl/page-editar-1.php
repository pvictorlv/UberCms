<?php


$Grupos = db::query("SELECT * FROM groups_details WHERE ownerid = '".USER_ID."'");

if($Grupos->rowCount() > 1){

?>
<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Qual grupo deseja editar?</h2>
<div class="box-content">

Escolha um grupo no qual voc� � dono abaixo.<br>
<br>
<form action="%www%/editar_grupos?segundo" method="post">
<center>
<select name='name'  class='dropdown'>
<?php while($Get = $Grupos->fetch(2)){

echo '<option value="' .$Get['name'] . '">' .$Get['name'] . '</option>';
}

?>
</select>
<br>
<br>
<input type="submit" value="Editar!">
</center>
</form>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
<?php }else{?>

<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Qual grupo deseja editar?</h2>
<div class="box-content">

Escolha um grupo no qual voc� � dono abaixo.<br>
<br>
<form action="%www%/editar_grupos?segundo" method="post">
<center>
<b>Desculpe, mas voc� n�o � dono de nenhum grupo.</b>
</center>
</form>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
<?php } ?>