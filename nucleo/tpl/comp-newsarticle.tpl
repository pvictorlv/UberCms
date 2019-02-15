<?php
$_SESSION['id'] = $users->GetUserVar(USER_ID, 'id'); 
?>
<div class="habblet-container ">        
<div class="cbb clearfix notitle "> 
    
                            
    <div id="article-wrapper"> 
    
        <h2>%news_article_title%</h2> 
        
        <div class="article-meta">
        <?php if ($news_article_id > 0) { ?>
            %news_article_date%
            %news_category%
        <?php } ?> 
        </div> 
        
        <?php if (strlen(trim($news_article_summary)) > 0) { ?>        
        <p class="summary">
        
            %news_article_summary%
        
        </p> 
        <?php } ?>
        
        <div class="article-body"> 
        
            %news_article_body%
        
        </div>
        
        <?php if ($news_article_id > 0) { ?>
        <script type="text/javascript" language="Javascript"> 
            document.observe("dom:loaded", function() {
                $$('.article-images a').each(function(a) {
                    Event.observe(a, 'click', function(e) {
                        Event.stop(e);
                        Overlay.lightbox(a.href, "La imagen está cargando");
                    });
                });
                
                $$('a.article-%news_article_id%').each(function(a) {
                    a.replace(a.innerHTML);
                });
            });
        </script> 
        <?php } ?>

    </div>    
    
</div>
</div>
<?php
if(isset($_POST['post_comment']))
  $posted_on = date("M j, Y g:i A");
 if (! isset($_POST['comment'])) {
  $_POST['comment'] = '';  // nu bestaat de variabele ten minste
}

$comment = FixText($_POST['comment']);
if($comment == NULL){
    $error_message = 'Has dejado un campo vacío.<br /><br />';
  }else{
if (LOGGED_IN)
{
    mysql_query("INSERT INTO site_news_comments (article, userid, comment, posted_on) VALUES ('".$news_article_id."', '".$_SESSION['id']."', '".$comment."', '".$posted_on."');");
    $error_message = 'Has dejado un comentario correctamente.<br /><br />';
  }
}
?> 
<div class="habblet-container "> 
  <div class="cbb clearfix notitle "> 
    <div id="article-wrapper"><h2>Escreva um comentário</h2>
      <div class="article-meta"></div> 
      <div class="article-body">  
        <form action="" method="post"> 
        <textarea name="comment" maxlength="500"></textarea><br /><br /> 
        <input type="submit" name="post_comment" value="Enviar" /> 
        </form>
      </div> 
    </div> 
  </div> 
</div><style type="text/css">
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
$getComments = mysql_query("SELECT * FROM site_news_comments WHERE article = '".$news_article_id."' ORDER by id DESC");
?>
<div class="habblet-container "> 
  <div class="cbb clearfix notitle "> 
    <div id="article-wrapper"><h2>Comentários (<?php echo mysql_num_rows($getComments); ?>)</h2>
      <div class="article-meta"></div> 
      <div class="article-body"> 
        <?php 
        if(mysql_num_rows($getComments) == 0){ 
          echo 'Sem comentários no momento';
        }else{ 
          echo '<table width="528px">'; 
          while($Comments = mysql_fetch_array($getComments)){ 
          $getUserInfo = mysql_query("SELECT * FROM users WHERE id = '".$Comments['userid']."'"); 
          $userInfo = mysql_fetch_array($getUserInfo); 
                  echo ' 
                  <tr> 
                    <td width="90px" valign="top"> 
                      <div style="float:left"><img src="%www%/habbo-imaging/avatarimage.php?figure='.$userInfo['look'].'&size=b&direction=2&head_direction=3&gesture=sml&size=m"></div>
                      '; 
                      if($userInfo['rank'] > 8){ 
                        echo '<div style="position: absolute; z-index:1"><img src="%www%/c_images/album1584/ADM.gif"></div>';
                     }
                 echo ' 
                </td> 
                    <td width="427px" valign="top"> 
                      <strong>RE: %news_article_title%</strong><br /><br />'.$Comments['comment'].' 
                    </td> 
                  </tr> 
          <tr> 
                    <td width="90px" valign="top"> 
                    </td> 
            <td width="427px" align="right"> 
              <i>Por: <strong><a href="/home/'.$userInfo['username'].'">'.$userInfo['username'].'</a></strong> enviado el '.$Comments['posted_on'].'</i><br /><br /> 
            </td> 
          </tr>'; 
          } 
          echo '</table>'; 
        } 
        ?> 
      </div> 
    </div> 
  </div> 
</div>
</div>
<div class="fb-comments" data-href="%www%" data-num-posts="1" data-width="500"></div>

                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
				