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
      <!---------------- Start content Editing ---------------------->


      <script  type="text/javascript">
            var ca_id ;
          
          function yesnoCheck(str) {
            ca_id = str;
            if (str=="") {
            document.getElementById("txtHint").innerHTML="";
            return;
          }
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("txtHint").innerHTML=this.responseText;
            }
          }
          xmlhttp.open("GET","../Scripts/user_canal_table_control.php?q="+str,true);
          xmlhttp.send();

              if (str != null ) {    
                            
                  document.getElementById("ifYes").style.display = "block";
              } else {
                  document.getElementById("ifYes").style.display = "none";
              }
          
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
   
                <form action="../Classes/save/user_canal_table_save.php?"  method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">

                  <div class = "form-group">

                      Select the Main component : &nbsp; 
                        <select onchange="yesnoCheck(this.value);"  name="main_comp_id" class="form-select move-on-hover" required>
                            <option value="">Select...</option>
                                  <?php 
                                      $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id=0 ORDER BY ca_id";
                                      $result = mysqli_query($connection , $sql);		
                                    while ($row = mysqli_fetch_array($result)){
                                      echo "<option value=".$row['ca_id'].">".$row['ca_name']."</option>";                      
                                          
                      
                                    }
                                  ?>       
                        </select>

                  </div>
                  <div id="txtHint">  </div>

                  <div class = "form-group">
                      Select the Users Name  : &nbsp; 
                          <select  name="user_id" class="form-select move-on-hover" required>
                              <option value="">Select...</option>
                                    <?php 
                                        $sql = "SELECT * FROM wh_002_users  ORDER BY u_id";
                                        $result = mysqli_query($connection , $sql);		
                                      while ($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['u_id'].">".$row['u_name']."</option>";                      
                                            
                        
                                      }
                                    ?>       
                          </select>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="uc_area"    minlength="2" maxlength="30"     placeholder="Total Area to be irrigated"   required  class="form-control \" >
                      <span class="input-group-text">
                        
                      <select name="u_area_unit" class="form-select move-on-hover" style = "width: 150px;"  >
                            <option value="Hectare">   Hectare    </option>
                            <option value="Acre">      Acre       </option>
                            <option value="Sqr KM ">   Sqr KM     </option>
                            <option value="Sqr yard">  Sqr yard   </option>                              
                        </select>
  
                      </span>
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