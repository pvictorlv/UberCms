<html>
<head>
<title>World Clock</title>
</head>

<body bgcolor="#F5F5F5"  onload="runtime()" onunload="stoptime()">

<br>

<?php

	$parser_version = phpversion();
	if ($parser_version <= "4.1.0") { 
		$GET_VARS      	= $HTTP_GET_VARS ;
		$POST_VARS     	= $HTTP_POST_VARS;
		$SERVER_VARS   	= $HTTP_SERVER_VARS;
		$COOKIES  	 	= $HTTP_COOKIE_VARS;
	}	
	else{ 
		$GET_VARS      	= $_GET;
		$POST_VARS     	= $_POST;
		$SERVER_VARS   	= $_SERVER;
		$COOKIES  		= $_COOKIE;
	}

	$key = $GET_VARS['key'];
	$script_url = $SERVER_VARS['PHP_SELF'];

	if ($key == "Country" || $key == ""){
		$key2 = "City";
		$key = "Country" ;
	}
	elseif($key == "City") {
		$key2 = "Country";
	}
	else{
		print "Can't run World clock. Please check the way you call the script on browser.";
		exit;
	}
	

	$real_path = realpath ("gmt.txt");
	if ($real_path){

		if($fh = fopen ("$real_path", "r")){
			while (!feof ($fh)) {
				$data = fgets($fh, 4096);
				$data_chk = explode("|",$data);
				$getCountry = $data_chk[0];
				$getCity = $data_chk[1];
				$getTime = $data_chk[2];
				if ($key == "Country"){
					$get_data .="$getCountry|$getCity|$getTime\n";
				}
				elseif($key == "City"){
					$get_data .="$getCity|$getCountry|$getTime\n";
				}

			}
			fclose ($fh);
		}

		$array = explode("\n",$get_data);
		natsort($array);
		
		$x = 0 ;
		foreach ($array as $line){
			if ($line != ""){
				$get_info = preg_split ("/\|/", $line) ;
				$country = $get_info [0] ;
				$city = $get_info [1] ;
				$gmt_data = $get_info [2] ;
				$gmt_zone=3600*+$gmt_data ;
				$date=gmdate("l{''} M j - Y{''} g:i a", time() + $gmt_zone); 			
				if ($x == 0){
					$cell_color ="white";
				}
				else{
					$cell_color ="#F4FFFF";
				}
				$loop.="  <tr>\n";
				$loop.="	<td width=33% height=19 align=center bgcolor=$cell_color>&nbsp;<font face=Verdana size=1>$country</font></td>\n";
				$loop.="	<td width=33% height=19 align=center bgcolor=$cell_color><font face=Verdana size=1>&nbsp;$city</font></td>\n";
				$loop.="	<td width=34% height=19 align=center bgcolor=$cell_color>&nbsp;<font face=Verdana size=1>$date</font></td>\n";
				$loop.="  </tr>\n";
				if ($x == 0){
					$x = 1;
				}
				else{
					$x = 0 ;
				}
			}
		}

	}

print<<<EOF
<p align=center><a href="$script_url?key=$key"><font face=verdana size=2 color=green>Refresh Page</font></a> - <a href="calendar.php"><font face=verdana size=2 color=green>View Calendar</font></a><br>
EOF;

$html.=<<<EOF
<div style="overflow:auto;height:260;width:100%;border: 1px solid black" align="center">
<table border=1 cellpadding=0 cellspacing=0 style='border-collapse: collapse' bordercolor=#C0C0C0 width=100% height=46>
  <tr>
	<td width=100% colspan=3 height=26>
	<p align=center><b><font face=Verdana size=2>YOUR LOCAL TIME:

<script language="JavaScript">
var tick;
function stoptime() {
	clearTimeout(tick);
}
 
function runtime(){
	var timenow=new Date();
	var h,m,s;
	var time="";
	h=timenow.getHours();
	m=timenow.getMinutes();
	s=timenow.getSeconds();
	if(s<=9) s="0"+s;
	if(m<=9) m="0"+m;
	if(h<=9)h="0"+h;
	
	time+=h+":"+m+":"+s;
	var fulltime =time;
	
	if (document.all)clock.innerHTML=fulltime
	else if (document.getElementById)
	document.getElementById("clock").innerHTML=fulltime
	
	tick=setTimeout("runtime()",1000);  
}

if (document.all||document.getElementById)
document.write('<span id="clock" style="font:bold 14px Verdana; color:red"></span>')

</script>

	</td>
  </tr>
	  
  <tr>
	<td width=33% height=19 align=center bgcolor=#FFFF99><a title="Sort by $key" href=$script_url?key=$key><font face=Verdana size=1><b>$key</b></font></a></td>
	<td width=33% height=19 align=center bgcolor=#FFFF99><a title="Sort by $key2" href=$script_url?key=$key2><font face=Verdana size=1><b>$key2</b></font></a></td>
	<td width=34% height=19 align=center bgcolor=#FFFF99><font face=Verdana size=1><b>Time Now</b></font></td>
  </tr>

EOF;

	$html .="$loop</table></div></body></html>";
	$html =str_replace ("{''}","<br>",$html);
	print $html; 

?>