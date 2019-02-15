<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) {
    exit;
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel'])) {
    $q = dbquery("DELETE FROM site_news WHERE id = '" . filter($_GET['doDel']) . "' LIMIT 1");

    fMessage('ok', 'Article deleted.');


    header("Location: index.php?_cmd=news&deleteOK");
    exit;
}

if (isset($_GET['doBump']) && is_numeric($_GET['doBump'])) {
    dbquery("UPDATE site_news SET datestr = '" . date('d-M-Y') . "', TIMESTAMP = '" . time() . "' WHERE id = '" . intval($_GET['doBump']) . "' LIMIT 1");

    fMessage('ok', 'Article date bumped.');


    header("Location: index.php?_cmd=news&bumpOK");
    exit;
}

require_once "top.php";

?>

    <h1>Administrar Noticias</h1>

    <br/>


    <br/>

    <p>
        <a href="index.php?_cmd=newspublish">
            <b>
                Escrever nova notícia </b>
        </a>
    </p>

    <br/>

    <table border="1" width="100%">
        <thead>
        <tr>
            <td>ID</td>
            <td>Titulo</td>
            <td>Topstory fragmento</td>
            <td>Categoria</td>
            <td>Datos</td>
            <td>Controles</td>
        </tr>
        </thead>
        <tbody>
        <?php

        $getNews = dbquery("SELECT * FROM site_news ORDER BY timestamp DESC");
        $i = 1;

        while ($n = $getNews->fetch_assoc()) {
            $highlight = '#fff';

            if ($i <= 3) {
                $highlight = '#CEE3F6';
            } else if ($i <= 5) {
                $highlight = '#EFFBFB';
            }

            echo '<tr style="background-color: ' . $highlight . ';">
	<td>' . $n['id'] . '</td>
	<td>' . clean($n['title']) . '</td>
	<td>' . clean($n['snippet']) . '</td>
	<td>' . dbquery("SELECT caption FROM site_news_categories WHERE id = '" . $n['category_id'] . "' LIMIT 1")->fetch_assoc()['caption'] . '</td>
	<td>' . $n['datestr'] . '</td>
	<td>
		<input type="button" value="Ver" onclick="document.location = \'' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '\';">&nbsp;
		<input type="button" value="Apagar" onclick="document.location = \'index.php?_cmd=news&doDel=' . $n['id'] . '\';">&nbsp;
		<input type="button" value="Editar" onclick="document.location = \'index.php?_cmd=newsedit&u=' . $n['id'] . '\';">
		<input type="button" value="No topo" onclick="document.location = \'index.php?_cmd=news&doBump=' . $n['id'] . '\';">&nbsp;
	</td>
	</tr>';

            $i++;
        }

        ?>
        </tbody>
    </table>


<?php

require_once "bottom.php";

?>