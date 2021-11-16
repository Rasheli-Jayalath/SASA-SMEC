<!--     making the connection with DB     -->
<?php require_once('../Config/connection.php'); ?>
<?php require_once('../Classes/select_latest_year.php'); ?>
<?php  include '../Classes/check_equality.php';  ?>

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
<?php include("../includes/left_menu1.php");?> 
  <main class="main-content mt-1 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Tables</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Crop Table </li>
          </ol>
          <h5 class="font-weight-bolder mb-0">Crop Table</h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group me-4 ">
              <form action="table_crop.php " method="get" id="filter" name="filter" class="">
                    <label style="font-size:16px;"> <strong>Year:&nbsp;&nbsp;</strong></label>
                    <select id="yr_name" name="yr_name" style="width:100px; height:25px">

                      <?php 
                        $sql = "SELECT * FROM wh_004_year_main ORDER BY yr_name";
                        $result = mysqli_query($connection , $sql);		
                        while ($row = mysqli_fetch_array($result)){
                          $obj = new check_equality();  
                          echo "<option value=".$row['yr_name'] . " ". $obj->_check($row['yr_name'], $latest_year ). ">".$row['yr_name']."</option>";                                                                                 
                        }
                      ?>  
                      
                    </select>
                    <input type="submit" id="go" value="GO"  class="bg-gradient-secondary text-white me-2 "/>
              </form>
           </div>           
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
          xmlhttp.open("GET","../Scripts/table_ajax/ajax_crop.php?q="+str,true);
          xmlhttp.send();

          }

    </script>

    <?php 
      if(isset($_GET['yr_name']) ){
        $year =  $_GET['yr_name'];
        $yr_name = " AND yr_name = ". $year ;
      }else{
        $yr_name = " AND yr_name = ". $latest_year;
      }
      ?>
 
 <?php 
      if(isset($_GET['yr_name']) ){
        $year =  $_GET['yr_name'];
        $yr_name = " AND yr_name = ". $year ;
      }else{
        $yr_name = " AND yr_name = ". $latest_year;
      }
      ?>

      <?php

    // Find out total number of results
    $sql1 = "SELECT * FROM wh_001_crops_main WHERE is_deleted = 0  $yr_name  ORDER BY cr_id ";
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
        // getting the list of table_crop
        if ( isset($_GET['search']) ) {
            $search = mysqli_real_escape_string($connection, $_GET['search']);
            $sql2 = "SELECT * FROM wh_001_crops_main WHERE is_deleted = 0   $yr_name ORDER BY cr_id ";
        } else {
            $sql2 = "SELECT * FROM wh_001_crops_main WHERE is_deleted = 0   $yr_name   ORDER BY cr_id LIMIT {$start}, {$result_per_page}";
        }
     
 
         $result2 = mysqli_query($connection, $sql2) or die( mysqli_error($connection));
         $num_of_raws = mysqli_num_rows($result2);
         $table = "<table class=\"table align-items-center mb-0\">";
         $table .=       
        " <thead>
        <colgroup>
 
   
                <tr>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Crop Name </th>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Lenght of Canal <br>(cr_wat_req)</th>
                  <th class=\"text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Year </th>
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
                                <h6 class=\"mb-0 text-sm text-xs lh-lg \"> {$row['cr_name']} </h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['cr_wat_req']} </p>
                            </td>

                            <td class=\"align-middle text-center\">
                            <span class=\"text-secondary text-xs font-weight-bold\"> {$row['yr_name']} </span>
                            </td>
                            

                            <td class=\"align-middle\">           
                             <a class=\"text-xs text-dark me-2 px-2 \" href=\"#\"  onclick=\"myFunction('{$row['cr_id']}')\" ><i class=\"fas fa-pencil-alt text-dark \" aria-hidden=\"true\" ></i></a>                 
                            <a class=\"text-xs text-danger text-gradient \" href=\"../Classes/delete/delete_crop.php?cr_id={$row['cr_id']}\" onclick = \"return confirm ('Are you sure you want Delete the Record? ')\"><i class=\"far fa-trash-alt \"></i></a>   

                            </td>
                      </tr>";		
         } 
         $table .= "</tbody>";
         $table .= "</table>";

           // first page
	$first = "<a href=\"table_crop.php?p=1\"> <i class=\"fa fa-angle-double-left\"></i>   First  </a>";

	// last page
	$last_page_no = ceil($total_results/$result_per_page);
	$last = "<a href=\"table_crop.php?p={$last_page_no}\">Last  <i class=\"fa fa-angle-double-right\"></i></a>";

	// next page
	if ($page_no >= $last_page_no) {
		$next = "<a>Next   <i class=\"fa fa-angle-right\"></i> </a>";
	} else {
		$next_page_no = $page_no + 1;
		$next = "<a href=\"table_crop.php?p={$next_page_no}\">Next   <i class=\"fa fa-angle-right\"></i>  </a>";	
	}
	
	// previous page
	if ($page_no <= 1) {
		$prev = "<a><i class=\"fa fa-angle-left\"></i>   Previous</a>";
	} else {
		$prev_page_no = $page_no - 1;
		$prev = "<a href=\"table_crop.php?p={$prev_page_no}\"> <i class=\"fa fa-angle-left\"></i>  Previous</a>";	
	}
	
    if($total_results >10){
	   
	 //   $page_nav = 'Number of records : ' . $num_of_raws. ' <br> '.$first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
	    $page_nav =   $first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
    }else{
	   $page_nav = 'Number of records : ' . $num_of_raws  ;
   }         
      
      ?>

			
    <div class="container-fluid py-2 "> 
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
                 <button type="button"  class="btn bg-gradient-success w-50 " onclick="myFunction('0')" > <i class="fas fa-plus text-white pe-2 " aria-hidden="true" ></i>Add new </button>
                <div  id="display_form"  >
                </div> 
              </div> 
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