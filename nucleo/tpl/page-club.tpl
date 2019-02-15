<?php

$sql = "SELECT * FROM users WHERE id='".USER_ID."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result); 
$userid = $row['id'];
$sql = "SELECT * FROM user_subscriptions WHERE user_id=".USER_ID." AND subscription_id='habbo_vip' ORDER BY timestamp_expire DESC LIMIT 1";
$result= mysql_query($sql);
$row 	 = mysql_fetch_assoc($result); 
$expiretime = $row['timestamp_expire'];
$daysLeft = 0;
if ( $expiretime>time() ){
  $daysLeft = $expiretime - time();
  $daysLeft = round($daysLeft/86400);
}
if($daysLeft == '0'){ $text2 = 'Suscripci&#243;n VIP no activada.';}else{ $text2 = 'Te quedan <strong>'.$daysLeft.'</strong> d&#237;as de VIP';};




$sql2 = "SELECT * FROM user_subscriptions WHERE user_id=".USER_ID." AND subscription_id='habbo_club' ORDER BY timestamp_expire DESC LIMIT 1";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_assoc($result2);
$expiretime2 = $row2['timestamp_expire'];
$daysLeft2 = 0;
if ( $expiretime2>time() ){
  $daysLeft2 = $expiretime2 - time();
  $daysLeft2 = round($daysLeft2/86400);
}
if($daysLeft2 == '0'){ $text1 = 'Suscripci&#243;n HC no activada.';}else{ $text1 = 'Te quedan <strong>'.$daysLeft2.'</strong> d&#237;as de HC';};

?>

<style type="text/css">

/* Habboclub red tabs */

div.hcred div.box-tabs-container h2 {
	color: #7a7a7a;
}

div.hcred ul.box-tabs {
	border-bottom-color: #7a7a7a;
}

div.hcred ul.box-tabs li strong,
div.hcred ul.box-tabs li a {
	background-position: -16px -175px;
}

div.hcred ul.box-tabs li span.tab-spacer {
	background-position: -12px -175px;
}

div.hcred ul.box-tabs li.selected strong,
div.hcred ul.box-tabs li.selected a {
	background-position: -16px -150px;
}

div.hcred ul.box-tabs li.selected span.tab-spacer {
	background-position: -12px -150px;
}

div.hcred ul.box-tabs li:hover a {
	background-position: -16px -200px;
}
div.hcred ul.box-tabs li:hover span.tab-spacer {
	background-position: -12px -200px;
}

div.hcred ul.box-tabs li.selected:hover a {
	background-position: -16px -150px;
}
div.hcred ul.box-tabs li.selected:hover span.tab-spacer {
	background-position: -12px -150px;
}

.habboclub-buyentry {
  width: 245px;
  color: #444444;
}

.habboclub-infoentry {
  width: 245px;
}

#hc-buy-container {
  position: relative;
  left: 4px;
  top: 5px;
}

div.hc-buy-buttons {
    background-color: #ffffff;
}

#hc-buy-container p.credits-notice {
    color: #fff;
}

#habboclub-info h3.heading {
    font-size: 12px;
	color: #cf9c44;

}

#habboclub-info p.read-more a {
    font-weight: bold;
	color: #fc6204;
	text-decoration: none;
}

#habboclub-info p.read-more a:hover {
    text-decoration: underline;
}

#content .cbb.hcvip { background: #dfdfdf; }
#content .cb.hcvip { background: transparent; }
#content .hcvip .bt { background-image: url(../images/box_vip.png); }
#content .hcvip .bt div { background-image: url(../images/box_vip.png); }
#content .hcvip .bb { background-image: url(../images/box_vip.png); }
#content .hcvip .bb div { background-image: url(../images/box_vip.png); }
#content .hcvip .i3 { background-color: #dfdfdf;}

#content .cbb.hcbasic { background: #ebeada; }
#content .cb.hcbasic { background: transparent; }
#content .hcbasic .bt { background-image: url(../images/box_hc.png); }
#content .hcbasic .bt div { background-image: url(../images/box_hc.png); }
#content .hcbasic .bb { background-image: url(../images/box_hc.png); }
#content .hcbasic .bb div { background-image: url(../images/box_hc.png); }
#content .hcbasic .i3 { background-color: #ebeada;}

#content .cbb.hcnone { background: #dde4e9; }
#content .cb.hcnone { background: transparent; }
#content .hcnone .bt { background-image: url(../images/box_free.png); }
#content .hcnone .bt div { background-image: url(../images/box_free.png); }
#content .hcnone .bb { background-image: url(../images/box_free.png); }
#content .hcnone .bb div { background-image: url(../images/box_free.png); }
#content .hcnone .i3 { background-color: #dde4e9;}


</style>

<link rel="stylesheet" href="%www%/web-gallery/v2/styles/habboclub.css" type="text/css" />
	     		
				<div class="habblet-container ">		
						<div class="cbb clearfix hcred ">
	
							<h2 class="title">Compara Los Beneficios
							</h2>
						<div id="habboclub-info" class="box-content" style="position: relative; top: 3px; left: -11px">
 <table cellspacing="0" cellpadding="0">
  <tr>
   <td valign="top">
  <div class="cbb hcnone habboclub-infoentry" style="height: 214px;">
   <h2 class="title" style="height: 53px; background-color: #90a7b7;">

    <span style="position: relative; top: 18px; font-weight: bold">CUALQUIERA Y GRATIS</span>
   </h2> 
   <div style="height: 3px"></div>
   <div class="rounded" style="background-color: #ffffff;">
    Look Básico
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/clothes_b.png" />
  </div> 
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 83px;">
   <div class="rounded" style="background-color: #ffffff;">

    Colores básicos
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/colors_b.png" />
  </div> 
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 101px;">
   <div class="rounded" style="background-color: #ffffff;">
    Ropa y pelo de 2 colores que puedes mezclar
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/multicolor_b.png" />
  </div> 
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 185px;">   
  </div> 
  
  <div class="cbb hcnone habboclub-infoentry">

   <div class="rounded" style="background-color: #ffffff;">
    Lista de Amigos con capacidad para 200
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/friends_b.png" />
  </div>
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 136px;">   
  </div>  
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 75px;">   
   <div class="rounded" style="background-color: #ffffff;">
    12 diseños de Salas
   </div>

  </div> 
  
  <div class="cbb hcnone habboclub-infoentry" style="height: 104px;"> <br/><br/><br/> <br/><br/> <br/><br/><br/><br/><br/>
  </div>  
  
  <div class="cbb hcnone habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">
    1 baile
   </div>
  </div>  
  
  <div class="cbb hcnone habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">
    Ofertas en el Mercadillo
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/coin_offers.png" />

   <div style="position: relative; top: 13px; left: -2px">
    = 5 ofertas x 1 Crédito
   </div>
  </div>  
  
  </td><td valign="top">
  
  <div class="cbb hcbasic habboclub-infoentry">
   <h2 class="title" style="height: 53px; background-color: #9b9448;">
    <img style="position: relative; top: 5px" alt="xx" src="%www%/web-gallery/images/habboclub_basic_big.png" />
   </h2> 
   <div style="height: 3px"></div>

   <div class="rounded" style="background-color: #ffffff;">
    Looks HC
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/clothes_hc.png" />
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" style="height: 83px;">
   <div class="rounded" style="background-color: #ffffff;">
    Colores HC
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/colors_hc.png" />

  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" style="height: 101px;">
   <div class="rounded" style="background-color: #ffffff;">
    Ropa y pelo de 2 colores que puedes mezclar
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/multicolor_hc.png" />
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">
    Armario para guardar 5 conjuntos
   </div>

  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" style="height: 135px;">
   <div class="rounded" style="background-color: #ffffff;">
    1 Furni HC de regalo al mes, exclusivo HC
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/furni_hc.png" />
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">
    Lista de Amigos con capacidad para 600
   </div>

   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/friends_hc.png" />
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">
    Placa HC
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/badge_hc.png" />
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" >
   <div class="rounded" style="background-color: #ffffff;">

    Prioridad para entrar en Salas
   </div>
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" style="height: 75px;">   
   <div class="rounded" style="background-color: #ffffff;">
    + 8 diseños HC
   </div>
   <div style="padding: 10px">Salas con escaleras</div>
  </div>  
  
  <div class="cbb hcbasic habboclub-infoentry">   
   <div class="rounded" style="background-color: #ffffff;">

    Comandos
   </div>
   <div style="padding: 5px;">
    <b>:furni</b> - muestra Furni<br/>
    <b>:chooser</b> - muestra los usuarios<br/>
<br/><br/><br/>
   </div>
  </div> 
  
  <div class="cbb hcbasic habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">

    4 Bailes HC
   </div>
  </div>   
  
  <div class="cbb hcbasic habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">
    Ofertas en el Mercadillo
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/coin_offers.png" />
   <div style="position: relative; top: 13px; left: -2px">
    = 5 ofertas x 1 Crédito
   </div>

  </div>   
  
  </td><td valign="top">
 
  <div class="cbb hcvip habboclub-infoentry">
   <h2 class="title" style="height: 53px; background-color: #969696;">
    <img style="position: relative; top: 5px" alt="xx" src="%www%/web-gallery/images/habboclub_vip_big.png" />
   </h2> 
   <div style="height: 3px"></div>
   <div class="rounded" style="background-color: #ffffff;">
    Looks HC + VIP
   </div>

   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/clothes_vip.png" />
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">
    Colores HC + VIP
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/colors_vip.png" />
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry" style="height: 101px;">
   <div class="rounded" style="background-color: #ffffff;">

    Ropa y pelo de 2 colores que puedes mezclar
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/multicolor.png" />
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry" >
   <div class="rounded" style="background-color: #ffffff;">
    Armario para guarder 10 conjuntos
   </div>
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">

    2 Furni VIP de regalo al mes, uno exclusivo HC + otro de la edición VIP
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/furni_vip.png" />
  </div> 
  
   <div class="cbb hcvip habboclub-infoentry">
   <div class="rounded" style="background-color: #ffffff;">
    Lista de Amigos con capacidad para 900
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/friends_vip.png" />
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry">

   <div class="rounded" style="background-color: #ffffff;">
    Placas HC + VIP
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/badge_vip.png" />
  </div>
  
  <div class="cbb hcvip habboclub-infoentry" >
   <div class="rounded" style="background-color: #ffffff;">
    Prioridad para entrar en Salas
   </div>
  </div> 
  
  <div class="cbb hcvip habboclub-infoentry">   
   <div class="rounded" style="background-color: #ffffff;">

    + 8 diseños HC + 6 diseños VIP
   </div>
   <div style="padding: 10px">
     Salas con escaleras<br/>
     Salas sin paredes
   </div>
  </div>   
  
  <div class="cbb hcvip habboclub-infoentry">   
   <div class="rounded" style="background-color: #ffffff;">
    Comandos
   </div>

   <div style="padding: 5px;">
    <b>:furni</b> - muestra Furni<br/>
    <b>:chooser</b> - muestra los usuarios<br/>
	<b>:moonwalk</b> - andas al revés<br/>
	<b>:mimic</b> - copias el look de otro<br/>
	<b>:flagme</b> - cambias tu nombre<br/>
   </div>
  </div>   
  
  <div class="cbb hcvip habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">
    4 Bailes HC
   </div>

  </div>  
  
  <div class="cbb hcvip habboclub-infoentry" >   
   <div class="rounded" style="background-color: #ffffff;">
    Ofertas en el Mercadillo
   </div>
   <img style="float: left; padding: 10px;" alt="xx" src="%www%/web-gallery/v2/images/newhc/coin_offers.png" />
   <div style="position: relative; top: 13px; left: -2px">
    = 10 ofertas x 1 Crédito
   </div>
  </div>  
  
   </td> 
  </tr>

 </table>
</div>
	
						
					</div>
				</div>
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
			 

</div>