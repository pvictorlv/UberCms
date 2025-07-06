<?php
define('TAB_ID', 5);
define('PAGE_ID', 17);

require_once "global.php";

$articleData = null;

if (isset($_GET['mostRecent'])) {
    $getData = db::query("SELECT * FROM site_news ORDER BY timestamp DESC LIMIT 1");

    if ($getData->rowCount() > 0) {
        $articleData = $getData->fetch(2);
    }
} else if (isset($_GET['rel'])) {
    $rel = ($_GET['rel']);

    if (strrpos($rel, '-') >= 1) {
        $bits = explode('-', $rel);
        $id = $bits[0];

        $getData = db::query("SELECT * FROM site_news WHERE id = ? LIMIT 1", $id);

        if ($getData->rowCount() > 0) {
            $articleData = $getData->fetch(2);
        }
    }
}

$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('generic');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');

$newslist = new Template('comp-newslist');

if (isset($_GET['archiveMode'])) {
    $mode = 'archive';
    $newslist->SetParam('mode', 'archive');
} else if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $mode = 'category';
    $newslist->SetParam('mode', 'category');
    $newslist->SetParam('category_id', ($_GET['category']));
} else {
    $mode = 'recent';
    $newslist->SetParam('mode', 'recent');
}

$tpl->AddTemplate($newslist);

$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');
if (LOGGED_IN == true) {
    $article = new Template('comp-newsarticle');
} else {
    $article = new Template('comp-newsarticle');
}
if ($articleData != null) {
    $article->SetParam('news_article_id', $articleData['id']);
    $article->SetParam('news_article_title', clean($articleData['title']));
    $article->SetParam('news_article_date', 'Postada em ' . clean($articleData['datestr']));
    $article->SetParam('news_category', '<a href="%www%/articles/category/' . $articleData['category_id'] . '">' . (db::query("SELECT caption FROM site_news_categories WHERE id = ? LIMIT 1", $articleData['category_id'])->fetchColumn()) . '</a>');
    $article->SetParam('news_article_summary', clean($articleData['snippet']));
    $article->SetParam('news_article_body', clean($articleData['body'], true));

    $tpl->SetParam('page_title', 'Noticias - ' . clean($articleData['title']));
} else {
    $article->SetParam('news_article_id', 0);
    $article->SetParam('news_article_title', 'Artigo não encontrado.');
    $article->SetParam('news_article_date', '');
    $article->SetParam('news_category', '');
    $article->SetParam('news_article_summary', '');
    $article->SetParam('news_article_body', 'O artigo que você deseja acessar não existe mais, talvez nunca existiu ou foi temporariamente removido, clique no botão Voltar para ir para a página anterior.');

    $tpl->SetParam('page_title', 'News - Notícia inexistente');
}

$tpl->AddTemplate($article);
$tpl->Write('</div>');

$tpl->AddGeneric('footer');

$tpl->SetParam('body_id', 'news');

$tpl->Output();

?>