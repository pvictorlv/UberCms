<div class="habblet-container ">		
<div class="cbb clearfix white "> 

<h2 class="title">Revisar usuario</h2>

<div class="box-content">
	<p>

 <form action="" method="post">
            
            Usuario: <input name="user" type="text"maxlength="50" /><input name="" type="submit" value="Ver" /></form>
            
            <?php 
			if(isset($_POST['user'])) {
				$usuario=$_POST['user'];
				$usuario= mysql_real_escape_string($usuario);
				?> 
				<hr /> <br />Estadisticas de Busqueda:<br /><br />Usuario: <b><?php echo htmlentities($_POST['user']) ?></b><br />
                Referidos: <b><?php $query = mysql_query("SELECT COUNT(*) AS aantalleden FROM users_referidos WHERE usuario ='".$usuario."' ORDER BY ID") or die(mysql_error()); 
        $data = mysql_fetch_assoc($query); echo $data['aantalleden']; ?></b>
				<?php
				}
			?>
            </p>
			
</div>
	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>