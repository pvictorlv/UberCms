<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN) {
    exit;
}

require_once "top.php";

?>
    <h2>Bem-vindo ao painel!</h2>

    <br/>

    <p>
        <img src="/web-gallery/images/piccolo_happy.gif" style="float: left;margin-right:11px;"><img
                src="/web-gallery/images/tools.gif" style="float: right;">

        A Housekeeping é um painel que ajuda os staffs a cumprirem seus deveres de uma forma mais fácil e rápida.
    </p>

    <br/>

    <p>
        Se tem alguma sugestão entre em contato com os administradores do hotel.
    </p>

    <br/>
    <br/>

    <img src="/web-gallery/v2/images/registration/arrow_left.png" style="float: left;margin-left:300px;"><img
        src="/web-gallery/v2/images/registration/arrow_right.png" style="float: right;margin-right:300px;">
    <br/><br/>

    </li></ul>

<?php

require_once "bottom.php";

?>