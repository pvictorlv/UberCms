<?php
if(!defined("NOWHOS"))
{
	define("NOWHOS", TRUE);
}
if(!defined("Xukys"))
{
	define("Xukys", TRUE);
}
require '../global.php';


	
$user_id = USER_ID;	
if(isset($_POST['pageNumber']) && isset($_POST['widgetId']))
{
	$page = $gtfo->cleanWord($_POST['pageNumber']);
	$widgetId = $gtfo->cleanWord($_POST['widgetId']);
	$reqacc = $gtfo->cleanWord($_POST['_mypage_requested_account']);
	
	$data = mysql_fetch_array(dbquery("SELECT home_id FROM homes_items WHERE id = '".$widgetId."' LIMIT 1"));
	$user_id = $data['home_id'];
	
	$count = mysql_num_rows(mysql_query("SELECT DISTINCT(badge_id) FROM user_badges WHERE user_id = '".$user_id."'"));
	$n = $count;
	$x = 0;
		while($n >= 0)
		{
			$n = $n-16;
			$x++;
		}

		switch($page)
		{
			case 1:
				$limit = 0;
				break;
			case 2:
				$limit = 16;
				break;
			case 3:
				$limit = 32;
				break;
			case 4:
				$limit = 48;
				break;
			case 5:
				$limit = 64;
				break;
			case 6:
				$limit = 80;
				break;
			case 7:
				$limit = 96;
				break;
			case 8:
				$limit = 112;
				break;
			default:
				$limit = 0;
				break;
		}

	$sql = mysql_query("SELECT DISTINCT(badge_id) FROM user_badges WHERE user_id = '".$user_id."' LIMIT ".$limit.",16");
	$desde = $limit;
	$hasta = mysql_num_rows($sql) + $limit;
?>
  <ul class="clearfix" style="height: 180px; ">
	<?php
	while($data = mysql_fetch_array($sql))
	{
	?>
            <li style="background-image: url(http://images.xukys-hotel.com/c_images/album1584/<?php echo $data['badge_id']; ?>.gif)"></li>
			<?php
			}//Termina while
	?>
    </ul>

        <div id="badge-list-paging">
        <?php echo $desde; ?> - <?php echo $hasta; ?> / <?php echo $count; ?>
        <br>
		<?php
		if($count >= '17')
		{
		
		if($page != 1){ echo '<a href="#" id="badge-list-search-first">'; } ?>Primero<?php if($page != 1){ echo '</a>'; } ?> |
        <?php if($page != 1){ echo '<a href="#" id="badge-list-search-previous">'; } ?>&lt;&lt; <?php if($page != 1){ echo '</a>'; } ?> |
        <?php if($page != $x){ echo '<a href="#" id="badge-list-search-next">'; } ?>&gt;&gt;<?php if($page != $x){ echo '</a>'; } ?> |
        <?php if($page != $x){ echo '<a href="#" id="badge-list-search-last">'; } ?>Último<?php if($page != $x){ echo '</a>'; } ?>
		<input type="hidden" id="badgeListPageNumber" value="<?php echo $page; ?>">
        <input type="hidden" id="badgeListTotalPages" value="<?php echo $x; ?>">
		<?php
		}
		?>
        </div>
		<?php
		}
		?>