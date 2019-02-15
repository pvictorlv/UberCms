<?php
$sampleId = $_GET['sampleId'];

if(!isset($sampleId)) {
	die('Ops! Sem musica definida');
 } else {
	 header('location: trax/mp3/sound_machine_sample_'.$sampleId.'.mp3');
 }

?>