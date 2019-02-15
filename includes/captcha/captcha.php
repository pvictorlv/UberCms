<?php
/*================================================================+\
|| # PHPRetro - An extendable virtual hotel site and management
|+==================================================================
|| # Copyright (C) 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Parts Copyright (C) 2009 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|| # All images, scripts, and layouts
|| # Copyright (C) 2009 Sulake Ltd. All rights reserved.
|+==================================================================
|| # PHPRetro is provided "as is" and comes without
|| # warrenty of any kind. PHPRetro is free software!
|| # License: GNU Public License 3.0
|| # http://opensource.org/licenses/gpl-license.php
\+================================================================*/

// Feel free to change the settings for your hotel.

require('./php-captcha.inc.php');
$aFonts = array('./monofont.ttf');
$oPhpCaptcha = new PhpCaptcha($aFonts, 200, 60);
$oPhpCaptcha->SetWidth(200);
$oPhpCaptcha->SetHeight(60);
$oPhpCaptcha->SetNumChars(6);
$oPhpCaptcha->SetCharSet('a,b,c,d,e,f,g,h,j,k,m,n,p,q,r,s,t,u,v,w,x,y,z');
$oPhpCaptcha->SetNumLines(70);
$oPhpCaptcha->DisplayShadow(false);
$oPhpCaptcha->SetMaxFontSize(50);
$oPhpCaptcha->SetMinFontSize(40);
$oPhpCaptcha->UseColour(false);
$oPhpCaptcha->Create();
?>