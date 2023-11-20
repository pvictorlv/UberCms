<div class="habblet-container ">
  <div class="cbb clearfix default ">
    <h2 class="title">YoSoys populares</h2>
    
<div id="tag-related-habblet-container" class="habblet box-contents"> 
    
    <?php

$get = db::query("SELECT tag, COUNT(id) AS quantity FROM users_tags GROUP BY tag ORDER BY quantity DESC LIMIT 20");

if (mysql_num_rows($get) > 0)
{
	echo '<ul class="tag-list">';
	
	$tagsArray = Array();
	
	while ($row = mysql_fetch_assoc($get))
	{
		$tagsArray[$row['tag']] = $row['quantity'];
	}
	
	$spread = ( max(array_values($tagsArray)) - min(array_values($tagsArray)) );
	
	if ($spread <= 0)
	{
		$spread = 1;
	}
	
	$step = 100 / $spread;
	
	shuffle_assoc($tagsArray);
	
	foreach ($tagsArray as $key => $value)
	{
		$size = ceil(100 + (($value - min(array_values($tagsArray))) * $step));
		echo '<li><a href="tag/' . $key . '" style="font-size: ' . $size . '%;">' . $key . '</a> </li>';
	}
	
	echo '</ul>';
}
else
{
	echo "No hay 'YoSoys' para mostrar.";
}

?>
</div> 


  </div>
</div>
