<?php
$_CONFIG['site_name'] 			= "SMEC Agriculture Water Management System";
$_CONFIG['site_short_name'] 	= "SAS";

 if($_SERVER['HTTP_HOST'] == "localhost")
{# For local
	$_CONFIG['site_url'] 		= "http://".$_SERVER['HTTP_HOST']."/SASA-Final2/";
	$_CONFIG['site_path'] 		= $_SERVER['DOCUMENT_ROOT'] . "/SASA-Final2/";
}

$_CONFIG['crop_year'] 	= "2020";
$_CONFIG['nc_code'] 	= "NC0101";
?>