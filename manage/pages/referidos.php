<?php
/*=======================================================================
| Agradecimiento a Juli0san por hacer SOLO ESTA PÁGINA, lo demás hecho por masacre10 
| Aporte para kekomundo ~ Gracias por no hacerme querer dar más aportes km!
| masacre_11@hotmail.com
\======================================================================*/
$pagename= "Referidos";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<h3><?php echo $pagename; ?></h3>

<p>Aquí se muestranlos referidos hechos por los usuarios, si se encuentra una IP repetida muchas veces 
<br/>avísa rápidamente al Dueño.</p>

<?php
{
	echo '<form method="post">
	<input type="text" value="Buscar..." style="font-size: 150%;" size="50" onclick="if(this.value==\'Search..\'){this.value=\'\';}" name="search-query">
	</form><Br />';

	if (!isset($_POST['search-query']) && isset($_GET['sq']))
	{
		$_POST['search-query'] = $_GET['sq'];
	}

	if (isset($_POST['search-query']))
	{
		$_POST['search-query'] = filter($_POST['search-query']);

		$getPages = dbquery("SELECT * FROM users_referidos WHERE usuario LIKE '%" . $_POST['search-query'] . "%' OR ip_referida = '" . $_POST['search-query'] . "' ORDER BY ip_referida ASC");					



		echo '<table width="100%" border="1">
<thead>
	  <td><strong><img src="http://i53.tinypic.com/25648y8.gif" width="16" height="16" /></strong> ID</td>
	    <td><strong><strong><img src="http://i54.tinypic.com/1109oir.gif" width="15" height="15" /></strong></strong> Usuario</td>
	    <td><strong><img src="http://i54.tinypic.com/2ql5opz.gif" width="17" height="17" /></strong> IP del referido</td>
</thead>';

		while ($page = mysql_fetch_assoc($getPages))
		{
	echo '<tr>';
	echo '<td>' . $page['id'] . '</td>';
	echo '<td>' . $page['usuario'] . '</td>';
	echo '<td><a href="admin.php?_cmd=iptool&ip=' . $page['ip_referida'] . '" target="_blank">' . $page['ip_referida'] . '</a></td>';
	echo '</tr>';
		}
		
		echo '</table><br />';
	}
	else
	{
		echo '<b>Ingresa un habbo nombre, la IP que buscas o haz click en mostrar todos.</b><br />';
	}
}
?>

<br><br>

<input class="boton" value="Mostrar Todos" onclick="if(this.parentNode.getElementsByTagName('div')[0].style.display != ''){this.parentNode.getElementsByTagName('div')[0].style.display = '';this.value = 'Ocultar';}else{this.parentNode.getElementsByTagName('div')[0].style.display = 'none'; this.value = 'Mostrar Todos';}" type="button" /><br />
<br /><div style="display: none;">
<table width="100%" border="1">
<thead>
	  <td><strong><img src="http://i53.tinypic.com/25648y8.gif" width="16" height="16" /></strong> ID</td>
	    <td><strong><strong><img src="http://i54.tinypic.com/1109oir.gif" width="15" height="15" /></strong></strong> Usuario</td>
	    <td><strong><img src="http://i54.tinypic.com/2ql5opz.gif" width="17" height="17" /></strong> IP del referido</td>
</thead>
<?php

$get = dbquery("SELECT * FROM users_referidos ORDER BY ip_referida ASC");

while ($user = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<td>' . $user['id'] . '</td>';
	echo '<td>' . $user['usuario'] . '</td>';
	echo '<td><a href="admin.php?_cmd=iptool&ip=' . $user['ip_referida'] . '" target="_blank">' . $user['ip_referida'] . '</a></td>';
	echo '</tr>';
}

?>
</table>
</div>
<?php

require_once "bottom.php";

?>