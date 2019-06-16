<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(HK_USER_ID, 'fuse_housekeeping_catalog')) {
    exit;
}

if (!isset($_GET['sq'])) {
    $_GET['sq'] = "";
}

if (!isset($_POST['search-query']) && isset($_GET['sq'])) {
    $_POST['search-query'] = $_GET['sq'];
}

if ($_GET['sq'] == '' || (!isset($_GET['sq']) && isset($_POST['search-query']) && strlen($_POST['search-query']) > 0)) {
    $_GET['sq'] = $_POST['search-query'];
}

if (isset($_GET['new'])) {
    db::query("INSERT INTO furniture (public_name,item_name,type,length,width,stack_height,can_stack,sprite_id,interaction_type) VALUES ('','newitem', 's', '1', '1', '1', '1', '1', 'switch')");
    fMessage('ok', 'New item def stub added');

    $newId = db::query("SELECT id FROM furniture ORDER BY id DESC LIMIT 1")->fetch(2)['id'];

    header("Location: ./index.php?_cmd=ot-def&edit=" . $newId);
    exit;
}

if (isset($_GET['del'])) {
    fMessage('Error', 'Realmente quieres borrar esta entrada? Esto no tiene reversa.<br /><a href="index.php?_cmd=ot-def&realdel=' . $_GET['del'] . '&sq=' . $_GET['sq'] . '">S�.</a> - o - <a href="index.php?_cmd=ot-def">Cancelar</a>');
}

if (isset($_GET['realdel'])) {
    fMessage('Ok', '�Borrado!');
    db::query("DELETE FROM furniture WHERE id = '" . intval($_GET['realdel']) . "' LIMIT 1");
    header("Location: ./index.php?_cmd=ot-def&sq=" . $_GET['sq']);
    exit;
}

$data = null;
$lockedVars = array('id', 'gonew', 'search-query');

if (isset($_GET['edit'])) {
    $i = intval($_GET['edit']);
    $get = db::query("SELECT * FROM furniture WHERE id = '" . $i . "' LIMIT 1");

    if ($get->rowCount() == 0) {
        fMessage('error', 'Oops! Item inv�lido.');
    } else {
        $data = $get->fetch(2);

        if (isset($_POST['public_name'])) {
            $i = 0;

            $qB = '';

            foreach ($_POST as $key => $value) {
                if (in_array($key, $lockedVars)) {
                    continue;
                }

                $i++;

                if ($i > 1) {
                    $qB .= ',';
                }

                $qB .= $key . " = '" . filter($value) . "'";
            }

            db::query("UPDATE furniture SET " . $qB . " WHERE id = '" . intval($_GET['edit']) . "' LIMIT 1");
            fMessage('ok', 'Updated item successfully');

            if (isset($_POST['gonew']) && $_POST['gonew'] == "y") {
                header("Location: ./index.php?_cmd=ot-def&new");
            } else {
                header("Location: ./index.php?_cmd=ot-def&edit=" . $data['id'] . "&sq=" . $_GET['sq']);
            }

            exit;
        }
    }
}

require_once "top.php";

echo '<h1>Manejar el tema definiciones</h1>';

?>

<script type="text/javascript">
    function MagicBlockProcessor(Input) {
        Input = Input.substring(1, (Input.length - 1));
        Bits = Input.split('","');

        i = 0;

        while (i < Bits.length) {
            Bit = Bits[i];

            if (i == 0) {
                Bit = Bit.substring(1);
            }

            if (i == (Bits.Length - 1)) {
                Bit = Bit.substring(0, (Bit.Length - 1));
            }

            switch (i) {
                // ["i","4326","xm09_frplc","23454","","","","","Festive Fireplace","Watch the yule log glow",""]

                case 0:

                    FillIn('type', Bit);
                    break;

                case 1:

                    FillIn('sprite_id', Bit);
                    break;

                case 2:

                    FillIn('item_name', Bit);
                    break;

                case 5:

                    if (Bit.Length == 0) {
                        Bit = "0";
                    }

                    FillIn('width', Bit);
                    break;

                case 6:

                    if (Bit.Length == 0) {
                        Bit = "0";
                    }

                    FillIn('length', Bit);
                    break;

                case 8:

                    FillIn('public_name', Bit);
                    break;

                case 3:
                case 4:
                case 7:
                case 9:
                case 10:

                    break;

                default:

                    alert('Unrecognized bit: ' + i + ': ' + Bit);
                    break;
            }

            i++;
        }

        alert('Filled in data successfully.');
    }

    function FillIn(Id, Value) {
        document.getElementById(Id).value = Value;
    }
</script>

<?php

$checkBlankItems = db::query("SELECT id FROM furniture WHERE item_name = 'newitem'");

if ($checkBlankItems->rowCount() > 0) {
    echo '<div style="margin: 5px; padding: 10px; border: 2px solid #000; color: darkred;">';
    echo '<p>';
    echo '<b>Peligro!</b> Este item tiene car�cteres blancos:<br />';
    echo '<ul class="styled">';

    while ($item = $checkBlankItems->fetch(2)) {
        if (isset($_GET['edit']) && $item['id'] == $_GET['edit']) {
            echo '<li><i>Est�s editando este item (ID #' . $item['id'] . ').</i></li>';
        } else {
            echo '<li><a href="index.php?_cmd=ot-def&edit=' . $item['id'] . '" target="_self">Item (ID #' . $item['id'] . ')</a> (o <a href="index.php?_cmd=ot-def&del=' . $item['id'] . '">Borrar</a>)</li>';
        }
    }

    echo '</ul>';
    echo '</p>';
    echo '</div>';
}

if ($data != null) {
    echo '<hr /><br />';
    echo '<small><b>Editing item</b></small>';
    echo '<h2><b>' . $data['public_name'] . '</b></h2><br />';
    echo '<form method="post" action="index.php?_cmd=ot-def&edit=' . $data['id'] . '&sq=' . $_GET['sq'] . '">';
    echo '<input type="hidden" name="search-query" value="' . $_GET['sq'] . '">';
    echo '<div style="margin: 10px; padding: 10px; border: 1px dotted #000;">';
    echo 'Insert magic block here:<br /><textarea id="magicinput"></textarea><br /><input type="button" onclick="MagicBlockProcessor(document.getElementById(\'magicinput\').value);" value="Fill in form for me">';
    echo '</div>';

    foreach ($data as $key => $value) {
        $lck = false;

        if (in_array($key, $lockedVars)) {
            $lck = true;
        }

        echo $key . ':<br /><textarea ';

        if ($lck) {
            echo 'readonly="readonly" disabled="disabled" ';
        }

        echo 'name="' . $key . '" id="' . $key . '" cols="50" rows="4">' . $value . '</textarea><br /><br />';
    }

    echo '<input type="checkbox" name="gonew" value="y"> Crear y Guardar.<br />';
    echo '<input type="submit" value="Save">&nbsp;';
    echo '<input type="button" value="Cancel/Back" onclick="window.location=\'index.php?_cmd=ot-def&sq=' . $_GET['sq'] . '\';">';
    echo '</form>';
    echo '<br />';
} else {
    echo '<form method="post">
	<input type="text" value="Buscar.." style="font-size: 150%;" size="70" onclick="if(this.value==\'Search..\'){this.value=\'\';}" name="search-query">
	</form><Br />';

    if (isset($_POST['search-query'])) {
        $_POST['search-query'] = filter($_POST['search-query']);

        $getPages = db::query("SELECT * FROM furniture WHERE item_name LIKE '%" . $_POST['search-query'] . "%' OR public_name LIKE '%" . $_POST['search-query'] . "%' OR id = '" . $_POST['search-query'] . "'");

        echo '<table width="100%" border="1" style="text-align: center;">
		<thead style="font-weight: bold; font-size: 110%;">
			<td>ID</td>
			<td>Nombre P�blico</td>
			<td>Nombre Interno</td>
			<td>Tipo</td>
			<td>Tipo de Furni</td>
			<td>Opciones</td>
			<td>Tiene entrada en el cat�logo</td>
		</thead>';

        while ($page = $getPages->fetch(2)) {
            $res = '<b style="color: darkred;">NO</b>';

            if (db::query("SELECT NULL FROM catalog_items WHERE item_ids = '" . $page['id'] . "' LIMIT 1")->rowCount() >= 1) {
                $res = '<b style="color: darkgreen;">SI</b>';
            }

            if ($res == '<b style="color: darkgreen;">SI</b>' && strlen($_POST['search-query']) < 1 && strlen($_GET['sq']) < 1) {
                continue;
            }

            echo '<tr>
			<td>' . $page['id'] . '</td>
			<td>' . $page['public_name'] . '</td>
			<td>' . $page['item_name'] . '</td>
			<td>' . $page['type'] . '</td>
			<td>' . $page['interaction_type'] . '</td>
			<td><a href="index.php?_cmd=ot-def&edit=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Ver detalles/Editar]</a> <a href="index.php?_cmd=ot-def&del=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Borrar]</a></td>
			<td>' . $res . '</td>
			</tr>';
        }

        echo '</table><br />';
    } else {
        echo '<br /><b>Please search for something first.</b><br /><Br />';
    }
}

echo '<a href="index.php?_cmd=ot-def&new"><b>Crear Nuevo.</b></a>';

echo '</div>
</div>';

require_once "bottom.php";

?>								