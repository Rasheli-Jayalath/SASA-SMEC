<?php 

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

  <style>

            div.scroll { 
                margin: 4px, 4px; 
                padding: 4px; 
                width: 1200px; 
                overflow: auto; 
                white-space: nowrap; 

            } 
        </style>

</head>

<body class="g-sidenav-show   bg-gray-100">
  
  <?php include("includes/left_menu.php");?>
    
  <main class="main-content mt-1 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <?php ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4 ">
      <?php include("pages/top_indicators.php"); ?>
      <?php include("pages/graphs.php");?>



      <div class="col-lg-12 horizontal-scrollable scroll" >
      <h5 class="font-weight-bolder mb-0">Canal-Wise Water Distribution Plan </h5>
      <?php  include("pages/main_report.php");?>

        </div>


      <?php include("pages/footer.php");?>
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