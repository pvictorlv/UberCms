<?php
define('BAN_PAGE', true);
require_once "global.php";
$ban = null;
if (uberUsers::IsIpBanned(USER_IP)) {
    $ban = uberUsers::GetBan('ip', USER_IP, true);
}
if (LOGGED_IN && uberUsers::IsUserBanned(USER_NAME)) {
    $ban = uberUsers::GetBan('user', USER_NAME, true);
}

if ($ban == null) {
    header("Location: " . WWW . "/");
    exit;
}


$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddGeneric('head/process-template');
$tpl->AddGeneric('head/head-bottom');

$tpl->Write('<script language="JavaScript" type="text/javascript"> 
 document.logoutPage = true;
 </script>');

$tpl->AddGeneric('process-template-top');
if ($ban['reason'] == "") {
    $ban['reason'] = "Sem razão especifica";
}
$tpl->Write("<div class='action-error flash-message'> 
 <div class='rounded'> 
  <b>Você foi banido pela seguinte razão: {$ban['reason']}. O seu banimento acabará em " . date('d F, Y', $ban['expire']) . "</b>
 </div> 
</div>");

$tpl->Write('<div style="text-align: center"> 
 
 <div style="width:100px; margin: 10px auto"><a href="#" id="logout-ok" class="new-button fill"><b>OK</b><i></i></a></div>

</div>');

$tpl->AddGeneric('process-template-bottom');

$tpl->Write('<script type="text/javascript"> 
 Event.observe(\'logout-ok\', \'click\', function(e) {
  Event.stop(e);
   document.location.href=\'%www%\';
 });
 
    Cookie.erase("habboclient");
    Cookie.erase("friendlist");
</script>');

$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Sair');
$tpl->SetParam('body_id', 'logout');

$tpl->Output();

?>