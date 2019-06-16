<div class="habblet-container ">
    <div class="cbb clearfix notitle ">


        <div id="article-wrapper">

            <h2>%news_article_title%</h2>

            <div class="article-meta">

                <?php
                global $articleData;
                if ($articleData['id'] > 0) { ?>
                    %news_article_date%
                    %news_category%
                <?php } ?>
            </div>

            <p class="summary">

                %news_article_summary%

            </p>

            <div class="article-body">

                %news_article_body%

            </div>

            <?php if ($articleData['id'] > 0) { ?>
                <script type="text/javascript" language="Javascript">
                    document.observe("dom:loaded", function () {
                        $$('.article-images a').each(function (a) {
                            Event.observe(a, 'click', function (e) {
                                Event.stop(e);
                                Overlay.lightbox(a.href, "Carregando imagem");
                            });
                        });

                        $$('a.article-%news_article_id%').each(function (a) {
                            a.replace(a.innerHTML);
                        });
                    });
                </script>
            <?php } ?>

        </div>

    </div>
</div>
<?php
$error_message = "";

if (isset($_POST['csrf_token']) && $_SESSION['csrf_token'] === $_POST['csrf_token'] && LOGGED_IN) {
    $posted_on = date("d/m/Y h:m");
    if (isset($_SESSION['last_comment']) && $_SESSION['last_comment'] >= time() - 30) {
        $error_message = "Espere um pouco antes de comentar novamente!";
    } else {
        $_SESSION['last_comment'] = time();
        $comment = filter($_POST['comment']);
        if ($comment === null || empty($comment)) {
            $error_message = 'Comentário em branco.<br /><br />';
        } else {
            db::query("INSERT INTO site_news_comments (article, userid, comment,posted_on) VALUES ('" . $articleData['id'] . "', '" . USER_ID . "', '" . $comment . "', '$posted_on');");
            $error_message = 'Enviado com sucesso.<br /><br />';

        }
    }
}
?>
<?php if (LOGGED_IN) { ?>
    <div class="habblet-container ">
        <div class="cbb clearfix notitle ">
            <?php echo "<div align='center'>$error_message</div>" ?>
            <div id="article-wrapper"><h2>Escreva um comentário</h2>
                <div class="article-meta"></div>
                <div class="article-body">
                    <form action="" method="post">
                        <textarea name="comment" maxlength="500" required></textarea><br/><br/>
                        <input type="hidden" value="<?php echo $_SESSION['csrf_token'] ?>" name="csrf_token">
                        <input type="submit" name="post_comment" value="Enviar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<style type="text/css">
    input[type="text"], input[type="password"] {
        background-color: #F1F1F1;
        border: 1px solid #999999;
        width: 175px;
        padding: 5px;
        font-family: verdana;
        font-size: 10px;
        color: #666666;
    }

    input[type="submit"] {
        background-color: #F1F1F1;
        border: 1px solid #999999;
        padding: 5px;
        font-family: verdana;
        font-size: 10px;
        color: #666666;
    }

    textarea {
        background-color: #F1F1F1;
        border: 1px solid #999999;
        padding: 5px;
        width: 517px;
        height: 70px;
        font-family: verdana;
        font-size: 10px;
        color: #666666;
    }

    select {
        background-color: #F1F1F1;
        border: 1px solid #999999;
        padding: 5px;
        font-family: verdana;
        font-size: 10px;
        color: #666666;
    }
</style>
<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$limit = 6 * $page;
$rows = db::query("SELECT id FROM site_news_comments WHERE article = ?",$articleData['id'])->rowCount();
if ($rows > 0) {
    $pages = round($rows / 6);
} else {
    $pages = 0;
}
$getComments = db::query("SELECT * FROM site_news_comments WHERE article = ? ORDER BY id DESC LIMIT $limit, 6", $articleData['id']);
?>
<div class="habblet-container ">
    <div class="cbb clearfix notitle ">
        <div id="article-wrapper"><h2>Últimos comentários</h2>
            <div class="article-meta"></div>
            <div class="article-body">
                <?php
                if ($getComments->rowCount() == 0) {
                    echo 'Sem comentários no momento';
                } else {
                    echo '<table width="528px">';
                    while ($Comments = $getComments->fetch(2)) {
                        $getUserInfo = db::query("SELECT username,look FROM users WHERE id = ?",$Comments['userid']);
                        $userInfo = $getUserInfo->fetch(2);
                        echo ' 
                  <tr> 
                    <td width="90px" valign="top"> 
                      <div style="float:left"><img src="https://habbo.city/habbo-imaging/avatarimage?figure=' . $userInfo['look'] . '&size=b&direction=2&head_direction=3&gesture=sml&size=m&action=sit"></div>
                      ';
                        echo ' 
                </td> 
                    <td width="427px" valign="top"> 
                      <strong>RE: %news_article_title%</strong><br /><br />' . $Comments['comment'] . ' 
                    </td> 
                  </tr> 
          <tr> 
                    <td width="90px" valign="top"> 
                    </td> 
            <td width="427px" align="right"> 
              <i>Por: <strong><a href="/home/' . $userInfo['username'] . '">' . $userInfo['username'] . '</a></strong> enviado em ' . $Comments['posted_on'] . '</i><br /><br /> 
            </td> 
          </tr>';
                    }
                    if ($pages > 0) {
                        echo "</table> <br><div style='text-align: center;'>Páginas: [";
                        for ($i = 0; $i < $pages; $i++) {
                            if ($i == $pages - 1) {
                                echo "<a href='%www%/articles/{$_GET['rel']}&page=$i'>$i</a>";
                            } else {
                                echo "<a href='%www%/articles/{$_GET['rel']}&page=$i'>$i</a> | ";
                            }
                        }
                        echo "] </div>";
                    } else {
                        echo "</table>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="fb-comments" data-href="%www%" data-num-posts="1" data-width="500"></div>

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>
				