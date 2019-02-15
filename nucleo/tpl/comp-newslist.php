<div class="habblet-container ">
    <div class="cbb clearfix default ">

        <h2 class="title">Notícias <?php global $mode;
            if ($mode == 'archive') {
                echo 'Archive';
            } ?>
        </h2>
        <div id="article-archive">

            <?php

            if ($mode == 'recent') {
                global $id;
                $getArticles = dbquery("SELECT id,seo_link,title FROM site_news ORDER BY timestamp DESC LIMIT 30");

                if ($getArticles->num_rows > 0) {
                    echo '<ul>';
                    while ($a = $getArticles->fetch_assoc()) {
                        echo '<li><a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a></li>';
                    }

                    echo '</ul>';
                }


                echo '<a href="%www%/articles/archive">Mais notícias &raquo;</a>';
            } else if ($mode == 'archive') {
                $categories = [];
                $getArticles = dbquery("SELECT * FROM site_news");

                while ($newsData = $getArticles->num_rows) {
                    $categories[$newsData['category_id']][] = $newsData;
                }

                foreach ($categories as $catId => $articlesInCat) {
                    if (count($articlesInCat) < 1) {
                        continue;
                    }

                    $getCategory = dbquery("SELECT caption FROM site_news_categories WHERE id = '" . (int)$catId . "' LIMIT 1");
                    $catName = 'Unknown';

                    if ($getCategory->num_rows == 1) {
                        $catName = clean($getCategory->fetch_assoc()['caption']);
                    }

                    echo '<h2>' . $catName . '</h2>';
                    echo '<ul>';

                    foreach ($articlesInCat as $a) {
                        echo '<li>		
					<a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '/in/archive" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a> 
				</li>';
                    }

                    echo '</ul>';
                }
            } else if ($mode == 'category') {
                $getArticles = dbquery("SELECT * FROM site_news WHERE category_id = '" . $category_id . "'");
                $getCategory = dbquery("SELECT caption FROM site_news_categories WHERE id = '" . (int)$category_id . "' LIMIT 1");
                $catName = 'Unknown';

                if ($getCategory->num_rows == 1) {
                    $catName = clean($getCategory->fetch_assoc()['caption']);
                }

                echo '<h2>' . $catName . '</h2>';
                echo '<ul>';

                while ($a = $getArticles->fetch_assoc()) {
                    echo '<li>		
				<a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a> 
			</li>';
                }

                echo '</ul>';
            }
            ?>
        </div>


    </div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>
				