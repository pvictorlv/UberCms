<?php

/*
+--------------------------------------------------------------------------
|   @CARD MAX 2004 Full Version
|   ========================================
|   by Khoi Hong webmaster@cgi2k.com
|   (c) 1999 - 2003 CGI2K.COM - All right reserved 
|   http://www.cgi2k.com 
|   ========================================
|   Web: http://www.ecardmax.com
|   Time: Thanksgiving Thursday, 27 November 2003 05:08 PM - Pacific Time
|   Email: webmaster@cgi2k.com
|   Purchase Info: http://www.ecardmax.com/buy.php
|   Request Installation: http://www.ecardmax.com/efeedback/efeedbackV4.php?install
|
|
|   > Script file name: calendar.php
|   > Script written by Khoi Hong
|   > Date started: July 07 2003
|	
|	WARNING //--------------------------
|
|	Selling the code for this program without prior written consent is expressly forbidden. 
|	This computer program is protected by copyright law. 
|	Unauthorized reproduction or distribution of this program, or any portion of if,
|	may result in severe civil and criminal penalties and will be prosecuted to 
|	the maximum extent possible under the law.
+--------------------------------------------------------------------------
*/

	$get_now_date = getdate();
	$now_year = $get_now_date[year];
	$now_month = $get_now_date[mon];
	$now_day = $get_now_date[mday];
	$month=$_POST[month];
	$year=$_POST[year];

	define ("ADAY", (60*60*24));
	if (!checkdate($month,1,$year)){
		$nowArray = getdate();
		$month = $nowArray[mon];
		$year = $nowArray[year];
	}

	$start = mktime (0, 0, 0, $month, 1, $year);
	
	$firstDayArray = getdate($start);

?>

<html>
<head>
<title>Calendar</title>
<script language="JavaScript" type="text/javascript">	
	function SetFormat(data) {
		self.parent.InsertSymbol(data);
		self.parent.close_insert_pop();
	}
var get_styles_folder_path = self.parent.styles_folder_path;
get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style_popup_layer.css);</style>");
</script>

</head>

<body>
<br>
<table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="100%" align="center">

<form name=calendar_form action="<?$_SERVER['PHP_SELF']?>" method="post" >
<select name=month onChange='document.calendar_form.submit();'>
<?php

	$months = Array("January","February","March","April","May","June","July","August","September","October","November","December");
	
	for ($x=1; $x<=count($months); $x++){
		print "\t<option value='$x'";
		print ($x == $month)? " SELECTED":"";
		print ">" . $months[$x-1]."\n";
	}

?>

</select>

<select name=year onChange='document.calendar_form.submit();'>
<?php

	for ($x=$now_year; $x<=$now_year+10; $x++){
		print "\t<option";
		print ($x == $year)? " SELECTED":"";
		print ">$x\n" ;
	}

?>
</select>

</form>

</td>
</tr>
</table><br>

<?php
$days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
print "<div align='center' STYLE=\"cursor:hand;cursor:pointer\" ><center>\n<table class=Hoteditor_Calendar_Main_Border cellpadding='0' cellspacing='0' width='95%' >\n";

foreach ($days as $day) {
	print "\t<td class=Hoteditor_Calendar_Title_Background_Color align='center' width='40'><font face='Verdana' size='1'><b>$day</b></font></td>\n";
}

for ($count=0; $count < (6*7); $count++){
	$dayArray = getdate($start);
	if ((($count) % 7) == 0){
		if ($dayArray[mon] != $month)
			break;
			print "</tr>\n<tr>\n";
	}
	
	if ($count < $firstDayArray[wday] || $dayArray[mon] != $month) {
		print "\t<td><br></td>\n";
	}
	else {

		if ($now_day == $dayArray[mday] && $now_month == $month && $now_year == $year){			 
			print "\t<td class=Hoteditor_Calendar_ToDay_Background_Color title=\"Insert Date $firstDayArray[month] $dayArray[mday] $firstDayArray[year]\" onClick=\"SetFormat('$firstDayArray[month] $dayArray[mday] $firstDayArray[year]')\" onMouseover=\"this.className='Hoteditor_Calendar_MouseOver';\" onMouseout=\"this.className='Hoteditor_Calendar_ToDay_Background_Color';\" height='22' align='center' width='14%'><font face='Verdana' size='2' ><b>$dayArray[mday]</b><font></td>\n";
		}
		else{
			print "\t<td class=Hoteditor_Calendar_NormalDay_Background_Color title=\"Insert Date $firstDayArray[month] $dayArray[mday] $firstDayArray[year]\" onClick=\"SetFormat('$firstDayArray[month] $dayArray[mday] $firstDayArray[year]')\" onMouseover=\"this.className='Hoteditor_Calendar_MouseOver';\" onMouseout=\"this.className='Hoteditor_Calendar_NormalDay_Background_Color';\" height='22' align='center' width='14%'><font face='Verdana' size='1' >$dayArray[mday]<font></td>\n";
		}
		$start += ADAY;
	}
}

print "</tr></table>\n</center></div><p align='center'><font face='Verdana' size='3' color='#008000'>$firstDayArray[month] - $firstDayArray[year]</font><br><br>";
print "<a href='wclock.php'><img border=0 src='clock.gif' title='View World Clock'><br><font face='Verdana' size='1' color='#008000'>View World Clock</font></a>";
?>

</body>
</html>
