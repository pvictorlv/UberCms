<div class="habblet-container ">		
<div class="cbb clearfix gray "> 

<h2 class="title">Sistema de pago</h2>

<div class="box-content">

	<b><center><form name="pg_frm" method="post" action="http://www.paygol.com/micropayment/paynow_post" >
              <input type="hidden" name="pg_serviceid" value="4362">
              <input type="hidden" name="pg_currency" value="EUR">
              <input type="hidden" name="pg_name" value="EL NOMBRE POR EJEMPLO TU HOTEL VIP">
              <input type="hidden" name="pg_custom" value="<?php echo USER_ID ?>">
              <!-- With Dropdown -->
              <select name="pg_price">
                <option value="4">1 Mes &euro;3</option>
                <option value="5">2 Meses &euro;5</option>
                <option value="6">3 Meses &euro;7</option>
                <option value="9">6 meses &euro;9</option>
                <option value="10">1 a&ntilde;o &euro;10</option>
              </select>
              <br>
              <input type="hidden" name="pg_return_url" value="http://localhost:8080/onlyvip.php/exito">
              <input type="hidden" name="pg_cancel_url" value="http://localhost:8080/onlyvip.php">
              <input type="submit" name="pg_button" class="buttonv4" border="0" alt="Realiza pagos con PayGol: la forma m&aacute;s f&aacute;cil!" title="Realiza pagos con PayGol: la forma m&aacute;s f&aacute;cil!" onClick="pg_reDirect(this.form)" value="Comprar">
          </form></center></b>

</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
