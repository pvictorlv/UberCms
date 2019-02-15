				<div class="habblet-container ">		
						<div class="cbb clearfix blue ">
<div class="box-tabs-container clearfix">
    <h2>Grupos</h2>
    <ul class="box-tabs">
        <li id="tab-0-0-2" class="selected"><a href="#">Top Grupos</a><span class="tab-spacer"></span></li>
    </ul>
</div>
    <div id="tab-0-0-2-content" >
<div id="hotgroups-habblet-list-container" class="habblet-list-container groups-list">
    <ul class="habblet-list two-cols clearfix">
<?php
$i = 0;
$j = 1;

$getem = mysql_query("SELECT * FROM groups_details ORDER BY views DESC LIMIT 10") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem))
{
	$i++;

	if(IsEven($i))
		$left = "right";
	else
	{
		$left = "left";
		$j++;
	}
		
	if(IsEven($j) == "even")
		$even = "even";
	else
		$even = "odd";
?>
		<li style="background-image: url(/habbo-imaging/badge.php?badge=<?php echo $row['badge']; ?>);" class="<?php echo $even; ?> <?php echo $left; ?>">
                <a href="/groups/<?php echo $row['id']; ?>/id" class="item"><span class="index"><?php echo $i; ?>.</span> <?php echo FixText($row['name']); ?></a>
           </li>
		<?php } ?>
</ul>
    <div id="hotgroups-list-hidden-h111" style="display: none">
    <ul class="habblet-list two-cols clearfix">
<?php
$i = 10;
$j = 1;
$getem = mysql_query("SELECT * FROM groups_details ORDER BY views DESC LIMIT 40 OFFSET 10") or die(mysql_error());

while ($row = mysql_fetch_assoc($getem))
{
	$i++;

	if(IsEven($i) == "even")
		$left = "right";
	else
	{
		$left = "left";
		$j++;
	}
		
	if(IsEven($j) == "even")
		$even = "even";
	else
		$even = "odd";
?>
			<li style="background-image: url(%www%/habbo-imaging/badge.php?badge=<?php echo $row['badge']; ?>);" class="<?php echo $even; ?> <?php echo $left; ?>">
                <a href="/groups/<?php echo $row['id']; ?>/id" class="item"><span class="index"><?php echo $i; ?>.</span> <?php echo FixText($row['name']); ?></a>
           </li>
<?php } ?>
</ul>
</div>
    <div class="clearfix">
        <a href="#" class="hotgroups-toggle-more-data secondary" id="hotgroups-toggle-more-data-h111">Mostrar mais Grupos</a>
    </div>
<script type="text/javascript">
L10N.put("show.more.groups", "Mostrar mais Grupos");
L10N.put("show.less.groups", "Mostrar menos Grupos");
var hotGroupsMoreDataHelper = new MoreDataHelper("hotgroups-toggle-more-data-h111", "hotgroups-list-hidden-h111","groups");
</script>
</div>
</div>				
</div>				