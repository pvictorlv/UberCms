<?php
require_once("../global.php");
$sql = "SELECT * FROM user_subscriptions WHERE user_id=" . USER_ID . " AND subscription_id='habbo_vip' ORDER BY activated DESC LIMIT 1";
$result = dbquery($sql);
$row = $result->fetch_assoc();
$userid = USER_ID;
$expiretime = strtotime($row['activated']) + 2678400 * $row['months'];
$daysLeft = 0;
if ($expiretime > time()) {
    $daysLeft = $expiretime - time();
    $daysLeft = round($daysLeft / 86400);
}
if ($daysLeft == '0') {
    $text2 = 'Inscrição VIP não renovada.';
} else {
    $text2 = 'Ainda tem <strong>' . $daysLeft . '</strong> d&#237;as de VIP';
};


$sql2 = "SELECT * FROM user_subscriptions WHERE user_id=" . USER_ID . " AND subscription_id='habbo_club' ORDER BY activated DESC LIMIT 1";
$result2 = dbquery($sql2);
$row2 = $result2->fetch_assoc();
$expiretime = strtotime($row['activated']) + 2678400 * $row['months'];
$daysLeft2 = 0;
if ($expiretime > time()) {
    $daysLeft2 = $expiretime - time();
    $daysLeft2 = round($daysLeft2 / 86400);
    echo $da
}
if ($daysLeft2 == '0') {
    $text1 = 'Inscrição HC não ativada.';
} else {
    $text1 = 'Ainda tem <strong>' . $daysLeft2 . '</strong> d&#237;as de HC';
}


$final = '<div class="hc-buy-buttons" id="hc-buy-buttons">

<form method="post" class="subscribe-form">

   <div class="hc-buy-column-one">
    <div class="cb habboclub-buyentry"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     <div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><h2 class="title rounded-done">
       &#191;HC o VIP?
     </h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div></div></div>
     <div style="padding: 10px 0 0 10px;">' . $text1 . '<br>' . $text2 . '</div>
     <div style="height: 113px; padding: 10px">
       &#191;HC o VIP? Ser HC te da m&#225;s ropas, colers y regales mensuales, por citar algunos beneficios. Pero ser VIP ted a todo lo que puedes conseguir como HC, y mucho m&#225;s
     </div>
    </div></div></div><div class="bb"><div></div></div></div> 
   </div> 
   
  <div class="hc-buy-column-two">
        
     <div class="cb habboclub-buyentry hcbasic"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><h2 class="title rounded-done">
        <img src="/web-gallery/v2/images/club/habboclub_basic_small.png" alt="hc" style="float: left;">
        1 mes
      </h2><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div></div></div>   
            
    <div style="height: 55px;">
     <img src="/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">15</span>           
     <a onclick="habboclub.buttonClick(1, &quot;Confirmar suscripci&#243;n&quot;); return false;" href="#" id="subscribe1" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
        
     <div class="cb habboclub-buyentry hcbasic"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><h2 class="title rounded-done">
        <img src="/web-gallery/v2/images/club/habboclub_basic_small.png" alt="hc" style="float: left;">
        3 meses
      </h2><div style="background-color: rgb(235, 234, 218);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(235, 234, 218);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(182, 177, 120);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(160, 153, 81);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 148, 72);"></div></div></div></div></div></div>   
            
    <div style="height: 55px;">
     <img src="/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">45</span>           
     <a onclick="habboclub.buttonClick(2, &quot;Confirmar suscripci&#243;n&quot;); return false;" href="#" id="subscribe2" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
  </div>   
  
   
  <div class="hc-buy-column-three">
       
     <div class="cb habboclub-buyentry hcvip"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><h2 class="title rounded-done">
        <img src="/web-gallery/v2/images/club/habboclub_vip_small.png" alt="vip" style="float: left;">
        1 mes   
      </h2><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div></div></div>
            
    <div style="height: 55px;">
     <img src="/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">25</span>           
     <a onclick="habboclub.buttonClick(3, &quot;Confirmar suscripci&#243;n&quot;); return false;" href="#" id="subscribe3" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
       
     <div class="cb habboclub-buyentry hcvip"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     
      <div class="rounded-container"><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><h2 class="title rounded-done">
        <img src="/web-gallery/v2/images/club/habboclub_vip_small.png" alt="vip" style="float: left;">
        3 meses   
      </h2><div style="background-color: rgb(223, 223, 223);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(223, 223, 223);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(174, 174, 174);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(155, 155, 155);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(150, 150, 150);"></div></div></div></div></div></div>
            
    <div style="height: 55px;">
     <img src="/web-gallery/v2/images/club/credit_in_white_bg.png" alt="credits" style="position: relative; left: 10px; top: 10px;">   
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">60</span>           
     <a onclick="habboclub.buttonClick(4, &quot;Confirmar suscripci&#243;n&quot;); return false;" href="#" id="subscribe4" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
  </div> 
  
</form>

</div>';
echo $final;
?>