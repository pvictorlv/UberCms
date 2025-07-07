<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel']))
{
	db::query("DELETE FROM site_promo WHERE id = '" . intval($_GET['doDel']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Article deleted.');
	}
	
	header("Location: index.php?_cmd=promo&deleteOK");
	exit;
}

if (isset($_GET['doBump']) && is_numeric($_GET['doBump']))
{
	db::query("UPDATE site_promo SET datestr = '" . date('d-M-Y') . "', timestamp = '" . time() . "' WHERE id = '" . intval($_GET['doBump']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Article date bumped.');
	}
	
	header("Location: index.php?_cmd=promo&bumpOK");
	exit;
}

require_once "top.php";

?>		
<div id="icon-edit" class="icon32"><br /></div>

<h2>Administrar promo��es</h2>

<br />

<p>
<img src="images/packi/promo.gif" style="float: right;">
	Aqui voc� pode gerenciar as promo��es do Ibbo Hotel.


	</p>

<br />
<br><br><br><br>
<p>
	<a href="index.php?_cmd=promopublish" class="button-primary">
		<b>
			Escrever Promo��o
		</b>
	</a>
</p>

<br />

<table class="widefat post fixed" >
<thead>
<tr>
	<th scope="col" id="title" class="manage-column column-title" style="width:25px;">ID</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Title</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Topstory snippet</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Category</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Date</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Controls</th>
</tr>
</thead>
<tbody>
<?php

$getNews = db::query("SELECT * FROM site_promo ORDER BY timestamp DESC");
$i = 1;

while ($n = $getNews->fetch(PDO::FETCH_ASSOC)))
{
	$highlight = '#fff';

$oddeven++;
		if(IsEven($oddeven)){ $even = "author-self status-publish iedit"; } else { $even = "alternate author-self status-draft iedit"; }
			echo "<tr class=\"".$even."\">";
			
	
	echo '
	<td>' . $n['id'] . '</td>
	<td>' . clean($n['title']) . '</td>
	<td>' . clean($n['snippet']) . '</td>
	<td>' . clean(->fetchColumn(db::query("SELECT caption FROM site_promo_categories WHERE id = '" . $n['category_id'] . "' LIMIT 1"), 0)) . '</td>
	<td>' . $n['datestr'] . '</td>
	<td>
		<input class="button-secondary" type="button" value="Ver" onclick="document.location = \'' . WWW . '/promo/' . $n['id'] . '-' . $n['seo_link'] . '\';">&nbsp;
		<input class="button-secondary" type="button" value="Deletar" onclick="document.location = \'index.php?_cmd=promo&doDel=' . $n['id'] . '\';">&nbsp;
		<input class="button-secondary" type="button" value="Editar" onclick="document.location = \'index.php?_cmd=promoedit&u=' . $n['id'] . '\';">
		<input class="button-secondary" type="button" value="Mudar a data" onclick="document.location = \'index.php?_cmd=promo&doBump=' . $n['id'] . '\';">&nbsp;
	</td>
	</tr>';
	
	$i++;
}

?>
</tbody>
</table>


<?php

require_once "bottom.php";

?>