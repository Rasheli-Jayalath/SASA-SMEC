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
  xmlhttp.open("GET","../Scripts/net_canal_control.php?q="+str,true);
  xmlhttp.send();

      if (str != null ) {    
                     
          document.getElementById("ifYes").style.display = "block";
      } else {
          document.getElementById("ifYes").style.display = "none";
      }
  
  }

  function checking(str) {

    if (str=="") {
    document.getElementById("canal_type_option").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("canal_type_option").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","../Scripts/net_canal_control_ter.php?ca_id="+ ca_id +"&second="+str,true);
  xmlhttp.send();

      if (str != null ) {    
                     
          document.getElementById("Ter").style.display = "block";
      } else {
          document.getElementById("Ter").style.display = "none";
      }
}

    </script>
						

    <div class="container-fluid py-4 ">        
              <!-- alert -->
              <?php include("../includes/success_message.php");?>
              
        <div class="col-md-6 m-auto py-4  bg-gradient-secondary"  style=" background-image: linear-gradient(rgba(98, 117, 148,0.9), rgba(168, 184, 216,0.9)), url('../assets/img/home.jpg');" >
           <div class="col-md-10 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-10 m-auto py-4  ">

                <form action="../Classes/save/save_network_canal.php" method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">
                
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
                      <input type="text" name="nc_name"          minlength="1" maxlength="30"     placeholder="Canal Name "        required  class="form-control move-on-hover" >
                  </div>

                  <div class = "form-group">


                      Canal type : &nbsp; 
                      <select name="nc_type" class="form-select move-on-hover"  onchange="checking(this.value);" required>
                        <option value="">            Select...   </option>
                        <option value="Secondary">   Secondary   </option>
                        <option value="Tertiary">    Tertiary    </option>
                        <option value="Quaternary">  Quaternary  </option>
                        <option value="Aggregate">   Aggregate   </option>                              
                      </select>

                  </div>
                  <div id="canal_type_option">  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_length"        minlength="1" maxlength="15"     placeholder="length of Canal"    required  class="form-control" >
                      <span class="input-group-text">meters</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_volume"        minlength="1" maxlength="15"     placeholder="Volume of canal"    required  class="form-control " >
                      <span class="input-group-text">cubic meter</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_flow_capacity" minlength="1" maxlength="15"     placeholder="Flow capacity`"     required  class="form-control " >
                      <span class="input-group-text">m3/sec</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_command_area"  minlength="1" maxlength="15"     placeholder="Area"               required  class="form-control " >
                      <span class="input-group-text">Hectare</i></span>
                  </div>

                   <button type="submit" name="submit" value="submit" class="btn bg-gradient-dark btn-lg  m-auto">Save</button>             
                </form>
             </div>
            </div>
          </div>
          
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