<?php
if(isset($_POST['submit'])) {
                 $query = mysql_query("UPDATE users SET credits='100' WHERE id='".USER_ID."' LIMIT 100000;");
        if($query) {
                echo "Has ganado 100 creditos. Si quieres mas haz mas clicks.";
        }
        else {
                echo "Error :(";
        }
}
?>


<div class="habblet-container ">
<div class="cbb clearfix green ">

<h2 class="title">Adf</h2>

<div id="hotcampaigns-habblet-list-container">
<font color="black" face="arial"><b><u>Que es esto:</u></b> Este add-on sirve para que ganes creditos, rares, pixeles, etc totalmente gratis. Lo unico que tienes que hacer es clicks en los siguientes links:</font>
<br><br>
Links:
<br>
<form method="post" action="http://adf.ly/55vxl">
<input type="submit" name="submit" value="Link 1">
</form>

<form method="post" action="http://adf.ly/55vxl">
<input type="submit" name="submit" value="Link 2">
</form>

<form method="post" action="http://adf.ly/55vxl">
<input type="submit" name="submit" value="Link 3">
</form>

<font color="black" face="arial"><b><u>Cuanto gano:</u></b> Con cada click que hagas ganaras 100 creditos. Si haces 100 clicks ganaras 1.000.000 de creditos.</font>

</div>
</div>
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>