<?php 
include_once("../config/config.php");
  $dbconn =       new Database();
  $objCmdArea =   new CommandArea();
  $canalNet =     new CanalNetworks();
  $objUser =      new Users();
  $objCanalUser = new CanalUsers();
  $objUserCrops = new UsersCrops();
  $objCrops =     new Crops();
  $objTimescale = new Timescale();
  $objReports =   new Reports();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    SAS Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.2" rel="stylesheet" />
  
  <!-- CSS scrollbar style -->
  <link id="pagestyle" href="assets/css/scrollbarStyle.css" rel="stylesheet" />
  
  <!-- CSS scrollbar style -->
  <link id="pagestyle" href="../assets/css/scrollbarStyle.css" rel="stylesheet" />
  
  <!-- sidebar  -->
  <script src="../scripts/mainpages.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class= "sidebar 	" id="sidenav-main" style="overflow-y: hidden; bottom: 0: display: none;" >
        <?php include("../includes/left_menu1.php");?>
  </div>
  <main class="main-content mt-1 border-radius-lg" id="main-content">
    <!-- Navbar -->
    <?php include("../includes/nav_header_forms.php");?>
    <!-- End Navbar -->


      <!-- Start content Editing -->
      <?php

if(isset($_GET['msg']) AND isset($_GET['status']) ){  

  if($_GET['status'] == 'true'){
  echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
  echo "<span class=\"alert-icon\"><i class=\"ni ni-like-2\"></i></span>";
  echo "<span class=\"alert-text\"><strong> ";
  echo $_GET['msg'];               
  echo "</strong> ";
  echo "</span>";
  echo " <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\">";
  echo " <span aria-hidden=\"true\">&times;</span>";
  echo "</button>";
  echo "</div>";
} else{
  echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"aler\">";
  echo "<span class=\"alert-icon\"><i class=\"ni ni-bell-55\"></i></span>";
  echo "<span class=\"alert-text\"><strong>";
  echo " </strong> ";
  echo $_GET['msg']; 
  echo "</span>";
  echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\">";
  echo " <span aria-hidden=\"true\">&times;</span>";
  echo "</button>";
  echo "</div>";

}}

?>

  <div class="container-fluid py-4 ">        
      <div class="col-md-8 m-auto py-4  bg-gradient-secondary">
           <div class="col-md-8 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-8 m-auto py-4 text-center">            

                <button class="btn bg-gradient-light btn-lg "> <a href = "form_year.php">           Year Form              </a></button>
                <button class="btn bg-gradient-light btn-lg "> <a href = "form_net_canal.php">       Network Canal Form     </a></button>
                <button class="btn bg-gradient-light btn-lg "> <a href = "form_crop.php">          Crop Table Form        </a></button>
                <button class="btn bg-gradient-light btn-lg "> <a href = "form_user.php">          User Table Form        </a></button>
                <button class="btn bg-gradient-light btn-lg "> <a href = "form_user_canal.php">    User Canal Form        </a></button>
                <button class="btn bg-gradient-light btn-lg "> <a href = "form_user_crop.php">     User Crop Table Form   </a></button>

              </div>
          </div>
      </div>
   
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.2"></script>
</body>

</html>