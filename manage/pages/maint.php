<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin')) {
    exit;
}

$maintMode = dbquery("SELECT mantenimiento FROM configuracion LIMIT 1")->fetch_assoc()['mantenimiento'];

if (isset($_GET['switch'])) {
    $newState = "1";

    if ($maintMode == "1") {
        $newState = "0";
    }

    dbquery("UPDATE configuracion SET mantenimiento = '" . $newState . "' LIMIT 1");
    $maintMode = $newState;
}

require_once "top.php";

?>

    <h1>Modo Mantenimiento</h1>

    <br/>

    <p>
        el modo de mantenimiento se puede utilizar para deshabilitar el sitio y prevenir eficazmente los inicios de
        sesi�n nueva con el servidor. Tenga en cuenta que cualquier usuario sigue conectado al servidor o tener una
        sesi�n de entrada generados por ellos, a�n podr� utilizar el servidor hasta que se desconecta o se reinicia la
        misma.
    </p>

    <h2>
        <?php

        if ($maintMode == "1") {
            echo '<span style="font-size: 120%; color: darkred;"><br>el modo de mantenimiento est� habilitado actualmente. El sitio no es accesible para usuarios habituales.<br></span><br /><input type="button" value="Desactivar mantenimiento" onclick="document.location = \'index.php?_cmd=maint&switch\';">';
        } else {
            echo '<br>Modo Mantenimiento desactivado.<br /><br><input type="button" value="Activar mantenimiento" onclick="document.location = \'index.php?_cmd=maint&switch\';" style="color: darkred; font-weight: bold;">';
        }

        ?>
    </h2>

<?php

require_once "bottom.php";

?>