<?php require_once('../Config/connection.php'); ?>

  <?php



  $current_year = "2021";
  $year = "";
  $num_of_days = "";
  $year_status = 0;
  $message = "";

  if(isset($_POST['submit']) )
  {
      $year = $_POST['form_year'];  //asigning user input year
      $year_status = $_POST['yr_status']; 



      $sql = "SELECT * FROM wh_004_year_main WHERE yr_name = '{$year}' ";		
      $check = mysqli_query($connection, $sql);
      
      if (mysqli_num_rows($check) > 0) {

      $message = " ".$year." year records are alreday added !" ."<br>". " Please continue to add more details  ";
      header('Location: form_display.php?msg='.$message.'&year='.$year);
        

        
      } else {
         $query = "INSERT INTO wh_004_year_main  ( ";
         $query .= "yr_name, yr_status";
         $query .= ") VALUES (";
         $query .= "'{$year}', '{$year_status}' ";
         $query .= ")";  
         $result = mysqli_query($connection, $query);
          
        if ($result) {
              // query successful... redirecting to form page
              $day31 = array(1, 3, 5,7,8,10,12);
              $day30 = array(4,6,9,11);

          for ($x = 1; $x <= 12; $x++) {  // for 12 months
                if(in_array($x, $day31)){
                  $num_of_days= 31;
                }else if(in_array($x, $day30)){
                  $num_of_days= 30;
                }else if($x==2){
                  $num_of_days= 28;
                  if(((int)$year%4)==0){
                      // Check leap year which hyas 366 days
                      $num_of_days= 29;
                    }
                }
            $n = 9;
            for($i = 10; $i <= $num_of_days ; $i+=$n){
                
                $ts_days="";
                $ts_month = $x;

                if($i<=10){
                  $ts_period =  '01-10';
                  $ts_days="10";
                }else if($i<20){
                  $ts_period =   '11-20';
                  $ts_days="10";
                }else {
                  $i=20;
                  $ts_period =  '21-';
                  $ts_days= $num_of_days- $i;
                  $i=32;
                }

                $query = "INSERT INTO wh_001_tscale_main  ( ";
                $query .= "ts_period, ts_days, ts_month, yr_name";
                $query .= ") VALUES (";
                $query .= " '{$ts_period}{$num_of_days}','{$ts_days}','{$ts_month}','{$year}' ";
                $query .= ")";
                $resul_ts_scale = mysqli_query($connection, $query);
            }    
          }
        } else {
              echo'Failed to add the new record.';
        } 

        $message = " ".$year." new records added !" ."<br>". "Please continue to add more details  ";
        header('Location: form_display.php?msg='.$message.'&year='.$year);
                                                     
      }
      
  }

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
  <link id="pagestyle" href="../assets/css/scrollbarStyle.css" rel="stylesheet" />
</head>
   
<body class="g-sidenav-show   bg-gray-100">
<?php 

 include("../includes/left_menu1.php");
?> 
  <main class="main-content mt-1 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Forms</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Year form</li>
          </ol>
          <h5 class="font-weight-bolder mb-0">Year Form</h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
            </li>
          </ul> 
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

	    <div class="border"></div>

      <!-- Start content Editing -->



  <div class="container-fluid py-4 ">        
      <div class="col-md-6 m-auto py-4  bg-gradient-secondary">
           <div class="col-md-8 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-8 m-auto py-4  ">            

                <form action="form_year.php" method="post" class="text-white align-self-auto" enctype="multipart/form-data" autocomplete="off">
                   <div class="form-group ">
                        <p>
                        <h6>Year : </h6>
                            <select name="form_year" class="form-select move-on-hover " required>
                                <option value="">Select Year...</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            </p>
                  </div>
                  <div class="status-radio py-4 ">
                            Year status :
                            <input type="radio" class="" name="yr_status" value=0 checked> INACTIVE
                            <input type="radio" class=""  name="yr_status" value=1>  ACTIVE
                  </div>

                
                  <button type="submit" name="submit" value="submit" class="btn bg-gradient-dark btn-lg"> Continue </button>

                  
                </form>


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