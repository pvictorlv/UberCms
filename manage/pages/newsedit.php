<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) {
    exit;
}

$data = null;

if (isset($_GET['u']) && is_numeric($_GET['u'])) {
    $u = filter($_GET['u']);
    $getData = db::query("SELECT * FROM site_news WHERE id = '" . $u . "' LIMIT 1");

    if ($getData->rowCount() > 0) {
        $data = $getData->fetch(2);
    }
}

if ($data == null) {
    fMessage('error', 'Woops, notícia não encontrada!');
    header("Location: index.php?_cmd=news");
    exit;
}

if (isset($_POST['editor1'])) {
    $title = filter($_POST['title']);
    $teaser = filter($_POST['teaser']);
    $topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
    $content = filter($_POST['editor1']);
    $category = filter($_POST['category']);

    if (strlen($title) < 1 || strlen($teaser) < 1 || strlen($content) < 1) {
        fMessage('error', 'Por favor, preencha todos os pontos');
    } else {
        db::query("UPDATE site_news SET title = '" . $title . "', category_id = '" . $category . "', topstory_image = '" . $topstory . "', body = '" . $content . "', snippet = '" . $teaser . "' WHERE id = '" . $data['id'] . "' LIMIT 1");
        fMessage('ok', 'News article updated.');

        header("Location: index.php?_cmd=news");
        exit;
    }
}

foreach ($data as $key => $value) {
    switch ($key) {
        case 'snippet':

            $key = 'teaser';
            break;

        case 'topstory_image':

            $bits = explode('/', $value);
            $value = $bits[count($bits) - 1];
            $key = 'topstory';
            break;

        case 'body':

            $key = 'content';
            break;
    }

    if (!isset($_POST[$key])) {
        $_POST[$key] = $value;
    }
}

require_once "top.php";

?>

    <script type="text/javascript">
        function previewTS(el) {
            document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
        }
    </script>

    <h1>Publish News</h1>
    <form method="post">

        <br/>

        <div style="float: left;">

            <strong>Titulo:</strong><br/>
            <input type="text" value="<?php if (isset($_POST['title'])) {
                echo clean($_POST['title']);
            } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br/>
            <br/>

            <strong>Categoria:</strong><br/>
            <select name="category">
                <?php

                $getOptions = db::query("SELECT * FROM site_news_categories ORDER BY caption ASC");

                while ($option = $getOptions->fetch(2)) {
                    echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $data['category_id']) ? 'selected' : '') . '>' . ($option['caption']) . '</option>';
                }

                ?>
            </select><br/>
            <br/>

            <strong>URL-Noticia:</strong><br/>
            <div style="border: 1px dotted; width: 300px; padding: 5px;">
                <?php echo WWW; ?>/<b><?php echo $data['id']; ?>-<?php echo clean($data['seo_link']); ?></b>/<br/>
            </div>
            <br/>

            <strong>Descrição:</strong><br/>
            <input name="teaser" type="text" size="50"  style="padding: 5px; font-size: 130%;" value="<?php echo (isset($_POST['teaser'])) ? $_POST['teaser'] : null; ?>"><br/>
            <br/>

            <strong>Topstory imagen:</strong><br/>

            <select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory"
                    style="padding: 5px; font-size: 120%;">
                <?php

                if ($handle = opendir(CWD . '/images/ts')) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file == '.' || $file == '..') {
                            continue;
                        }

                        echo '<option value="' . $file . '"';

                        if (isset($_POST['topstory']) && $_POST['topstory'] == $file) {
                            echo ' selected';
                        }

                        echo '>' . $file . '</option>';
                    }
                }

                ?>
            </select>

        </div>

        <div id="ts-preview"
             style="margin-left: 20px; padding: 10px; float: left; text-align: center; vertical-align: middle;">

            <img src="<?php echo $data['topstory_image']; ?>">

        </div>

        <div style="clear: both;"></div>

        <br/><br/>

        <textarea id="content" name="editor1" style="width:80%"><?php if (isset($_POST['editor1'])) {
                echo $_POST['editor1'];
            } else { echo $data['body']; } ?></textarea>

        <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
        <script>CKEDITOR.replace('editor1');</script>
        <br/>
        <br/>

        <input type="submit" value="Salvar">&nbsp;
        <input type="button" value="Cancelar" onclick="window.location = 'index.php?_cmd=news';">

    </form>


<?php

require_once "bottom.php";

?>