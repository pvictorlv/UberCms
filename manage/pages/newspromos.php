<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) {
    exit;
}


require_once "top.php";

?>
    <script type="text/javascript" src="./LightWindow/javascript/prototype.js"></script>
    <script type="text/javascript" src="./LightWindow/javascript/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="./LightWindow/javascript/lightwindow.js"></script>
    <link rel="stylesheet" href="./LightWindow/css/lightwindow.css" type="text/css" media="screen"/>

    <h1>Promos</h1>
    <form method="post">

        <br/>

        <div style="float: left;">

            <?php
            $getOptions = db::query("SELECT * FROM site_promos ORDER BY id");

            ?>

            <?php while ($Config = $getOptions->fetch(2)) {
                echo '<strong><font color="green">' . $Config['titulo'] . '</font></strong>  ';
                echo '<form name="formulario' . $Config['titulo'] . '" method="post" action="index.php?_cmd=editar_promos"><input type="hidden" id="nombre" name="nombre" value="' . $Config['titulo'] . '">
<a href="index.php?_cmd=newspromosedit&nombre=' . $Config['titulo'] . '" id="boton">Editar</a> ';
                echo '<a href="./ajax/confirm_borrar_promo.php?nombre=' . $Config['titulo'] . '" id="boton" class="lightwindow page-options" params="lightwindow_width=640,lightwindow_height=290">Borrar</a>';
                echo '<br>';
            } ?>

            <br>

            <br>
            <br>
            <a href="index.php?_cmd=newspromospublish" id="boton">Nuevo Promo</a>

    </form>


<?php

require_once "bottom.php";

?>