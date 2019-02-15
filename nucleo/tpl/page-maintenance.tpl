<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 

	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<title>Hotel en Mantenimiento</title> 
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
	<script type="text/javascript" src="http://error.habbo.com/uk/js/jquery.tweet.js"></script> 
	
	<link href="http://error.habbo.com/uk/style/maintenance.css" rel="stylesheet" type="text/css" /> 
	
	<style type="text/css">
	#container { margin-top: 20px; }
	h1 span { height: 49px !important; width: 200px !important; background-image: url('%www%/images/logo.png') !important; }
	</style>
	
</head> 
<body> 
 
<div id="container"> 
	<div id="content"> 
		<div id="header" class="clearfix"> 
			<h1><span></span></h1> 
		</div> 
		<div id="process-content"> 
 
<div class="fireman"> 
 
<h1>Hay Paro por mantenimiento!</h1> 
 
<p>Lo sentimos, pero no es posible acceder a Habbo por el momento.<br />
  <br>
  Volveremos pronto. </br>

 <p> Por ahora,</p> <p>Mira los ultimos</p>
 
<p>Tweets.</p> </div> 
 
<div class="tweet-container"> 
 
<h2>¿Qué está pasando?</h2> 
 
<center><h3> Acá tu twitter :) </h3></center>
 
</div> 
 
<div id="footer"> 
<p class="copyright">LxCMS v2 &copy; 2011 CMS Basada en SilverCMS..</p> 
</div> 
 
		</div> 
	</div> 
</div> 
 
<script type='text/javascript'> 
$(document).ready(function(){
  $(".tweet").tweet({
    username: "uberHotel",
    count: 5
  });
});
</script> 
 
</body> 
</html> 