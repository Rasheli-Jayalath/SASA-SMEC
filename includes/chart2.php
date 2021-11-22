<?php 
//========================================
$start_time = microtime(true); //checker
//========================================
error_reporting(0);
include_once("../config/config.php");
$dbconn = new Database();
$objCmdArea = new CommandArea();
$canalNet = new CanalNetworks();
$objUser = new Users();
$objCanalUser = new CanalUsers();
$objUserCrops = new UsersCrops();
$objCrops = new Crops();
$objTimescale = new Timescale();
$objReports = new Reports();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  
   <!-- CSS scrollbar Files -->
   <link id="pagestyle" href="../assets/css/scrollbar.css" rel="stylesheet" />

  <!-- CSS scrollbar style -->
  <link id="pagestyle" href="../assets/css/scrollbarStyle.css" rel="stylesheet" />




  <script src="../scripts/jquery.min.js"></script>
  <script src="../scripts/bootstrap.min.js"></script>
  <script src="../Highcharts/code/highcharts.js"></script>
  <script src="../Highcharts/code/modules/exporting.js"></script>
  <script src="../Highcharts/code/modules/jquery.highchartTable.js"></script>
</head>


      <?php include("../pages/cropping_pattern_graphs.php");?>
