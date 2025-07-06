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

if (isset($_GET['new'])) {
    db::query("INSERT INTO catalog_items (page_id,item_ids,catalog_name,cost_credits,cost_pixels,amount) VALUES (137,1,'',10,0,1)");
    fMessage('ok', 'New catalog item stub added');
    $newId = db::GetId();

    header("Location: ./index.php?_cmd=ot-cata-items&edit=" . $newId);
    exit;
}

if (isset($_GET['del'])) {
    fMessage('error', 'Are you <b>SURE</b> you want to delete that catalog item? This CAN NOT be reversed.<br /><a href="index.php?_cmd=ot-cata-items&realdel=' . $_GET['del'] . '&sq=' . $_GET['sq'] . '">YES, DELETE IT</a> - or - <a href="index.php?_cmd=ot-cata-items">CANCEL</a>');
}

if (isset($_GET['realdel'])) {
    fMessage('ok', 'Item def deleted!');
    db::query("DELETE FROM catalog_items WHERE id = '" . intval($_GET['realdel']) . "' LIMIT 1");
    header("Location: ./index.php?_cmd=ot-cata-items&sq=" . $_GET['sq']);
    exit;
}

$data = null;
$lockedVars = array('id', 'gonew');

if (isset($_GET['edit'])) {
    $i = (int)$_GET['edit'];
    $get = db::query("SELECT * FROM catalog_items WHERE id = '" . $i . "' LIMIT 1");

    if (($get->rowCount()) == 0) {
        fMessage('error', 'Oops! Invalid item.');
    } else {
        $data = $get->fetch(2);

        if (isset($_POST['page_id'])) {
            $i = 0;

            $qB = '';

            foreach ($_POST as $key => $value) {
                $i++;

                if (in_array($key, $lockedVars, true)) {
                    continue;
                }

                if ($i > 1) {
                    $qB .= ',';
                }

                $qB .= $key . " = '" . filter($value) . "'";
            }

            db::query("UPDATE catalog_items SET " . $qB . " WHERE id = '" . intval($_GET['edit']) . "' LIMIT 1");
            fMessage('ok', 'Updated cata item successfully');

            if (isset($_POST['gonew']) && $_POST['gonew'] == "y") {
                header("Location: ./index.php?_cmd=ot-cata-items&new");
            } else {
                header("Location: ./index.php?_cmd=ot-cata-items&edit=" . $data['id']);
            }

            exit;
        }
    }
}

require_once "top.php";

echo '<h1>Administrar los items del cat�logo.</h1>';

$checkBlankItems = db::query("SELECT id,page_id FROM catalog_items WHERE item_ids = '1' AND catalog_name = ''");

if ($checkBlankItems->rowCount() > 0) {
    echo '<div style="margin: 5px; padding: 10px; border: 2px solid #000; color: darkred;">';
    echo '<p>';
    echo '<b>�Peligro!</b> Alg�nos items tienen car�cteres en blanco:<br />';
    echo '<ul class="styled">';

    while ($item = $checkBlankItems->fetch(2)) {
        if (isset($_GET['edit']) && $item['id'] == $_GET['edit']) {
            echo '<li><i>Est�s editando este item actualmente (ID #' . $item['id'] . ').</i></li>';
        } else {
            echo '<li><a href="index.php?_cmd=ot-cata-items&edit=' . $item['id'] . '" target="_self">Item (ID #' . $item['id'] . ') on page ' . $item['page_id'] . '</a> (or <a href="index.php?_cmd=ot-cata-items&del=' . $item['id'] . '">Delete</a>)</li>';
        }
    }

    echo '</ul>';
    echo '</p>';
    echo '</div>';
}

if ($data != null) {
    echo '<hr /><br />';
    echo '<small><b>Edit�ndo el Item</b></small>';
    echo '<h2><b>' . $data['catalog_name'] . '</b></h2><br />';
    echo '<form method="post" action="index.php?_cmd=ot-cata-items&edit=' . $data['id'] . '">';

    foreach ($data as $key => $value) {
        $lck = false;

        if (in_array($key, $lockedVars)) {
            $lck = true;
        }

        echo $key . ':<br /><textarea ';

        if ($lck) {
            echo 'readonly="readonly" disabled="disabled" ';
        }

        echo 'name="' . $key . '" cols="50" rows="4">' . $value . '</textarea><br /><br />';
    }

    echo '<input type="checkbox" name="gonew" value="y" checked> Create & go to new stub after saving<br />';
    echo '<input type="submit" value="Save">&nbsp;';
    echo '<input type="button" value="Cancel" onclick="window.location=\'index.php?_cmd=ot-cata-items&sq=' . $_GET['sq'] . '\';">';
    echo '</form>';
    echo '<br />';
} else {
    echo '<form method="post">
	<input type="text" value="Buscar.." style="font-size: 150%;" size="70" onclick="if(this.value==\'Buscar..\'){this.value=\'\';}" name="search-query">
	</form><Br />';

    if (!isset($_POST['search-query']) && isset($_GET['sq'])) {
        $_POST['search-query'] = $_GET['sq'];
    }

    if (isset($_POST['search-query'])) {
        $_POST['search-query'] = filter($_POST['search-query']);

        $getPages = db::query("SELECT * FROM catalog_items WHERE catalog_name LIKE '%" . $_POST['search-query'] . "%' OR id = '" . $_POST['search-query'] . "' OR item_ids = '" . $_POST['search-query'] . "' OR page_id = '" . $_POST['search-query'] . "' ORDER BY item_ids ASC");

        echo '<a href="index.php?_cmd=ot-cata-items&new"><b>Crear un nuevo item del cat�logo</b></a><br /><br />';

        echo '<table width="100%" border="1" style="text-align: center;">
		<thead style="font-weight: bold; font-size: 110%;">
			<td>ID</td>
			<td>Page ID</td>
			<td>Definici�n</td>
			<td>Nombre</td>
			<td>Costo</td>
			<td>Cantidad</td>
			<td>Opciones</td>
		</thead>';

        while ($page = $getPages->fetch(PDO::FETCH_ASSOC))) {
            echo '<tr>
			<td>' . $page['id'] . '</td>
			<td>' . $page['page_id'] . '</td>
			<td><a href="ot-def.php?edit=' . $page['item_ids'] . '">' . $page['item_ids'] . '</a></td>
			<td>' . $page['catalog_name'] . '</td>
			<td>' . $page['cost_credits'] . ' CR, ' . $page['cost_pixels'] . ' PX</td>
			<td>' . $page['amount'] . '</td>
			<td><a href="index.php?_cmd=ot-cata-items&edit=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Ver detalles/Editar]</a> <a href="index.php?_cmd=ot-cata-items&del=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Borrar]</a></td>
			</tr>';
        }

        echo '</table><br />';
    } else {
        echo '<br /><b>Please search for something first.</b><br /><Br />';
    }
}

echo '<a href="index.php?_cmd=ot-cata-items&new"><b>Crear un nuevo item del cat�logo</b></a>';

echo '</div>
</div>';

require_once "bottom.php";

?>								