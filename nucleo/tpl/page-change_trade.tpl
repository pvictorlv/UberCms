<style type="text/css">
.Estilo1 {
	color: #009900;
	font-weight: bold;
}
</style>
<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Ajustes de Tradeos</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Listo! tradeos activados! <br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		Error! Te falta rellenar algunos espacios en blanco.<br />
	</div>
	<div>&nbsp;</div>
    <p>
      <?php } ?>
      
      <strong>Tradeos</strong><br>
      <br>
      Cuentas con una contrase&ntilde;a de tradeo</p>
    <h3>Ajustes de los tradeos</h3>
    <br />
    <form action="https://www.habbo.es/profile/securitysettingupdate" method="post" id="securitySettingForm">
      <p>Los tradeos est&aacute;n ahora activos. Para desactivarlos, elige 'Desactivar', confirma tu contrase&ntilde;a de tradeo y guarda los cambios.</p>
      <p> Hola <strong>%habboName%</strong>: tus tradeos estan :<span class="Estilo1"> Activados </span></p>
    </form>
    </div> 

</div> 
</div> 