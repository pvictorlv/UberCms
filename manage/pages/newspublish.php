<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) {
    exit;
}

if (isset($_POST['title'])) {
    $title = filter($_POST['title']);
    $teaser = filter($_POST['teaser']);
    $topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
    $content = filter($_POST['editor1']);
    $seoUrl = filter($_POST['url']);
    $category = (int)$_POST['category'];

    if (strlen($seoUrl) < 1 || strlen($title) < 1 || strlen($teaser) < 1) {
        fMessage('error', 'Por Favor llena todos los datos.');
    } else {
         db::query("INSERT INTO site_news (title,category_id,seo_link,topstory_image,body,snippet,datestr,timestamp) VALUES ('" . $title . "','" . $category . "','" . $seoUrl . "','" . $topstory . "','" . $content . "','" . $teaser . "','" . date('d-M-Y') . "', '" . time() . "')");
        fMessage('ok', 'Nova notícia postada.');

           header("Location: index.php?_cmd=news");
        exit;
    }
}

require_once "top.php";

?>

<script type="text/javascript">
    function previewTS(el) {
        document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
    }

    function suggestSEO(el) {
        var suggested = el;

        suggested = suggested.toLowerCase();
        suggested = suggested.replace(/^\s+/, '');
        suggested = suggested.replace(/\s+$/, '');
        suggested = suggested.replace(/[^a-z 0-9]+/g, '');

        while (suggested.indexOf(' ') > -1) {
            suggested = suggested.replace(' ', '-');
        }

        document.getElementById('url').value = suggested;
    }
</script>

<h1>Postar Noticia</h1>
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
                echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $_POST['category']) ? 'selected' : '') . '>' . $option['caption'] . '</option>';
            }

            ?>
        </select><br/>
        <br/>

        <strong>URL:</strong><br/>
        <div style="border: 1px dotted; width: 300px; padding: 5px;">
            <?php echo WWW; ?>/[id]-<input type="text" id="url" name="url" value="<?php if (isset($_POST['url'])) {
                echo clean($_POST['url']);
            } ?>" maxlength="120">/<br/>
        </div>
        <br/>
        <br/>

        <strong>Descrição:</strong><br/>
        <input name="teaser" type="text" size="50"  style="padding: 5px; font-size: 130%;"><?php if (isset($_POST['teaser'])) {
                echo clean($_POST['teaser']);
            } ?><br/>
        <br/>

        <strong>Imagem:</strong><br/>

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


    </div>

    <div style="clear: both;"></div>

    <br/><br/>


    <textarea name="editor1"><?php echo $_POST['editor1'] ?? null; ?></textarea>

    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>CKEDITOR.replace('editor1');</script>

    <br/>
    <br/>

    <input type="submit" value="Enviar">

</form>


