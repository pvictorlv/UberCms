<?php
header("Content-type: image/gif");
// Agradecimientos a Jaym/Kreechin

$im = imagecreatefromgif("placas/base/base.gif");
$badgedata = $_GET['placa'];

if(empty($badgedata)){ exit; }

$letters = array("b", "X");
$badgedata = str_replace($letters, "", $badgedata);
$layer = explode("s",$badgedata);
$sourcefile_id = imageCreateFromgif("placas/base/base.gif");

$str = "$layer[0]";
$arr = str_split($str, 2);
if ("$layer[0]" == "") {
$lay = "placas/templates/none.gif";
$lay = imagecreatefromgif($lay);
    imagecopy($im, $lay, 0, 0, 0, 0, 0, 0);
} else {
$colcode = $arr[1];
if ("$colcode" == "01") {
$col = '0xff0xd60x01';
}
elseif ("$colcode" == "02") {
$col = '0xee0x760x00';
}
elseif ("$colcode" == "03") {
$col = '0x840xde0x00';
}
elseif ("$colcode" == "04") {
$col = '0x580x9a0x00';
}
elseif ("$colcode" == "05") {
$col = '0x500xc10xfb';
}
elseif ("$colcode" == "06") {
$col = '0x000x6f0xcf';
}
elseif ("$colcode" == "07") {
$col = '0xff0x980xe3';
}
elseif ("$colcode" == "08") {
$col = '0xf30x340xbf';
}
elseif ("$colcode" == "09") {
$col = '0xff0x2d0x2d';
}
elseif ("$colcode" == "10") {
$col = '0xaf0x0a0x0a';
}
elseif ("$colcode" == "11") {
$col = '0xff0xff0xff';
}
elseif ("$colcode" == "12") {
$col = '0xc00xc00xc0';
}
elseif ("$colcode" == "13") {
$col = '0x370x370x37';
}
elseif ("$colcode" == "14") {
$col = '0xfb0xe70xac';
}
elseif ("$colcode" == "15") {
$col = '0x970x760x41';
}
elseif ("$colcode" == "16") {
$col = '0xc20xea0xff';
}
elseif ("$colcode" == "17") {
$col = '0xff0xf10x65';
}
elseif ("$colcode" == "18") {
$col = '0xaa0xff0x7d';
}

$colour = str_split($col, 4);
$hex1 = $colour[0];
$hex2 = $colour[1];
$hex3 = $colour[2];

function image_colorize(&$img,$rgb) {
  imageTrueColorToPalette($img,true,256);
  $numColors = imageColorsTotal($img);
  for ($x = 0; $x < $numColors; $x++) {
    list($r,$g,$b) = array_values(imageColorsForIndex($img,$x));
    $grayscale = ($r + $g + $b) / 3 / 0xff;
    imageColorSet($img,$x,
      $grayscale * $rgb[0],
      $grayscale * $rgb[1],
      $grayscale * $rgb[2]);
}
}
$insertfile_id = imageCreateFromgif("placas/base/$arr[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
$image = getimagesize ("placas/base/$arr[0].gif");
$h = $image[0];
$w = $image[1];
$color = array($hex1,$hex2,$hex3);
$lay = "placas/base/$arr[0].gif";
$img = imageCreateFromgif($lay);
image_colorize($img, $color);
if(file_exists("placas/base/$arr[0]_$arr[0].gif")){
$olay = imagecreatefromgif("placas/base/$arr[0]_$arr[0].gif");
imagecopymerge($img, $olay, 0, 0, 0, 0, $h, $w, 100);
     imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    } else {
         imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    }
    }

$str1 = "$layer[1]";
$arr1 = str_split($str1, 2);
if ("$layer[1]" == "") {
$lay1 = "placas/templates/none.gif";
$lay1 = imagecreatefromgif($lay1);
    imagecopy($im, $lay1, 0, 0, 0, 0, 0, 0);
} else {

$image = getimagesize ("placas/templates/$arr1[0].gif");
$h = $image[0];
$w = $image[1];
$pos = $arr1[2];

if ("$pos" == "0") {
$p = "0";
$pp = "0";
}
elseif ("$pos" == "1") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = 0;
}
elseif ("$pos" == "2") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = 0;
}
elseif ("$pos" == "3") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "4") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "5") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "6") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "7") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "8") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr1[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = $sourcefile_height - $insertfile_height;
}
$colcode = $arr1[1];
if ("$colcode" == "01") {
$col = '0xff0xd60x01';
}
elseif ("$colcode" == "02") {
$col = '0xee0x760x00';
}
elseif ("$colcode" == "03") {
$col = '0x840xde0x00';
}
elseif ("$colcode" == "04") {
$col = '0x580x9a0x00';
}
elseif ("$colcode" == "05") {
$col = '0x500xc10xfb';
}
elseif ("$colcode" == "06") {
$col = '0x000x6f0xcf';
}
elseif ("$colcode" == "07") {
$col = '0xff0x980xe3';
}
elseif ("$colcode" == "08") {
$col = '0xf30x340xbf';
}
elseif ("$colcode" == "09") {
$col = '0xff0x2d0x2d';
}
elseif ("$colcode" == "10") {
$col = '0xaf0x0a0x0a';
}
elseif ("$colcode" == "11") {
$col = '0xff0xff0xff';
}
elseif ("$colcode" == "12") {
$col = '0xc00xc00xc0';
}
elseif ("$colcode" == "13") {
$col = '0x370x370x37';
}
elseif ("$colcode" == "14") {
$col = '0xfb0xe70xac';
}
elseif ("$colcode" == "15") {
$col = '0x970x760x41';
}
elseif ("$colcode" == "16") {
$col = '0xc20xea0xff';
}
elseif ("$colcode" == "17") {
$col = '0xff0xf10x65';
}
elseif ("$colcode" == "18") {
$col = '0xaa0xff0x7d';
}

$colour = str_split($col, 4);
$hex1 = $colour[0];
$hex2 = $colour[1];
$hex3 = $colour[2];

function image_colorize1(&$img,$rgb) {
  imageTrueColorToPalette($img,true,256);
  $numColors = imageColorsTotal($img);
  for ($x = 0; $x < $numColors; $x++) {
    list($r,$g,$b) = array_values(imageColorsForIndex($img,$x));
    $grayscale = ($r + $g + $b) / 3 / 0xff;
    imageColorSet($img,$x,
      $grayscale * $rgb[0],
      $grayscale * $rgb[1],
      $grayscale * $rgb[2]);
}
}

$color = array($hex1,$hex2,$hex3);
$lay1 = "placas/templates/$arr1[0].gif";
$img = imageCreateFromgif($lay1);
image_colorize1($img,$color);
if(file_exists("placas/templates/$arr1[0]_$arr1[0].gif")){
$olay = imagecreatefromgif("placas/templates/$arr1[0]_$arr1[0].gif");
imagecopymerge($img, $olay, 0, 0, 0, 0, $h, $w, 100);
     imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    } else {
         imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    }
    }



$str2 = "$layer[2]";
$arr2 = str_split($str2, 2);
if ("$layer[2]" == "") {
$lay2 = "placas/templates/none.gif";
$lay2 = imagecreatefromgif($lay2);
    imagecopy($im, $lay2, 0, 0, 0, 0, 0, 0);
} else {
$image = getimagesize ("placas/templates/$arr2[0].gif");
$h = $image[0];
$w = $image[1];
$pos = $arr2[2];
if ("$pos" == "0") {
$p = "0";
$pp = "0";
}
elseif ("$pos" == "1") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = 0;
}
elseif ("$pos" == "2") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = 0;
}
elseif ("$pos" == "3") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "4") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "5") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "6") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "7") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "8") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr2[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = $sourcefile_height - $insertfile_height;
}
$colcode = $arr2[1];
if ("$colcode" == "01") {
$col = '0xff0xd60x01';
}
elseif ("$colcode" == "02") {
$col = '0xee0x760x00';
}
elseif ("$colcode" == "03") {
$col = '0x840xde0x00';
}
elseif ("$colcode" == "04") {
$col = '0x580x9a0x00';
}
elseif ("$colcode" == "05") {
$col = '0x500xc10xfb';
}
elseif ("$colcode" == "06") {
$col = '0x000x6f0xcf';
}
elseif ("$colcode" == "07") {
$col = '0xff0x980xe3';
}
elseif ("$colcode" == "08") {
$col = '0xf30x340xbf';
}
elseif ("$colcode" == "09") {
$col = '0xff0x2d0x2d';
}
elseif ("$colcode" == "10") {
$col = '0xaf0x0a0x0a';
}
elseif ("$colcode" == "11") {
$col = '0xff0xff0xff';
}
elseif ("$colcode" == "12") {
$col = '0xc00xc00xc0';
}
elseif ("$colcode" == "13") {
$col = '0x370x370x37';
}
elseif ("$colcode" == "14") {
$col = '0xfb0xe70xac';
}
elseif ("$colcode" == "15") {
$col = '0x970x760x41';
}
elseif ("$colcode" == "16") {
$col = '0xc20xea0xff';
}
elseif ("$colcode" == "17") {
$col = '0xff0xf10x65';
}
elseif ("$colcode" == "18") {
$col = '0xaa0xff0x7d';
}

$colour = str_split($col, 4);
$hex1 = $colour[0];
$hex2 = $colour[1];
$hex3 = $colour[2];

function image_colorize2(&$img,$rgb) {
  imageTrueColorToPalette($img,true,256);
  $numColors = imageColorsTotal($img);
  for ($x = 0; $x < $numColors; $x++) {
    list($r,$g,$b) = array_values(imageColorsForIndex($img,$x));
    $grayscale = ($r + $g + $b) / 3 / 0xff;
    imageColorSet($img,$x,
      $grayscale * $rgb[0],
      $grayscale * $rgb[1],
      $grayscale * $rgb[2]);
}
}
$color = array($hex1,$hex2,$hex3);
$lay2 = "placas/templates/$arr2[0].gif";
$img = imageCreateFromgif($lay2);
image_colorize2($img,$color);
if(file_exists("placas/templates/$arr2[0]_$arr2[0].gif")){
$olay = imagecreatefromgif("placas/templates/$arr2[0]_$arr2[0].gif");
imagecopymerge($img, $olay, 0, 0, 0, 0, $h, $w, 100);
     imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    } else {
         imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    }
    }


$str3 = "$layer[3]";
$arr3 = str_split($str3, 2);
if ("$layer[3]" == "") {
$lay3 = "placas/templates/none.gif";
$lay3 = imagecreatefromgif($lay3);
    imagecopy($im, $lay3, 0, 0, 0, 0, 0, 0);
} else {
$image = getimagesize ("placas/templates/$arr3[0].gif");
$h = $image[0];
$w = $image[1];
$pos = $arr3[2];
if ("$pos" == "0") {
$p = "0";
$pp = "0";
}
elseif ("$pos" == "1") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = 0;
}
elseif ("$pos" == "2") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = 0;
}
elseif ("$pos" == "3") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "4") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "5") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "6") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "7") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "8") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr3[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = $sourcefile_height - $insertfile_height;
}
$colcode = $arr3[1];
if ("$colcode" == "01") {
$col = '0xff0xd60x01';
}
elseif ("$colcode" == "02") {
$col = '0xee0x760x00';
}
elseif ("$colcode" == "03") {
$col = '0x840xde0x00';
}
elseif ("$colcode" == "04") {
$col = '0x580x9a0x00';
}
elseif ("$colcode" == "05") {
$col = '0x500xc10xfb';
}
elseif ("$colcode" == "06") {
$col = '0x000x6f0xcf';
}
elseif ("$colcode" == "07") {
$col = '0xff0x980xe3';
}
elseif ("$colcode" == "08") {
$col = '0xf30x340xbf';
}
elseif ("$colcode" == "09") {
$col = '0xff0x2d0x2d';
}
elseif ("$colcode" == "10") {
$col = '0xaf0x0a0x0a';
}
elseif ("$colcode" == "11") {
$col = '0xff0xff0xff';
}
elseif ("$colcode" == "12") {
$col = '0xc00xc00xc0';
}
elseif ("$colcode" == "13") {
$col = '0x370x370x37';
}
elseif ("$colcode" == "14") {
$col = '0xfb0xe70xac';
}
elseif ("$colcode" == "15") {
$col = '0x970x760x41';
}
elseif ("$colcode" == "16") {
$col = '0xc20xea0xff';
}
elseif ("$colcode" == "17") {
$col = '0xff0xf10x65';
}
elseif ("$colcode" == "18") {
$col = '0xaa0xff0x7d';
}

$colour = str_split($col, 4);
$hex1 = $colour[0];
$hex2 = $colour[1];
$hex3 = $colour[2];

function image_colorize3(&$img,$rgb) {
  imageTrueColorToPalette($img,true,256);
  $numColors = imageColorsTotal($img);
  for ($x = 0; $x < $numColors; $x++) {
    list($r,$g,$b) = array_values(imageColorsForIndex($img,$x));
    $grayscale = ($r + $g + $b) / 3 / 0xff;
    imageColorSet($img,$x,
      $grayscale * $rgb[0],
      $grayscale * $rgb[1],
      $grayscale * $rgb[2]);
}
}
$color = array($hex1,$hex2,$hex3);
$lay3 = "placas/templates/$arr3[0].gif";
$img = imageCreateFromgif($lay3);
image_colorize3($img,$color);
if(file_exists("placas/templates/$arr3[0]_$arr3[0].gif")){
$olay = imagecreatefromgif("placas/templates/$arr3[0]_$arr3[0].gif");
imagecopymerge($img, $olay, 0, 0, 0, 0, $h, $w, 100);
     imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    } else {
         imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    }
    }
    
    
    
$str4 = "$layer[4]";
$arr4 = str_split($str4, 2);
if ("$layer[4]" == "") {
$lay4 = "placas/templates/none.gif";
$lay4 = imagecreatefromgif($lay4);
    imagecopy($im, $lay4, 0, 0, 0, 0, 0, 0);
} else {
$image = getimagesize ("placas/templates/$arr4[0].gif");
$h = $image[0];
$w = $image[1];
$pos = $arr4[2];
if ("$pos" == "0") {
$p = "0";
$pp = "0";
}
elseif ("$pos" == "1") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = 0;
}
elseif ("$pos" == "2") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = 0;
}
elseif ("$pos" == "3") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "4") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "5") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
}
elseif ("$pos" == "6") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = 0;
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "7") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = ( ( $sourcefile_width - $insertfile_width ) / 2 );
$pp = $sourcefile_height - $insertfile_height;
}
elseif ("$pos" == "8") {
$insertfile_id = imageCreateFromgif("placas/templates/$arr4[0].gif");
$sourcefile_width = imageSX($sourcefile_id);
$insertfile_width = imageSX($insertfile_id);
$sourcefile_height = imageSY($sourcefile_id);
$insertfile_height = imageSY($insertfile_id);
$p = $sourcefile_width - $insertfile_width;
$pp = $sourcefile_height - $insertfile_height;
}
$colcode = $arr4[1];
if ("$colcode" == "01") {
$col = '0xff0xd60x01';
}
elseif ("$colcode" == "02") {
$col = '0xee0x760x00';
}
elseif ("$colcode" == "03") {
$col = '0x840xde0x00';
}
elseif ("$colcode" == "04") {
$col = '0x580x9a0x00';
}
elseif ("$colcode" == "05") {
$col = '0x500xc10xfb';
}
elseif ("$colcode" == "06") {
$col = '0x000x6f0xcf';
}
elseif ("$colcode" == "07") {
$col = '0xff0x980xe3';
}
elseif ("$colcode" == "08") {
$col = '0xf30x340xbf';
}
elseif ("$colcode" == "09") {
$col = '0xff0x2d0x2d';
}
elseif ("$colcode" == "10") {
$col = '0xaf0x0a0x0a';
}
elseif ("$colcode" == "11") {
$col = '0xff0xff0xff';
}
elseif ("$colcode" == "12") {
$col = '0xc00xc00xc0';
}
elseif ("$colcode" == "13") {
$col = '0x370x370x37';
}
elseif ("$colcode" == "14") {
$col = '0xfb0xe70xac';
}
elseif ("$colcode" == "15") {
$col = '0x970x760x41';
}
elseif ("$colcode" == "16") {
$col = '0xc20xea0xff';
}
elseif ("$colcode" == "17") {
$col = '0xff0xf10x65';
}
elseif ("$colcode" == "18") {
$col = '0xaa0xff0x7d';
}

$colour = str_split($col, 4);
$hex1 = $colour[0];
$hex2 = $colour[1];
$hex3 = $colour[2];

function image_colorize4(&$img,$rgb) {
  imageTrueColorToPalette($img,true,256);
  $numColors = imageColorsTotal($img);
  for ($x = 0; $x < $numColors; $x++) {
    list($r,$g,$b) = array_values(imageColorsForIndex($img,$x));
    $grayscale = ($r + $g + $b) / 3 / 0xff;
    imageColorSet($img,$x,
      $grayscale * $rgb[0],
      $grayscale * $rgb[1],
      $grayscale * $rgb[2]);
}
}
$color = array($hex1,$hex2,$hex3);
$lay4 = "placas/templates/$arr4[0].gif";
$img = imageCreateFromgif($lay4);
image_colorize4($img,$color);
if(file_exists("placas/templates/$arr4[0]_$arr4[0].gif")){
$olay = imagecreatefromgif("placas/templates/$arr4[0]_$arr4[0].gif");
imagecopymerge($img, $olay, 0, 0, 0, 0, $h, $w, 100);
     imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    } else {
         imagecopy($im, $img, $p, $pp, 0, 0, $h, $w);
    }
    }
imagegif($im);
$badgedata = $_GET['placa'];
if(file_exists("../cache/placas/$badgedata.gif")) {
imagedestroy($im);
} else {
imagegif($im , "../cache/placas/$badgedata.gif");
imagedestroy($im);
}
?> 
