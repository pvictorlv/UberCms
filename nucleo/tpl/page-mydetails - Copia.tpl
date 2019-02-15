<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Mis ajustes de cuenta</h2> 
<div class="box-content">
<b>Habbo ID</b>          :    %id%<br>
<b>Usuario</b>           :    %username%<br>
<b>Email</b>             :    %mail%<br>
<b>Genero</b>            :    %gender%    (M=Masculino    F=Femenino)<br>  
<b>Fecha de Registro</b> :    %account_created%<br>
<b>Misión</b>            :    %Motto%<br>
<b>Créditos</b>          :    %credits%<br>
<b>Pixeles</b>           :    %activity_points%<br>
<b>Respetos</b>          :    %respect1%<BR>
<b>Última conexión</b>   :    <?php echo date('d-M-Y H:i:s', $users->GetUserVar(USER_ID, 'last_online'));?><br>
</div> 


</div> 
</div> 