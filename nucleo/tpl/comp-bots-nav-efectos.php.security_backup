<div class="habblet-container ">		
<div class="cbb clearfix green "> 
<h2 class="title">Tus Efectos Para BOT</h2>
<div class="box-content">
Recuerda Que solo se Pueden usar en BOT`S.
<table width="250" border="0" cellpadding="0" cellspacing="1" align="left">

<tr>         
<td><b>Efecto</b></td>
            <td><b>Nombre</b></td>
            <td><b>ID del Efecto</b></td>
        </tr>
<?php $query = mysql_query("SELECT * FROM bots_effects WHERE user_id ='".USER_ID."'");
while ($data = mysql_fetch_array($query)){ ?>
<tr>
            <td><img src="<?php echo $data['imagen'] ?>"></td> 
            <td><?php echo $data['nombre'] ?></td>
            <td><?php echo $data['effect'] ?></td>
        </tr>

<?php } ?></table>

</div></div></div>



<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>