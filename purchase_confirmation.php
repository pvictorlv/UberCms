<?php

require_once "global.php";

$name = filter(fixText(($_POST['name'])));
$description = filter(substr(fixText(($_POST['description'])), 0, 255));

if (empty($name)) {
    $msg = "[Nome do grupo não definido]";
    require('group_create_form.php');
    exit;
}

?>
<input type="hidden" name="struts.token.name" value="struts.token"/>
<input type="hidden" name="struts.token" value="b1003Xs05175s05173s09114"/>
<div id="group-logo">
    <img src="/images/groups/group_icon.gif" alt="" width="46" height="46"/>
</div>

<p>
    Nome do grupo: <b><?php echo $name; ?></b><br>Preço: <b>10 Moedas</b>.<br> Você tem:
    <b><?php echo clean($users->getCredits(USER_ID)); ?> Créditos</b>
</p>

<div id="group-confirmation-button-area">
    <div class="new-buttons clearfix">
        <a class="new-button" href="#" onclick="GroupPurchase.close(); return false;"><b>Cancelar</b><i></i></a>
        <a class="new-button" href="#" onclick="GroupPurchase.purchase(); return false;"><b>Comprar</b><i></i></a>
    </div>
</div>