<?php
/*=========================================================+
|| # HabboCMS - Sistema de administración de contenido Habbo.
|+=========================================================+
|| # Copyright © 2010 Kolesias123. All rights reserved.
|| # http://www.infosmart.com.mx
|| # Partes Copyright © 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Base Copyright © 2007-2008 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|+=========================================================+
|| # InfoSmart 2010. The power of Proyects.
|| # Este es un Software de código libre, libre edición.
|+=========================================================+
|| # Todas las imagenes, scripts y temas
|| # Copyright (C) 2010 Sulake Ltd. All rights reserved.
|+=========================================================*/

if (!defined("IN_HOLOCMS")) { header("Location:".PATH.""); exit; }

$notices = 0;

$news_1_query = Db::query("SELECT id, title, date, topstory, short_story FROM cms_news WHERE priority = '1' AND type = 'article' ORDER BY id DESC LIMIT 1");
$news_2_query = Db::query("SELECT id, title, date, topstory, short_story FROM cms_news WHERE priority = '1' AND type = 'article' ORDER BY id DESC LIMIT 1,2");
$news_3_query = Db::query("SELECT id, title, date, topstory, short_story FROM cms_news WHERE priority = '1' AND type = 'article' ORDER BY id DESC LIMIT 2,3");
$news_4_query = Db::query("SELECT id, title, date, topstory, short_story FROM cms_news WHERE priority = '0' AND type = 'article' ORDER BY id DESC LIMIT 1");
$news_5_query = Db::query("SELECT id, title, date, topstory, short_story FROM cms_news WHERE priority = '0' AND type = 'article' ORDER BY id DESC LIMIT 1,2");

$news_1_row = $news_1_query->fetch(PDO::FETCH_ASSOC);
$news_2_row = $news_2_query->fetch(PDO::FETCH_ASSOC);
$news_3_row = $news_3_query->fetch(PDO::FETCH_ASSOC);
$news_4_row = $news_4_query->fetch(PDO::FETCH_ASSOC);
$news_5_row = $news_5_query->fetch(PDO::FETCH_ASSOC);

$news_1_title = HoloText($news_1_row['title']);
$news_1_snippet = HoloText($news_1_row['short_story']);
$news_1_date = HoloText($news_1_row['date']);
$news_1_topstory = HoloText($news_1_row['topstory']);
$news_1_id = HoloText($news_1_row['id']);

if(empty($news_1_title)){ $news_1_title = "¡Artículo no encontrado!"; } else { $notices++; }
if(empty($news_1_snippet)){ $news_1_snippet = "Este artículo parece no existir."; }
if(empty($news_1_topstory)){ $news_1_topstory = "../includes/hots/AU_TS_Circus_LarissaBrown_v1.gif"; }

$news_2_title = HoloText($news_2_row['title']);
$news_2_snippet = HoloText($news_2_row['short_story']);
$news_2_date = HoloText($news_2_row['date']);
$news_2_topstory = HoloText($news_2_row['topstory']);
$news_2_id = HoloText($news_2_row['id']);

if(empty($news_2_title)){ $news_2_title = "¡Artículo no encontrado!"; } else{ $notices++; }
if(empty($news_2_snippet)){ $news_2_snippet = "Este artículo parece no existir."; }
if(empty($news_2_topstory)){ $news_2_topstory = "../includes/hots/AU_TS_Circus_LarissaBrown_v1.gif"; }

$news_3_title = HoloText($news_3_row['title']);
$news_3_snippet = HoloText($news_3_row['short_story']);
$news_3_date = HoloText($news_3_row['date']);
$news_3_topstory = HoloText($news_3_row['topstory']);
$news_3_id = HoloText($news_3_row['id']);

if(empty($news_3_title)){ $news_3_title = "¡Artículo no encontrado!"; } else { $notices++; }
if(empty($news_3_snippet)){ $news_3_snippet = "Este artículo parece no existir."; }
if(empty($news_3_topstory)){ $news_3_topstory = "../includes/hots/AU_TS_Circus_LarissaBrown_v1.gif"; }

$news_4_title = HoloText($news_4_row['title']);
$news_4_snippet = HoloText($news_4_row['short_story']);
$news_4_date = HoloText($news_4_row['date']);
$news_4_id = HoloText($news_4_row['id']);

if(empty($news_4_title)){ $news_4_title = "¡Artículo no encontrado!"; }
if(empty($news_4_date)){ $news_4_date = "Este artículo parece no existir."; }

$news_5_title = HoloText($news_5_row['title']);
$news_5_snippet = HoloText($news_5_row['short_story']);
$news_5_date = HoloText($news_5_row['date']);
$news_5_id = HoloText($news_5_row['id']);

if(empty($news_5_title)){ $news_5_title = "¡Artículo no encontrado!"; }
if(empty($news_5_date)){ $news_5_date = "Este artículo parece no existir."; }
?>