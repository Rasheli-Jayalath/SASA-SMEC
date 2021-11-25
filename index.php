<?php 

include_once("config/config.php");
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
              
                overflow: auto; 
                white-space: nowrap; 

            } 

            .sidebar {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  overflow-x: hidden;
  transition: 0.5s;

}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}
#main {
  transition: margin-left .5s;
  padding: 16px;
  margin-left: 210px
}
.rotate{
    -moz-transition: all 0.4s linear;
    -webkit-transition: all 0.4s linear;
    transition: all 0.4s linear;
}

.rotate.down{
    -moz-transform:rotate(360deg);
    -webkit-transform:rotate(360deg);
    transform:rotate(360deg);
}

.button-rotate {  
  padding: 0;
  margin: 0;
  margin-right: 10px;
  border: none;
  background-color: transparent;
  transform: rotate(360deg);
  transition: transform 0.5s;
}

.button-rotate:active {
  transform: rotate(0deg);
  transition:  0s;
}



        </style>
<script>
function changeme(id) {
  var other = document.getElementById(id == 'first' ? 'second' : 'second');
  if (/s/i.test(other.innerHTML)) {
    other.innerHTML = other.innerHTML.replace('s', '-');
      document.getElementById("sidenav-main").style.width = "250px";
  document.getElementById("main").style.marginLeft = "210px";
  } else {
    other.innerHTML = other.innerHTML.replace('-', 's');
      document.getElementById("sidenav-main").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("line-chart").style.width = "120%";
  }
}



</script>
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class= "sidebar" id="sidenav-main" style="overflow-y: hidden;">
  <?php include("includes/left_menu.php");?>
          </div>
  <main class="main-content border-radius-lg" id="main">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          
          <div class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          

      <button  id="second" style="display:none;"> -</button>
      <button onclick="changeme(this.id);" class="button-rotate ml-2" > <i class="fa fa-bars" aria-hidden="true"></i></button>
      <div class=" d-none d-xl-block " >
     
      <span class="text-dark font-weight-bold " style="">SMEC Agriculture Water Management System - Water Management System - Sri Lanka</span>
    </div>
            
</div>
          
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
            <form action="" method="get" id="filter" name="filter" >
       <label style="padding-left:15px; font-size:16px;"> <strong>Year:&nbsp;&nbsp;</strong></label><select id="yr_name" name="yr_name" style="width:100px; height:25px">
      <?php 
	  $objTimescale->getYears();
	  while($yrows=$objTimescale->dbFetchArray())
	  {?>
      <option value="<?php echo $yrows["yr_name"];?>" <?php if($default_year==$yrows["yr_name"]){ ?>  selected="selected" <?php }?>>
	  <?php echo $yrows["yr_name"];?></option>
      <?php  }?>
      </select>
       <input type="submit" id="go" value="GO"  />
       </form>
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
    <div class="container-fluid py-4 ">
      <?php include("pages/top_indicators.php"); ?>
      <?php include("pages/graphs.php");?>

      <div class=" horizontal-scrollable scroll mb-3" style="max-height: 420px; overflow: hidden; margin:auto;" >
      <iframe class ="" src="includes/chart1.php?yr_name= <?php echo $default_year; ?> " id="line-chart" style = "width: 104%; height: 600px; overflow-y: hidden; margin-left: -4%; "  frameBorder="0"></iframe>
 

        </div>

      <div class=" horizontal-scrollable scroll" >
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