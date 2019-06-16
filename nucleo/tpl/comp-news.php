<div class="habblet-container news-promo">		
	<div class="cbb clearfix notitle "> 				
		<div id="newspromo"> 
		
        <div id="topstories"> 
		<?php
		
		$getNews = db::query("SELECT * FROM site_news ORDER BY `timestamp` DESC LIMIT 3");
		$c = 0;
		
		while ($n = $getNews->fetch(2))
		{
			$disp = 'block';
			if ($c > 0)
			{
				$disp = 'none';
			}
		
	        echo '<div class="topstory" style="background-image: url(' . clean($n['topstory_image']) . '); display: ' . $disp . ';"> 
	            <h4>Últimas Noticias</h4> 
	            <h3><a href="' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '">' . clean($n['title']) . '</a></h3> 
	            <p class="summary"> 
	            ' . clean($n['snippet']) . '
	            </p> 
	            <p> 
	                <a href="' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '">Ler mais</a>
	            </p> 
	        </div>';
			
			$c++;
		}
			
        echo '<div id="topstories-nav" style="display: none"><a href="#" class="prev">Anterior</a><span>1</span> / ' . $c . '<a href="#" class="next">Próxima</a></div>';
		
		?>		
		</div>
		
        <ul class="widelist"> 		
		<?php
		
		$getNews = db::query("SELECT * FROM site_news ORDER BY timestamp DESC LIMIT 3,2");
		$oddEven = "odd";
		
		while ($n = $getNews->fetch(2))
		{		
			if ($oddEven == "odd")
			{
				$oddEven = "even";
			}
			else
			{
				$oddEven = "odd";
			}

            echo '<li class="' . $oddEven . '"> 
                <a href="' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '">' . clean($n['title']) . ' &raquo;</a><div class="newsitem-date">' . clean($n['datestr']) . '</div> 
            </li>';         
		}
		
		?>
		
            <li class="last"><a href="/articles">Mais notícias &raquo;</a></li>
        </ul>
</div> 

<script type="text/javascript"> 
	document.observe("dom:loaded", function() { NewsPromo.init(); });
</script> 
	
						
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 