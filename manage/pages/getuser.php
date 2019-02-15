<?php

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
	
<div id="icon-users" class="icon32"><br /></div>

<h2>Lista de usuários</h2>
<img src="images/packi/users.gif" style="float: right;">	
<p>

	Lista de usuarios del Hotel
</p>

<br />

<table class="widefat post fixed" >
<thead>
<tr>
	<th scope="col" id="title" class="manage-column column-title" style="width:37px;">ID</th>
	
	<th scope="col" id="title" class="manage-column column-title" style="">Nombre</th>
	<th scope="col" id="title" class="manage-column column-title" style="width:150px;">E-Mail</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Datos de Registro</th>
	<th scope="col" id="title" class="manage-column column-title" style="">Última Conexion</th>
</tr>
</thead>
<?php

$get = dbquery("SELECT * FROM users");

while ($user = mysql_fetch_assoc($get))
{
$oddeven++;
		if(IsEven($oddeven)){ $even = "author-self status-publish iedit"; } else { $even = "alternate author-self status-draft iedit"; }
			echo "<tr class=\"".$even."\">";
	echo '<td>' . $user['id'] . '</td>';
	echo '<td>' . $user['username'] . '</td>';
	echo '<td><a href="mailto:' . $user['mail'] . '">' . $user['mail'] . '</a></td>';
	echo '<td>' . $user['account_created'] . '</td>';
	echo '<td>' . $user['last_online'] . '</td>';

	echo '</tr>';
}

?>
</table>

<?php

require_once "bottom.php";

?>