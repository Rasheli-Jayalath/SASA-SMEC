<?php require_once('../Config/connection.php'); ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var start_monthID ;
    var crop_nameID ;

    $('#cr_id').on('change', function(){
      crop_nameID = $(this).val();
      if(crop_nameID){
        document.getElementById('start_month').removeAttribute('disabled');  
        document.getElementById('end_month').removeAttribute('disabled');  
      }
    }); 

    $('#start_month').on('change', function(){
        start_monthID = $(this).val();
        if(start_monthID){
            $.ajax({
                type:'POST',
                url:'month_ajaxData_ir_sch.php',
                data:'start_month_id='+start_monthID,
                success:function(html){
                    $('#end_month').html(html);
                    $('#city').html('<div> </div>'); 
                }
            }); 
        }else{
            $('#end_month').html('<option value="">Select start_month first</option>');
            $('#city').html('<div> </div>'); 
        }
    });
    
    $('#end_month').on('change', function(){
        var end_monthID = $(this).val();
        if(end_monthID){
            $.ajax({
                type:'POST',
                url:'month_ajaxData_ir_sch.php',
                data : {starting_month:start_monthID ,ending_month:end_monthID , IDcrop_name:crop_nameID },
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<div> </div>'); 
        }
    });
});
</script>
  <div class= "sidebar 	" id="sidenav-main" style="overflow-y: hidden; bottom: 0: display: none;" >
        <?php include("../includes/left_menu1.php");?>
  </div>
  <main class="main-content mt-1 border-radius-lg" id="main-content">
    <!-- Navbar -->
    <?php include("../includes/nav_header_forms.php");?>
    <!-- End Navbar -->



  <div class="container-fluid py-4 ">      
        <!-- alert -->
        <?php include("../includes/success_message.php");?>

      <div class="col-md-11 m-auto py-4  bg-gradient-secondary"  style=" background-image: linear-gradient(rgba(98, 117, 148,0.9), rgba(168, 184, 216,0.9)), url('../assets/img/home.jpg');" >
           <div class="col-md-11 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-11 m-auto py-4  ">            

                <form action="" method="post" class="text-white align-self-auto" enctype="multipart/form-data" autocomplete="off">
                        <h5 class="text-center pb-2">Manage Proposed irrigation schedule period <?php echo $default_year; ?>   </h5>
                        <button class="btn btn-sm text-xs text-dark bg-gradient btn-success p-2 float-end" style="" type="button"   >
                        <a href="form_tscale_irri_sch.php"><i class="fas fa-redo"></i>  &nbsp;  Refresh </a></button>
<div class="row pb-1">
<div class="col-md-4">
    <div class="form-group">
    Select the Crop Name  : &nbsp; 
       <select  name="cr_id" class="form-select move-on-hover" id="cr_id" required >
          <option value="">Select...</option>
          <?php 
          $sql = "SELECT * FROM wh_001_crops_main  WHERE yr_name = $default_year  ORDER BY cr_id ";
          $result = mysqli_query($connection , $sql);		
          while ($row = mysqli_fetch_array($result)){
          echo "<option value=".$row['cr_id'].">".$row['cr_name']."</option>";                                                   
          }
          ?>       
       </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
    Select Start Month : &nbsp; 
    <!-- start_month dropdown -->
      <select  name="start_month" class="form-select move-on-hover" id="start_month" required disabled>
         <option value="">Select Start Month</option>
         <?php 
          $default_year = 2020;
          $a= array("","January","February","March","April","May","June","July","August","September", "October", "November", "December"); 
          $max=sizeof($a);
          for($i=1; $i<$max; $i++) { 
          echo '<option value="'.$i.'">'.$a[$i] ." ".$default_year.'</option>'; 
          }
        ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
    Select End Month: &nbsp; 
      <select  name="end_month" class="form-select move-on-hover" id="end_month" required disabled>
         <option value="">Select start month first</option>
      </select>
    </div>
  </div>
</div>
<div class="border opacity-3"> </div>

<div class=" pt-3" id="city">

</div>

                  <button type="submit" name="submit" value="submit" class="btn bg-gradient-dark btn-lg"> Continue </button>

                  
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