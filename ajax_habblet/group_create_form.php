<?php
require_once "../global.php";

if ($users->getCredits(USER_ID) < 10) {
    ?>
    <p id="purchase-result-error">Aconteceu um erro ao comprar o grupo, tente novamente mais tarde</p>
    <div id="purchase-group-errors">
        <p>
            Não tem créditos suficientes. <a href="/credits">Compre mais aqui</a>.<br/>
        </p>
    </div>

    <p>
        <a href="#" class="new-button" onclick="GroupPurchase.close(); return false;"><b>Compra efetuada</b><i></i></a>
    </p>

    <div class="clear"></div>
    <?php
} else {
    ?>
    <div id="group-purchase-header">
        <img src="/images/groups/group_icon.gif" alt="" width="46" height="46"/>
    </div>

    <p>
        Preço: <b>10 Moedas</b>.<br>Você tem: <b><?php echo clean($users->getCredits(USER_ID)); ?> Moedas(s)</b>.
    </p>

    <form action="#" method="post" id="purchase-group-form-id">

        <div id="group-name-area">
            <div id="group_name_message_error" class="error"></div>
            <label for="group_name" id="group_name_text">Nome do grupo:</label>
            <input type="text" name="group_name" id="group_name" maxlength="30"
                   onKeyUp="GroupUtils.validateGroupElements('group_name', 30, 'Nome grande de mais');" value=""/><br/>
        </div>

        <div id="group-description-area">
            <div id="group_description_message_error" class="error"></div>
            <label for="group_description" id="description_text">Descrição do grupo:</label>
            <span id="description_chars_left"><label for="characters_left">Caracteres restantes:</label>
    <input id="group_description-counter" type="text" value="255" size="3" readonly="readonly"
           class="amount"/></span><br/>
            <textarea name="group_description" id="group_description"
                      onKeyUp="GroupUtils.validateGroupElements('group_description', 255, 'Descrição muito longa');"></textarea>
        </div>
    </form>

    <div class="new-buttons clearfix">
        <a class="new-button" id="group-purchase-cancel-button" href="#" onclick='GroupPurchase.close(); return false;'><b>Cancelar</b><i></i></a>
        <a class="new-button" href="#" onclick="GroupPurchase.confirm(); return false;"><b>Comprar</b><i></i></a>
    </div>
<?php } ?>