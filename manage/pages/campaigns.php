<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) {
    exit;
}

if (isset($_POST['edit'])) {
    $id = (int)filter($_POST['edit']);
    $image = filter($_POST['image']);
    $title = filter($_POST['title']);
    $descr = filter($_POST['descr']);
    $enabled = filter($_POST['enabled']);
    $url = filter($_POST['url']);

    dbquery("UPDATE site_hotcampaigns SET image_url = '" . $image . "', caption = '" . $title . "', `desc` = '" . $descr . "', enabled = '" . $enabled . "', url = '" . $url . "' WHERE id = '" . $id . "' LIMIT 1");
    fMessage('ok', 'Updated campaign.');
}

if (isset($_POST['add-new'])) {
    $image = filter($_POST['image']);
    $title = filter($_POST['title']);
    $descr = filter($_POST['descr']);
    $enabled = filter($_POST['enabled']);
    $url = filter($_POST['url']);
    dbquery("INSERT INTO site_hotcampaigns (enabled,image_url,caption,`desc`,url) VALUES ('" . $enabled . "','" . $image . "','" . $title . "','" . $descr . "','" . $url . "')");
    echo 1;

    fMessage('ok', 'Noticion Agregado');
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel'])) {
    dbquery("DELETE FROM site_hotcampaigns WHERE id = '" . $_GET['doDel'] . "' LIMIT 1");
    fMessage('ok', 'Deleted.');
    header("Location: index.php?_cmd=campaigns");
    exit;
}

require_once "top.php";

?>

    <h1>Campanhas</h1>

    <br/>

    <p>
        Pode utilizar essa ferramenta para criar campanhas no site!
    </p>

    <br/>

    <table width="100%" border="1">
        <thead>
        <tr>
            <td>Imagem</td>
            <td>Titulo</td>
            <td>Link</td>
            <td>Descrição</td>
            <td>Ativado</td>
            <td>Opções</td>
        </tr>
        </thead>
        <tbody>
        <?php

        $getItems = dbquery("SELECT * FROM site_hotcampaigns ORDER BY order_id ASC");

        while ($item = $getItems->fetch_assoc()) {
            echo '<tr>
	<form method="post">
	<input type="hidden" name="edit" value="' . $item['id'] . '">
	<td><input type="text" name="image" value="' . clean($item['image_url']) . '"></td>
	<td><input type="text" name="title" value="' . clean($item['caption']) . '"></td>
	<td><input type="text" name="url" value="' . clean($item['url']) . '"></td>
	<td><input type="text" name="descr" value="' . clean($item['desc']) . '"></td>
	<td><select name="enabled"><option value="1">Sim</option><option value="0" ' . (($item['enabled'] == "0") ? 'selected' : '') . '>Não</option></select></td>
	<td><input type="submit" value="Salvar">&nbsp;<input type="button" onclick="document.location = \'index.php?_cmd=campaigns&doDel=' . $item['id'] . '\';" value="Apagar"></td>	
	</form>
	</tr>';
        }

        ?>
        <tr>

            <form method="post">
                <input type="hidden" name="add-new" value="1">
                <td><input type="text" name="image"></td>
                <td><input type="text" name="title"></td>
                <td><input type="text" name="url"></td>
                <td><input type="text" name="descr"></td>
                <td><select name="enabled">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select></td>
                <td><input type="submit" value="Criar"></td>
            </form>
        </tr>
        </tbody>
    </table>

<?php

require_once "bottom.php";

?>