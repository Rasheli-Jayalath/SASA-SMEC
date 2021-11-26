<?php 
//========================================
$start_time = microtime(true); //checker
//========================================
error_reporting(0);
include_once("config/config.php");
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
  <title>
    SAS Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.2" rel="stylesheet" />

    <!-- CSS scrollbar Files -->
    <link id="pagestyle" href="assets/css/scrollbar.css" rel="stylesheet" />

  <!-- CSS scrollbar style -->
  <link id="pagestyle" href="assets/css/scrollbarStyle.css" rel="stylesheet" />
  
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
  <script src="Highcharts/code/highcharts.js"></script>
  <script src="Highcharts/code/modules/exporting.js"></script>
  <script src="Highcharts/code/modules/jquery.highchartTable.js"></script>

  <!-- SideBar -->
  <script src="scripts/mainpages.js"></script>

</head>

<body class="g-sidenav-show bg-gray-100">
<div class= "sidebar 	" id="sidenav-main" style="overflow-y: hidden; bottom: 0: display: none;" >
      <?php include("includes/left_menu.php");?>
  </div>
  <main class="main-content mt-1 border-radius-lg" id="main-content">
    <!-- Navbar -->
    <?php include("includes/nav_header.php");?>
    <!-- End Navbar -->


      <!-- ---------- Start content Editing ---------------- -->

    <div class="container-fluid py-2 horizontal-scrollable"> 
       <div class="row">
          <div class="col-12">
                <div class="card mb-4">   
                      <div class="card-body px-0 pt-0 pb-2">    
             
                      <?php include("pages/cropping_pattern_graphs.php");?>

 

          <div class=" horizontal-scrollable scroll" >
          <?php include("pages/cropping_pattern_summary.php");?>
      </div>
  

                      </div>  <!-- card-body px-0 pt-0 pb-2 -->
                </div>  <!-- card mb-4 -->
             </div>    <!--col-12 -->     
             
      
        </div>  <!--row-->

                
          <!-- End content Editing -->

          <footer class="footer pt-3">
            <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-left">
                    © <script>
                    document.write(new Date().getFullYear())
                    </script>
                </div>
                </div>
            </div>
            </div>
      </footer>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.2"></script>
     
</body>

</html>