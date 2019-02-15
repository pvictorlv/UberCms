<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>

<h1 style="border: 1px solid; "><img src="images/uberdown.png" style="vertical-align: middle;"> Uberdown <span style="font-weight: normal;">Emergency reporting</span></h1>

<h2 style="border: 1px solid; padding: 3px;"><b>WARNING:</b> This is only for CRITICAL issues such as reporting downtime. Abuse of this system <u>WILL</u> lead to <u>REMOVAL</u>.</h2>

<form method="post" style="margin-left: auto; margin-right: auto; margin-top: 40px; margin-bottom: 40px; border: 1px solid; width: 75%;">

<h1 style="padding: 10px;">Report form</h1>

<p style="padding: 10px;">

	In the event of a serious technical problem with the hotel, a system called uberdown comes into play. Selected individuals (including the Moderators and staff at Uber) have access to a web-based form, where they can report critical disruptions to the service. While you are working a shift as Moderator it is your responsibility to report major problems promptly.

</p>

<p>

	<ol style="margin-left: 40px;">
		<li />First check the STATUS TOOL in Housekeeping - <?php echo WWW; ?>/manage/.<br />
		<li />If you see any RED ERROR, there is most likely a problem. This may not always be accurate.<br />
		<li />If you are certain there is a problem, use the form below to report it.
		<li /><i style="color: red;">Allow up to 15 minutes for us to resolve the problem before reporting it. If Roy is aware of the problem, then no need to report it.<br /><b>Always be short and descriptive, and never spam this system. One report will suffice.</b></i>
	</ol>

</p>

<br />
<hr />

<?php

if (isset($_POST['UBERDOWN'])) {

dbquery("INSERT INTO uberdown (username,shit) VALUES ('" . USER_NAME . "','" . filter($_POST['UBERDOWN']) . "')");

?>

<h1 style="text-align: center; color: blue;">UBERDOWN REPORT WAS SUBMITTED! Thank you.</h1>
<?php } else { ?>
<textarea rows="5" name="UBERDOWN" style="width: 96%; margin: 15px; padding: 5px; font-size: 140%;" onclick="if(this.value=='Describe the problem here...'){this.value='';}">Describe the problem here...</textarea>

<input type="submit" style="margin: 15px; margin-top: 0; float: left; padding: 5px; font-size: 160%; width: 45%; font-weight: bold;" value="Submit Uberdown report">
<input type="button" onclick="window.location = 'index.php?_cmd=main';" style="margin: 15px; margin-top: 0; float: right; padding: 5px; font-size: 150%; width: 45%;" value="Cancel report">

<div style="clear: both;"></div>
<?php } ?>

</form>

<?

require_once "bottom.php";

?>