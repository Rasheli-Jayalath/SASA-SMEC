<!--     making the connection with DB     -->
<?php require_once('../Config/connection.php'); ?>
<?php require_once('../Classes/select_latest_year.php'); ?>
<?php  include '../Classes/check_equality.php';  ?>
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
    <?php include("../includes/nav_header.php");?>
    <!-- End Navbar -->

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
          xmlhttp.open("GET","../Scripts/table_ajax/ajax_user.php?q="+str,true);
          xmlhttp.send();

          }

    </script>

     <?php 
      if(isset($_GET['yr_name']) ){
        $year =  $_GET['yr_name'];
        $yr_name = " AND yr_name = ". $year ;
      }else{
        $year = $default_year;
        $yr_name = " AND yr_name = ". $default_year;
      }
      ?>

      <?php

    // Find out total number of results
    $sql1 = "SELECT * FROM wh_002_users WHERE is_deleted = 0 $yr_name ORDER BY u_id ";
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
        // getting the list of table_user
        if ( isset($_GET['search']) ) {
            $search = mysqli_real_escape_string($connection, $_GET['search']);
            $sql2 = "SELECT * FROM wh_002_users WHERE is_deleted = 0 $yr_name ORDER BY u_id ";
        } else {
            $sql2 = "SELECT * FROM wh_002_users WHERE is_deleted = 0  $yr_name  ORDER BY u_id LIMIT {$start}, {$result_per_page}";
        }
     
 
         $result2 = mysqli_query($connection, $sql2) or die( mysqli_error($connection));
         $num_of_raws = mysqli_num_rows($result2);
         $table = "<table class=\"table align-items-center mb-0\">";
         $table .=       
        " <thead>
        <colgroup>
 
   
                <tr>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Name </th>
                  <th class=\"text-uppercase text-secondary text-xs font-weight-bolder opacity-7\"> Mobile Number </th>
                  <th class=\"text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">Email ID</th>
                  <th class=\" text-uppercase text-secondary text-xs font-weight-bolder opacity-7\">Area</th>
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
                                <h6 class=\"mb-0 text-sm text-xs lh-lg \"> {$row['u_name']} </h6>
                                <p class=\"text-xs text-secondary mb-0\"> {$row['u_business_name']} </p>
                                </div>
                            </div>
                            </td>
                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['u_phone']} </p>
                            </td>

                            <td class=\"align-middle text-center\">
                            <span class=\"text-secondary text-xs font-weight-bold\"> {$row['u_email']} </span>
                            </td>
                            
                            <td>
                            <p class=\"text-xs font-weight-bold mb-0\"> {$row['u_area']} </p>
                            <p class=\"text-xs text-secondary mb-0\"> {$row['u_area_unit']}  </p>
                            </td>

                            <td class=\"align-middle\">           
                             <a class=\"text-xs text-dark me-2 px-2 \" href=\"#\"  onclick=\"myFunction('{$row['u_id']}')\" ><i class=\"fas fa-pencil-alt text-dark \" aria-hidden=\"true\" ></i></a>                 
                            <a class=\"text-xs text-danger text-gradient \" href=\"../Classes/delete/delete_user.php?u_id={$row['u_id']}\" onclick = \"return confirm ('Are you sure you want Delete the Record? ')\"><i class=\"far fa-trash-alt \"></i></a>   

                            </td>
                      </tr>";		
         } 
         $table .= "</tbody>";
         $table .= "</table>";

           // first page
	$first = "<a href=\"table_user.php?p=1&yr_name={$year}\"> <i class=\"fa fa-angle-double-left\"></i>   First  </a>";

	// last page
	$last_page_no = ceil($total_results/$result_per_page);
	$last = "<a href=\"table_user.php?p={$last_page_no}&yr_name={$year}\">Last  <i class=\"fa fa-angle-double-right\"></i></a>";

	// next page
	if ($page_no >= $last_page_no) {
		$next = "<a>Next   <i class=\"fa fa-angle-right\"></i> </a>";
	} else {
		$next_page_no = $page_no + 1;
		$next = "<a href=\"table_user.php?p={$next_page_no}&yr_name={$year}\">Next   <i class=\"fa fa-angle-right\"></i>  </a>";	
	}
	
	// previous page
	if ($page_no <= 1) {
		$prev = "<a><i class=\"fa fa-angle-left\"></i>   Previous</a>";
	} else {
		$prev_page_no = $page_no - 1;
		$prev = "<a href=\"table_user.php?p={$prev_page_no}&yr_name={$year}\"> <i class=\"fa fa-angle-left\"></i>  Previous</a>";	
	}
	
    if($total_results >10){
	   
	 //   $page_nav = 'Number of records : ' . $num_of_raws. ' <br> '.$first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
	    $page_nav =   $first . ' | ' . $prev  . ' | ' . 'Page ' . $page_no . ' of ' . $last_page_no  . ' | ' .  $next . ' | ' . $last;
    }else{
	   $page_nav = 'Number of records : ' . $num_of_raws  ;
   }         
      
      ?>

			
    <div class="container-fluid py-2 mt-4"> 
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

       <!-- footer -->
       <?php include("../includes/footer.php");?>
        
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