
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
<?php require_once('../Classes/select_latest_year.php'); ?>
<?php  include '../Classes/check_equality.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>  SAS Management System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">


  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">


      <!-- ---------- Start content Editing ---------------- -->
      <script>
          function myFunction(str) {
         
            if (str=="") {
            document.getElementById("display_form").innerHTML="";
            return;
          }
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("display_form").innerHTML=this.responseText;
            }
          }
          xmlhttp.open("GET","../Scripts/table_ajax/ajax_net_canal.php?q="+str,true);
          xmlhttp.send();

          }

    </script>

    <?php 
      if(isset($_GET['yr_name']) ){
        $year =  $_GET['yr_name'];
        $yr_name = " AND yr_name = ". $year ;
      }else{
        $year = $default_year;
        $yr_name = " AND yr_name = ". $latest_year;
      }
      ?>
 

      <?php

    // Find out total number of results
    $sql1 = "SELECT * FROM wh_000_network_canals WHERE is_deleted = 0   $yr_name ORDER BY nc_id ";
    $result1 = mysqli_query($connection, $sql1) or die( mysqli_error($connection));
    $total_results = mysqli_num_rows($result1);
    
    
    // Define How many
    $result_per_page =  10;
    
    
     if (isset($_GET['p'])) {
         $page_no = $_GET['p'];
     } else {
         $page_no = 1;
     } 
    $start = ($page_no -1)* $result_per_page;
        $search = '';
        // getting the list 
        if ( isset($_GET['search']) ) {
            $search = mysqli_real_escape_string($connection, $_GET['search']);
            $sql2 = "SELECT * FROM wh_000_network_canals WHERE is_deleted = 0   $yr_name ORDER BY nc_id ";
        } else {
            $sql2 = "SELECT * FROM wh_000_network_canals WHERE is_deleted = 0   $yr_name ORDER BY nc_id LIMIT {$start}, {$result_per_page}";
        }
     
 
         $result2 = mysqli_query($connection, $sql2) or die( mysqli_error($connection));
         $num_of_raws = mysqli_num_rows($result2);
         $table = "<table class=\"table align-items-center mb-0\">";
         $table .=       
        " <thead>
        <colgroup>
 
   
                <tr>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Network Canal </th>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">  Length </th>
                  <th class=\"text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Volume </th>
                  <th class=\" text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">Flow <br>Capacity</th>
                  <th class=\" text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">Area</th>
                  <th class=\" text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">coeff</th>

                  <th class=\"text-secondary text-xs opacity-7\"> Edit / Delete </th>
                </tr>
                </colgroup>
              </thead>";
              $table .= "<tbody>";
      
         while ($row = mysqli_fetch_array($result2)){
             $table .= "<tr>
                            <td>
                            <div class=\"d-flex px-2 py-1 \">
                    
                                <div class=\"d-flex flex-column justify-content-center\">
                                <h6 class=\"mb-0 text-sm text-xs lh-lg \"> {$row['nc_name']} </h6>
                                <p class=\"text-xs text-secondary mb-0\"> {$row['nc_type']} </p>
                                </div>
                            </div>
                            </td>
                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['nc_length']} </p>
                            <p class=\"text-xs text-secondary mb-0\"> {$row['nc_length_unit']} </p>
                            </td>

                            <td class=\"align-middle text-center\">
                            <span class=\"text-secondary text-xs font-weight-bold\"> {$row['nc_volume']} </span>
                            <p class=\"text-xs text-secondary mb-0\"> {$row['nc_volume_unit']} </p>
                            </td>
                            
                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['nc_flow_capacity']} </p>
                            <p class=\"text-xs text-secondary mb-0\"> {$row['nc_flow_unit']}  </p>
                            </td>

                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['nc_command_area']} </p>
                            <p class=\"text-xs text-secondary mb-0\"> {$row['nc_command_area_unit']}  </p>
                            </td>

                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['nc_conveyance_coeff']} </p>
                            </td>

                            <td class=\"align-middle\">           
                             <a class=\"text-xs text-dark me-2 px-2 \" href=\"#\"  onclick=\"myFunction('{$row['nc_id']}')\" ><i class=\"fas fa-pencil-alt text-dark \" aria-hidden=\"true\" ></i></a>                 
                            <a class=\"text-xs text-danger text-gradient \" href=\"../Classes/delete/delete_net_canal.php?nc_id={$row['nc_id']}\" onclick = \"return confirm ('Are you sure you want Delete the Record? ')\"><i class=\"far fa-trash-alt \"></i></a>   

                            </td>
                      </tr>";		
         } 
         $table .= "</tbody>";
         $table .= "</table>";

           // first page
	$first = "<a href=\"table_net_canal.php?p=1&yr_name={$year}\"> <i class=\"fa fa-angle-double-left\"></i>   First  </a>";

	// last page
	$last_page_no = ceil($total_results/$result_per_page);
	$last = "<a href=\"table_net_canal.php?p={$last_page_no}&yr_name={$year}\">Last  <i class=\"fa fa-angle-double-right\"></i></a>";

	// next page
	if ($page_no >= $last_page_no) {
		$next = "<a>Next   <i class=\"fa fa-angle-right\"></i> </a>";
	} else {
		$next_page_no = $page_no + 1;
		$next = "<a href=\"table_net_canal.php?p={$next_page_no}&yr_name={$year}\">Next   <i class=\"fa fa-angle-right\"></i>  </a>";	
	}
	
	// previous page
	if ($page_no <= 1) {
		$prev = "<a><i class=\"fa fa-angle-left\"></i>   Previous</a>";
	} else {
		$prev_page_no = $page_no - 1;
		$prev = "<a href=\"table_net_canal.php?p={$prev_page_no}&yr_name={$year}\"> <i class=\"fa fa-angle-left\"></i>  Previous</a>";	
	}  
	
    if($total_results >10){
	   
	 //   $page_nav = 'Number of records : ' . $num_of_raws. ' <br> '.$first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
	    $page_nav =   $first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
    }else{
	   $page_nav = 'Number of records : ' . $num_of_raws  ;
   }         
      
      ?>

 <div class="wrapper">

  <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="200" width="200">
  </div>  -->
  <!-- / End Preloader -->



  <!-- Main left Sidebar Container -->
  <?php include("../includes/left_menu2.php");?>
 <!-- End Main left Sidebar Container -->


 <div class="container-fluid">
   <!-- Main Header  Navbar -->

    <?php include("../includes/main_header.php");?>
 
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper " style="margin-top: 60px;">
  
    <!-- Content Header (Page header) -->
    <div class="content-header" style="margin-top: -10px; margin-bottom: -10px;">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="row">
          <div class="col-8">
                <div class="card mb-4">   
                      <div class="card-body px-0 pt-0 pb-2">    
                            <div class="table-responsive p-0">   
                                          <?php echo $table; ?>
                             </div> <!-- table-responsive p-0 -->

                            <nav aria-label="Page navigation example" class="py-2 float-end me-4 text-end \">
                                <ul class="pagination">
                                    <li class="page-item opacity-9 text-xs font-weight-bolder ">
                                    <?php echo $page_nav; ?>
                                    </li>
                                </ul>
                            </nav>

                      </div>  <!-- card-body px-0 pt-0 pb-2 -->
                </div>  <!-- card mb-4 -->
             </div>    <!--col-8 -->     
             
             <div class="col-4"  >
                 <button type="button"  class="btn bg-gradient-success w-50 " onclick="myFunction('0')" > <i class="fas fa-plus text-white mr-2 " aria-hidden="true" ></i>Add new </button>
                <div  id="display_form"  >
                </div> 
              </div> 
        </div>  <!--row-->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <!-- page footer -->
  <?php include("../includes/footer.php");?>
  <!-- /.page footer -->

  </div> 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
