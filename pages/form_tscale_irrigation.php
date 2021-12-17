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



      $sql = "SELECT * FROM tbl001_year_main WHERE yr_name = '{$year}' ";		
      $check = mysqli_query($connection, $sql);
      
      if (mysqli_num_rows($check) > 0) {

      $message = " ".$year." year records are alreday added !" ."<br>". " Please continue to add more details  ";
      header('Location: form_display.php?msg='.$message.'&year='.$year);
        

        
      } else {
         $query = "INSERT INTO tbl001_year_main  ( ";
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
  <!-- sidebar  -->
  <script src="../scripts/mainpages.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var start_monthID ;
    $('#start_month').on('change', function(){
        start_monthID = $(this).val();
        if(start_monthID){
            $.ajax({
                type:'POST',
                url:'month_ajaxData.php',
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
                url:'month_ajaxData.php',
                data : {starting_month:start_monthID ,ending_month:end_monthID },
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
      <div class="col-md-11 m-auto py-4  bg-gradient-secondary">
           <div class="col-md-11 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-11 m-auto py-4  ">            

                <form action="#" method="post" class="text-white align-self-auto" enctype="multipart/form-data" autocomplete="off">
                        <h5 class="text-center pb-2">Proposed irrigation schedule period for <?php echo $default_year; ?>  </h5>
<div class="row pb-1">
<div class="col-md-4">
    <div class="form-group">
    Select the Crop Name  : &nbsp; 
       <select  name="cr_id" class="form-select move-on-hover" required>
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
      <select  name=" " class="form-select move-on-hover" id="start_month" required>
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
      <select  name=" " class="form-select move-on-hover" id="end_month" required>
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