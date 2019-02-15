<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d'
| http://www.meth0d.org
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

define('FOREIGNBUSTER', true);

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	break;
}

if ($users->GetUserVar(USER_ID, 'newbie_status') != "1")
{
	header("Location: /client");
	exit;
}

if (isset($_POST['confirm']))
{
	$confirm = filter($_POST['confirm']);
	
	if ($confirm == 'Si acepto')
	{
		dbquery("UPDATE users SET newbie_status = '2' WHERE id = '" . USER_ID . "' LIMIT 1");
		header("Location: /client");
		exit;		
	}
	else
	{
		echo '<script type="text/javascript">alert(\'Lo sentimos es incorrecto diga Si acepto\');</script>';
	}
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');		
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');

$tpl->AddGeneric('process-template-top');
$tpl->AddGeneric('page-langver');
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Verificación de Seguridad');
$tpl->SetParam('body_id', 'popup');

$tpl->Output();

?>