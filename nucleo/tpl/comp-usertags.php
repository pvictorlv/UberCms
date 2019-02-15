<div class="habblet-container ">		
						<div class="cbb clearfix green "> 
<div class="box-tabs-container clearfix"> 
    <h2>Etiquetas</h2>
    <ul class="box-tabs"> 
        <li id="tab-1-6-1"><a href="#">
Top Etiquetas</a><span class="tab-spacer"></span></li>
        <li id="tab-1-6-2" class="selected"><a href="#">Etiquetas</a><span class="tab-spacer"></span></li>
    </ul> 
</div> 
    <div id="tab-1-6-1-content"  style="display: none"> 
    		<div class="progressbar"><img src="%www%/web-gallery/images/progress_bubbles.gif" alt="" width="29" height="6" /></div> 
    		<a href="/habblet/proxy?hid=h22" class="tab-ajax"></a> 
    </div> 
    <div id="tab-1-6-2-content" > 
    
	<?php
	
	$tags = uberUsers::GetUserTags(USER_ID);
	$tagCount = count($tags);
	
	if ($tagCount == 0)
	{
		echo '<div id="my-tag-info" class="habblet-content-info">
	Você ainda não tem etiquetas, responda as peguntas abaixo ou adicione uma que você preferir</div>';
	}
	elseif ($tagCount > 20)
	{
		echo '<div id="my-tag-info" class="habblet-content-info">Limite de etiquetas alcançado, remova alguma antes de continuar!</div>';
	}
		 
	?>

	
<div class="box-content"> 
<?php

include "comp-taglist.php";

?>
</div> 
 
</div> 
</div> 

<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>