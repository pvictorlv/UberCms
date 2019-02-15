<?php
require_once('global.php');
$id = FilterText($_GET['id']);
//$query = FilterText($_POST['query']);

?>
<div id="faq-category-content" class="clearfix" >

	<?php if(isset($_GET['id'])){
$sql = mysql_query("SELECT * FROM cms_faq WHERE id = '".$id."' LIMIT 1");
$row = mysql_fetch_assoc($sql);
?>
	<p class="faq-category-description"><?php echo FilterText($row['content']); ?></p>
	<?php
$sql = mysql_query("SELECT * FROM cms_faq WHERE catid = '".$id."' AND type = 'item'");
$i = 0;
	
	while($row = mysql_fetch_assoc($sql)){
	$i++;
	if($i == 1){ $selected = "selected"; } else { $selected = ""; }
	if($i !== 1){ $faqitem = "$(\"faq-item-content-".$row['id']."\").hide();"; }
	?>
	<h4 id="faq-item-header-<?php echo $row['id']; ?>" class="faq-item-header faq-toggle <?php echo $selected; ?>"><span class="faq-toggle <?php echo $selected; ?>" id="faq-header-text-<?php echo $row['id']; ?>"><?php echo $row['title']; ?></span></h4>
	<div id="faq-item-content-<?php echo $row['id']; ?>" class="faq-item-content clearfix">
		<div class="faq-item-content clearfix"><?php echo nl2br($row['content']); ?></div>
		<div class="faq-close-container">
			<div id="faq-close-button-<?php echo $row['id']; ?>" class="faq-close-button clearfix faq-toggle" style="display:none">Cerrar FAQ <img id="faq-close-image-<?php echo $row['id']; ?>" class="faq-toggle" src="/web-gallery/v2/images/faq/close_btn.png"/></div>
		</div>
	</div>
	<script type="text/javascript">
		<?php echo $faqitem; ?>

		$("faq-close-button-<?php echo $row['id']; ?>").show();
	</script>
	<?php }

}elseif(isset($_POST['query'])){
$sql = mysql_query("SELECT * FROM cms_faq WHERE type = 'item' AND title LIKE '%".$query."%' OR content LIKE '%".$query."%'");
$count = mysql_num_rows($sql);
if($count == 0){
	echo $loc['no.search.faq'];
	}else{
	while($itemrow = mysql_fetch_assoc($sql)){
	$sql2 = mysql_query("SELECT * FROM cms_faq WHERE id = '".$itemrow['catid']."' LIMIT 1");
	$catrow = mysql_fetch_assoc($sql2);
	$cat = $catrow['title'];
		echo "<h4 id=\"faq-item-header-".$itemrow['id']."\" class=\"faq-item-header faq-toggle \"><span class=\"faq-toggle \" id=\"faq-header-text-".$itemrow['id']."\">".$itemrow['title']."</span><span class=\"item-category\"> - ".$cat."</span></h4>
	<div id=\"faq-item-content-".$itemrow['id']."\" class=\"faq-item-content clearfix\">
	<div class=\"faq-item-content clearfix\">".nl2br($itemrow['content'])."</div>
<div class=\"faq-close-container\">
	<div id=\"faq-close-button-".$itemrow['id']."\" class=\"faq-close-button clearfix faq-toggle\" style=\"display:none\">".$loc['close.faq']." <img id=\"faq-close-image-".$itemrow['id']."\" class=\"faq-toggle\" src=\"/web-gallery/v2/images/faq/close_btn.png\"/></div>
</div>
</div>

<script type=\"text/javascript\">
	    $(\"faq-item-content-".$itemrow['id']."\").hide();
	    $(\"faq-close-button-".$itemrow['id']."\").show();
	</script>\n";
}
}
}?>

<script type="text/javascript">
	FaqItems.init();
	SearchBoxHelper.init();
</script>
</div>

</div>