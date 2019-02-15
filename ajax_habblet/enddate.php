<?php
session_start();
require_once("../global.php");
$sql   = "SELECT id FROM users WHERE id='".USER_ID."'";
$result= mysql_query($sql);
$row 	 = mysql_fetch_assoc($result); 
$userid = $row[id];
$sql   = "SELECT timestamp_expire FROM user_subscriptions WHERE user_id=".USER_ID." AND subscription_id='habbo_vip' ORDER BY timestamp_expire DESC LIMIT 1";
$result= mysql_query($sql);
$row 	 = mysql_fetch_assoc($result); 
$expiretime = $row[timestamp_expire];
$daysLeft = 0;
if ( $expiretime>time() ){
  $daysLeft = $expiretime - time();
  $daysLeft = round($daysLeft/86400);
}

if($users->getClubDays(USER_ID) == '0'){ $text = 'Suscripción HC no activada.';
}else{ $text = 'Te quedan '.$users->getClubDays(USER_ID).' d&#237;as de HC';}; 
if($daysLeft == '0'){ $text2 = 'Suscripción VIP no activada.';}else{ $text2 = 'Te quedan '.$daysLeft.' d&#237;as de VIP';};

$final = '<div class="hc-buy-buttons" id="hc-buy-buttons">

<form method="post" class="subscribe-form">

   <div class="hc-buy-column-one">
    <div class="cb habboclub-buyentry"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     <div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><h2 class="title rounded-done">
       &#191;HC o VIP?
     </h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div></div></div>
     <div style="padding: 10px 0 0 10px;">
     '.$text.'<br>'.$text2.'   

     </div>
     <div style="height: 113px; padding: 10px">
       &#191;HC o VIP? Ser HC te da m&#225;s ropas, colers y regales mensuales, por citar algunos beneficios. Pero ser VIP ted a todo lo que puedes conseguir como HC, y mucho m&#225;s
     </div>
    </div></div></div><div class="bb"><div></div></div></div> 
   </div> 
   
  <div class="hc-buy-column-two">
        
     <div class="cb habboclub-buyentry hcbasic"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><h2 class="title rounded-done">
        <img src="%www%/web-gallery/v2/images/club/habboclub_basic_small.png" alt="hc" style="float: left;">
        1 mes
      </h2><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div></div></div>   
            
    <div style="height: 55px;">
     <img src="%www%/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">15</span>           
     <a onclick="habboclub.buttonClick(1, &quot;Confirmar suscripción&quot;); return false;" href="#" id="subscribe1" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
        
     <div class="cb habboclub-buyentry hcbasic"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><h2 class="title rounded-done">
        <img src="%www%/web-gallery/v2/images/club/habboclub_basic_small.png" alt="hc" style="float: left;">
        3 meses
      </h2><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div></div></div>   
            
    <div style="height: 55px;">
     <img src="%www%/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">45</span>           
     <a onclick="habboclub.buttonClick(2, &quot;Confirmar suscripción&quot;); return false;" href="#" id="subscribe2" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
  </div>   
  
   
  <div class="hc-buy-column-three">
       
     <div class="cb habboclub-buyentry hcvip"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><h2 class="title rounded-done">
        <img src="%www%/web-gallery/v2/images/club/habboclub_vip_small.png" alt="vip" style="float: left;">
        1 mes   
      </h2><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div></div></div>
            
    <div style="height: 55px;">
     <img src="%www%/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">30</span>           
     <a onclick="habboclub.buttonClick(3, &quot;Confirmar suscripción&quot;); return false;" href="#" id="subscribe3" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
       
     <div class="cb habboclub-buyentry hcvip"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><h2 class="title rounded-done">
        <img src="%www%/web-gallery/v2/images/club/habboclub_vip_small.png" alt="vip" style="float: left;">
        3 meses   
      </h2><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div></div></div>
            
    <div style="height: 55px;">
     <img src="%www%/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">50</span>           
     <a onclick="habboclub.buttonClick(4, &quot;Confirmar suscripción&quot;); return false;" href="#" id="subscribe4" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
  </div> 
  
</form>

</div>
';return $final;
?>