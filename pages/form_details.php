  <!--     making the connection with DB     -->
  <?php require_once('../Config/connection.php'); ?>

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
      <!-- Start content Editing -->
      <?php 
      if(isset($_GET['year']) ){
        $year =  $_GET['year'];
          }		  
      ?>
		
		<script language="Javascript">

			function show(){			
				document.getElementById("B").style.visibility="visible";    
			}
			
			function hide(){
				document.getElementById("B").style.visibility="hidden";
			}

		</script>
			
      <?php

if(isset($_GET['msg']) AND isset($_GET['status']) ){  


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

}

?>

    <div class="container-fluid py-4 ">        
        <div class="col-md-6 m-auto py-4  bg-gradient-secondary">
           <div class="col-md-10 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-10 m-auto py-4  ">
                  <form action="../Classes/save/updateDB_co_area.php?year= <?php echo $year ?>"  method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">

                    <div class = "form-group">
                              <input type="text" name="ca_name"   minlength="2" maxlength="30"     placeholder="Component/Sub-component"  required  class="form-control move-on-hover" >
                      </div>

                      <div class = "form-group">
                            <label for="">Type: </label>
                            <input type="radio" onchange="hide(this)" name="aorb" checked> Main Component
                            <input type="radio" onchange="show(this)" name="aorb">  Sub-component
                    </div>

                      <div id="B" style="visibility:hidden" class = "form-group">

                            <?php
                              $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id=0 ORDER BY ca_id";
                              $result = mysqli_query($connection , $sql);
                            ?>
                          Select the Main component : &nbsp; 
                          <select name="main_comp_id" class="form-select move-on-hover" required>
                          <option value="0">Select...</option>
                              <?php 		
                                while ($row = mysqli_fetch_array($result)){
                                  echo "<option value=".$row['ca_id'].">".$row['ca_name']."</option>";
                                }
                              ?>        
                        </select>

                      </div>
                      <div class = "form-group">
                            <input type="text" name="ca_area"        minlength="2" maxlength="10"     placeholder="Total area "         required  class="form-control move-on-hover" >
                            </div>
                            <div class = "form-group">
                            <input type="text" name="ca_area_unit"        minlength="2" maxlength="30"     placeholder="Unit"                     required  class="form-control move-on-hover" >
                            </div>

                          
                            
                            
                            <button type="submit" name="submit" value="submit" class="btn bg-gradient-dark btn-lg  m-auto">Save</button>
                        
                            
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