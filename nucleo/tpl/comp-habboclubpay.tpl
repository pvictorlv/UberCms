<?php
//Get id of user
$sql   = "SELECT id FROM users WHERE id='".USER_ID."'";
//echo $sql;
$result= mysql_query($sql);
$row 	 = mysql_fetch_assoc($result); 

//Get user_id
$userid = USER_ID;

//Get the timestamp expire of user
$sql   = "SELECT timestamp_expire FROM user_subscriptions WHERE user_id=".USER_ID." AND subscription_id='habbo_vip' ORDER BY timestamp_expire DESC LIMIT 1";
$result= mysql_query($sql);
$row 	 = mysql_fetch_assoc($result); 

//user id
$expiretime = $row[timestamp_expire];

//Get days left
$daysLeft = 0;
if ( $expiretime>time() ){
  $daysLeft = $expiretime - time();
//echo "<br>1" . $daysLeft;
  $daysLeft = round($daysLeft/86400);
//echo "<br>2" . $daysLeft;
}
?>

  <script>var habboclub={closeSubscriptionWindow:function(a){if(a){Event.stop(a)}if($("subscription_dialog")){Element.remove("subscription_dialog")}if($("subscription_result")){Element.remove("subscription_result")}Overlay.hide()},showSubscriptionResultWindow:function(a,b){Element.wait($("hc_confirm_box"));var c={optionNumber:a};
if(!!$("settings-gender")){c.newGender=$F("settings-gender")}if(!!$("settings-figure")){c.figureData=$F("settings-figure")}new Ajax.Request(habboReqPath+"/habblet/habboclub_subscribe.php",{method:"post",parameters:c,onComplete:function(e,d){if(d!=null){var h=d.daysLeft;var f=$$("#clubdaysleft a")[0];if(f){f.innerHTML=""+h
}if($("clubdaysleft")){$("clubdaysleft").show()}if($("joinclub")){$("joinclub").hide()}}if($("subscription_dialog")){Element.remove("subscription_dialog")}habboclub.updateMembership();var g=Dialog.createDialog("subscription_result",b,"9003",0,-1000,habboclub.closeSubscriptionWindow);Dialog.appendDialogBody(g,e.responseText,true);
Dialog.moveDialogToCenter(g)}})},catalogUpdate:function(b,a){new Ajax.Request(habboReqPath+"/habblet/habboclub_gift.php",{method:"post",parameters:"month="+encodeURIComponent(b)+"&catalogpage="+encodeURIComponent(a),onComplete:function(d,c){($("hc-gift-catalog")).innerHTML=d.responseText}});return false
},updateMembership:function(){new Ajax.Request(habboReqPath+"/habblet/habboclub_enddate.php",{method:"get",onComplete:habboclub._updateMembershipCallback})},buttonClick:function(c,a){var b=Dialog.createDialog("subscription_dialog",a,9001,0,-1000,habboclub.closeSubscriptionWindow);Dialog.setAsWaitDialog();
Dialog.moveDialogToCenter(b);Overlay.show();var d={optionNumber:c};if(!!$("settings-gender")){d.newGender=$F("settings-gender")}if(!!$("settings-figure")){d.figureData=$F("settings-figure")}new Ajax.Request(habboReqPath+"/habblet/habboclub_confirm.php",{method:"post",parameters:d,onComplete:function(f,e){Dialog.setDialogBody(b,f.responseText)
}});return false},_updateMembershipCallback:function(b,a){$("hc-buy-container").innerHTML=b.responseText;Rounder.init()}};</script>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/habboclub.css" type="text/css" />
<div class="habblet-container ">		
						<div class="cb clearfix hcred "><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
	
							<div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(153, 153, 153);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(153, 153, 153);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div></div><h2 class="title rounded-done">Únete al Habbo Club
							</h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(153, 153, 153);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(153, 153, 153);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(113, 113, 113);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(103, 103, 103);"></div></div></div></div></div></div>
						<div id="hc-habblet box-content">
    <div id="hc-buy-container">
<div class="hc-buy-buttons" id="hc-buy-buttons">

<form method="post" class="subscribe-form">

   <div class="hc-buy-column-one">
    <div class="cb habboclub-buyentry"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
     <div class="rounded-container"><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><h2 class="title rounded-done">
       ¿HC o VIP?
     </h2><div style="background-color: rgb(255, 255, 255);"><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div><div style="margin: 0px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div><div style="margin: 0px 1px; height: 1px; overflow: hidden; background-color: rgb(255, 255, 255);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(181, 196, 207);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(151, 173, 188);"><div style="height: 1px; overflow: hidden; margin: 0px 1px; background-color: rgb(144, 167, 183);"></div></div></div></div></div></div>
     <div style="padding: 10px 0 0 10px;">
     <?php if($users->getClubDays(USER_ID) == '0'){ echo 'Suscripción HC no activada.';}else{ echo 'Te quedan '.$users->getClubDays(USER_ID).' días de HC';}; ?><br><?php if($daysLeft == '0'){ echo 'Suscripción VIP no activada.';}else{ echo 'Te quedan '.$daysLeft.' días de VIP';}; ?>    

     </div>
     <div style="height: 113px; padding: 10px">
       ¿HC o VIP? Ser HC te da más ropas, colers y regales mensuales, por citar algunos beneficios. Pero ser VIP ted a todo lo que puedes conseguir como HC, y mucho más
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
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">25</span>           
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
     <span class="habboclub-offerprice" style="position: relative; left: -32px; top: -3px; font-size:1.5em; font-weight:bold; color: #000000;">60</span>           
     <a onclick="habboclub.buttonClick(4, &quot;Confirmar suscripción&quot;); return false;" href="#" id="subscribe4" style="position: relative; left: -10px; top: 10px; margin-left: 0" class="new-button oversize"><b>Comprar</b><i></i></a>
     <div style="width: 10px;"></div>
    </div> 
    
   </div></div></div><div class="bb"><div></div></div></div> 
  
  </div> 
  
</form>

</div>    </div>
</div>
	
						
							
					</div></div></div><div class="bb"><div></div></div></div>
				</div>
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>