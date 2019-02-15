<?php

if($users->getCredits(USER_ID) < 10){
?>
<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Compra un grupo</h2>
<div class="box-content">
<p id="purchase-result-error">Se ha producido un error al comprar el Grupo.</p>
    <div id="purchase-group-errors">
        <p>
            No tienes Cr&eacute;ditos suficientes.<br />
        </p>
    </div>

<p>
<a href="#" class="new-button"><b>Volver</b><i></i></a>
</p>

<div class="clear"></div>
</div>
</div>
</div>

<?php }else{ ?>
<div class="habblet-container ">
<div class="cbb clearfix blue ">
<h2 class="title">Compra un grupo</h2>
<div class="box-content">
<div id="group-purchase-header">
   <img src="/images/groups/group_icon.gif" alt="" width="46" height="46" />
</div>

<p>
Precio: <b>10 Cr&eacute;ditos</b>.<br> Tienes: <b><?php echo clean($users->getCredits(USER_ID)); ?> Cr&eacute;ditos</b>.
</p>

<form action="purchase_confirmation.php" method="post" id="purchase-group-form-id" name="formulario" onsubmit="GroupPurchase.confirm();">

<div id="group-name-area">
    <div id="group_name_message_ error" class="error"></div>
    <label for="group_name" id="group_name_text">Nombre del Grupo:</label>
    <input type="text" name="group_name" id="group_name" maxlength="30" onKeyUp="GroupUtils.validate GroupElements('group_name', 30, 'Nombre demasiado largo');" value=""/><br />
</div>

<div id="group-description-area">
    <div id="group_description_message_error" class="error"></div>
    <label for="group_description" id="description_text">Descripci&oacute;n del Grupo:</label><br><br>
    <span id="description_chars_left"><label for="characters_left">Car&aacute;cteres restantes:</label>
    <input id="group_description-counter" type="text" value="255" size="3" readonly="readonly" class="amount" /></span><br/>
    <textarea name="group_description" id="group_description" onKeyUp="GroupUtils.validate GroupElements('group_description', 255, 'Descripci&oacute;n demasiada larga');"></textarea>
</div>
<div class="new-buttons clearfix">
   <a class="new-button" id="group-purchase-cancel-button" href="#" onclick='GroupPurchase.close(); return false;'><b>Cancelar</b><i></i></a>
   <a class="new-button" href="#" onclick="document.formulario.submit(); "><b>&iexcl;Comprar Grupo!</b><i></i></a>
</form>
</div>
</div>
</div>
</div>
<?php } ?>