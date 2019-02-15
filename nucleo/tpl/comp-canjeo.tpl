<?php
$status = NULL;
if(isset($_POST['cambear'])){
   $query = mysql_query("SELECT COUNT(id) AS aantalleden FROM users_referidos WHERE usuario ='".USER_NAME."' ORDER BY ID") or die(mysql_error());
         $data = mysql_fetch_assoc($query);


      if($data['aantalleden'] <= '0')
      {   
         $status = '<div class="error" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">No tienes ningún referido.</div>';
      }

      elseif($data['aantalleden'] >= '5') {

            
         mysql_query("UPDATE users_referidos SET usuario = '' WHERE usuario = '".USER_NAME."' LIMIT 5");



   //dar creditos
   $sql = "UPDATE users SET credits  = credits    '10000' WHERE id = '".USER_ID."'";
   //echo $sql;
   //exit;
   mysql_query($sql);      
                  
                     $status = '<div class="goodmsg" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">Has Canjeado tus 5 referidos por 10000 Créditos.</div>';
                     }

      else
   {
      $status = '<div class="error" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">Lo siento, no tienes los referidos suficientes.</div>';
   }

   }

?>

<style>
   .error {
      padding: 7px;
      background-color: #fff4f2;
      border: 1px solid #a63c29;
      color: #E2001A;
      margin-top: 5px;
   }

   .error > h3 {
      font-weight: bold;
      margin: 0px;
      padding: 0px;
      font-size: 13px;
   }
   div.goodmsg {
      padding: 7px;
      background-color: #d8f3d8;
      border: 1px solid #4da04d;
      color: #205220;
      margin-top: 5px;
   }

   div.goodmsg > h3 {
      font-weight: bold;
      margin: 0px;
      padding: 0px;
      font-size: 13px;
   }
   div.display_none {
      display: none;
   }
   </style>

<div class="habblet-container ">      
      <div class="cbb clearfix green "> 

      <h2 class="title">Canjea Créditos</h2>

      <div class="box-content">

         <div align="center">
<div style="text-shadow: #808080 1px 1px 0px;padding-top:5px;color:#000000;font-weight:bold;font-size:10.4px;float:center;margin-left: 5px;"> 
          Puedes Canjear 5 Referidos por 10000 Créditos en Navvos. <br />
           <br /> 
         <center><img src="http://navvos.servegame.com/CreditosPixeles/creditos.gif"</center>
                         <br />
                         <br />
         <?php echo $status; ?>
                        
         
         <form method="post" action="">
         <center><?php if('".USER_ID."') { echo '<input type="submit" value="Canjear" name="cambear" />'; } ?></center>
         </form>
           </div>
      </div>
         
      </div>
      <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
      </div></div>
<?php
$status = NULL;
if(isset($_POST['cambioss'])){
   $query = mysql_query("SELECT COUNT(id) AS aantalleden FROM users_referidos WHERE usuario ='".USER_NAME."' ORDER BY ID") or die(mysql_error());
         $data = mysql_fetch_assoc($query);


      if($data['aantalleden'] <= '0')
      {   
         $status = '<div class="error" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">No tienes ningún referido.</div>';
      }

      elseif($data['aantalleden'] >= '5') {

            
         mysql_query("UPDATE users_referidos SET usuario = '' WHERE usuario = '".USER_NAME."' LIMIT 5");



   //dar pixeles
   $sql = "UPDATE users SET activity_points  = activity_points    '60000' WHERE id = '".USER_ID."'";
   //echo $sql;
   //exit;
   mysql_query($sql);
      
                  
                     $status = '<div class="goodmsg" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">Has Canjeado tus 5 referidos por 60000 Píxeles.</div>';
                     }

      else
   {
      $status = '<div class="error" style="-moz-border-radius: 7px; -webkit-border-radius: 7px; padding: 10px;">Lo siento, no tienes los referidos suficientes.</div>';
   }

   }

?>

<style>
   .error {
      padding: 7px;
      background-color: #fff4f2;
      border: 1px solid #a63c29;
      color: #E2001A;
      margin-top: 5px;
   }

   .error > h3 {
      font-weight: bold;
      margin: 0px;
      padding: 0px;
      font-size: 13px;
   }
   div.goodmsg {
      padding: 7px;
      background-color: #d8f3d8;
      border: 1px solid #4da04d;
      color: #205220;
      margin-top: 5px;
   }

   div.goodmsg > h3 {
      font-weight: bold;
      margin: 0px;
      padding: 0px;
      font-size: 13px;
   }
   div.display_none {
      display: none;
   }
   </style>

<div class="habblet-container ">      
      <div class="cbb clearfix orange "> 

      <h2 class="title">Canjea Píxeles</h2>

      <div class="box-content">

         <div align="center">
         <div style="text-shadow: #808080 1px 1px 0px;padding-top:5px;color:#000000;font-weight:bold;font-size:10.4px;float:center;margin-left: 5px;"> 
Puedes Canjear 5 Referidos por 60000 Píxeles en Navvos. <br />
          <br /> 
         <center><img src="http://navvos.servegame.com/CreditosPixeles/pixeles.gif"</center>
                         <br />
                         <br />
         <?php echo $status; ?>
                        
         
         <form method="post" action="">
         <center><?php if(isset(USER_ID)) { echo '<input type="submit" value="Canjear" name="cambioss" />'; } ?></center>
         </form>
           </div>
      </div>
</div>

</div>