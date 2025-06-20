<?php  include '../Config/getting_year.php';  ?>
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
  <link  href="../assets/css/scrollbarStyle.css" rel="stylesheet" />
  
 <!-- sidebar  -->
 <script src="../scripts/mainpages.js"></script>
 <style>
.column {
  float: left;
  width: 50%;

  
}
.column-1 {
  padding-right: 2%;
}
.column-2 {
  padding-left: 2%;
}
</style>
</head>

<body class="g-sidenav-show   bg-gray-100">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#ca_main').on('change', function(){
        var caID = $(this).val();
        if(caID){
            $.ajax({
                type:'POST',
                url:'../scripts/ajaxData.php',
                data:'ca_id='+caID,
                success:function(html){
                    $('#secondary').html(html);
                    $('#tertiary').html('<option value="">Select Secondary-canal  first</option>'); 
                }
            }); 
            $.ajax({
                type:'POST',
                url:'../scripts/ajaxData2.php',
                data:'ca_id='+caID,
                success:function(html){
                    $('#txtHint').html(html);
           
                }
            });
        }else{
            $('#txtHint').html('<div></div>');
            $('#secondary').html('<option value="">Select Main Command-area first</option>');
            $('#tertiary').html('<option value="">Select Secondary-canal first</option>'); 
            $('#quaternary').html('<option value="">Select Tertiary-canal first</option>'); 
        }
    });
    
    $('#secondary').on('change', function(){
        var secondaryID = $(this).val();
        if(secondaryID){
            $.ajax({
                type:'POST',
                url:'../scripts/ajaxData.php',
                data:'nc_id='+secondaryID,
                success:function(html){
                    $('#tertiary').html(html);
                }
            }); 
        }else{
            $('#tertiary').html('<option value="">Select Secondary-canal first</option>'); 
            $('#quaternary').html('<option value="">Select Tertiary-canal first</option>'); 
        }
    });


    $('#tertiary').on('change', function(){
        var tertiaryID = $(this).val();
        if(tertiaryID){
            $.ajax({
                type:'POST',
                url:'../scripts/ajaxData.php',
                data:'nc_id_tertiary='+tertiaryID,
                success:function(html){
                    $('#quaternary').html(html);
                }
            }); 
        }else{
            $('#quaternary').html('<option value="">Select Quaternary-canal first</option>'); 
        }
    });

});


</script>


<div class= "sidebar 	" id="sidenav-main" style="overflow-y: hidden; bottom: 0: display: none;" >
      <?php include("../includes/left_menu1.php");?>
  </div>
  <main class="main-content mt-1 border-radius-lg" id="main-content">
    <!-- Navbar -->
    <?php include("../includes/nav_header.php");?>
    <!-- End Navbar -->
	
  <div class="container-fluid py-3 " >    
            <!-- alert -->
            <?php include("../includes/success_message.php");?>
                
      <div class="col-md-11 m-auto py-4  bg-gradient-secondary" style="height:610px;  background-image: linear-gradient(rgba(98, 117, 148,0.9), rgba(168, 184, 216,0.9)), url('../assets/img/home.jpg');">
           <div class="col-md-11 m-auto py-4 border border-secondary rounded " style="height:102%;" >
              <div class="col-md-11 m-auto   ">

                <form action="../Classes/save/user_and_crops.php"  method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">
                <h5 class="text-center text-gradient  text-dark text-uppercase opacity-9 font-weight-bold pb-2 mt-n2" >Manage User and Crops for <?php echo $default_year; ?>  </h5>
                <div class="column column-1 col-md-12 " >

                <div class = "form-group col-md-12">
                      Select the Users Name  : &nbsp; 
                          <select  name="u_id" class="form-select move-on-hover" required>
                              <option value="">Select...</option>
                                    <?php 
                                        $sql = "SELECT * FROM wh_002_users WHERE yr_name = $default_year  ORDER BY `u_name` ASC";
                                        $result = mysqli_query($connection , $sql);		
                                      while ($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['u_id'].">".$row['u_name']."</option>";                      
                                      }
                                    ?>       
                          </select>
                </div>

                  <div class = "form-group col-md-12" >
                     Main Command Area : &nbsp; 
                          <select id="ca_main" name="ca_id" class="form-select move-on-hover"  onchange="yesnoCheck(this.value);" required>
                          <option value="">Select Main Command Area</option>
                              <?php 
                                 // Fetch all the ca_main data 
                          $query = "SELECT * FROM wh_000_command_area WHERE ca_parent_id = 0 AND yr_name= '$default_year' ORDER BY ca_name ASC"; 
                          $result = $connection->query($query); 

                              if($result->num_rows > 0){ 
                                  while($row = $result->fetch_assoc()){  
                                      echo '<option value="'.$row['ca_id'].'">'.$row['ca_name'].'</option>'; 
                                  } 
                              }else{ 
                                  echo '<option value="">Main Command Area not available</option>'; 
                              } 
                              ?>
                              
                          </select>
                  </div>
                  
                  <div class = "form-group col-md-12" id="txtHint">
                 
                  </div>
                  <div class = "form-group col-md-12" >
                       Secondary Canal : &nbsp; 
                          <select id="secondary" name="secondary" class="form-select move-on-hover" required>
                              <option value="">Select Main Command-area first</option>
                          </select>
                  </div>

                  <div class = "form-group col-md-12" >
                      Tertiary Canal : &nbsp; 
                          <select id="tertiary" name="tertiary" class="form-select move-on-hover" >
                             <option value="">Select Secondary-canal first</option>
                          </select>
                  </div>

                  <div class = "form-group col-md-12" >
                     Quaternary Canal: &nbsp; 
                          <select id="quaternary" name="quaternary" class="form-select move-on-hover" >
                             <option value="">Select Tertiary-canal first</option>
                          </select>
                  </div>

                 </div>
  <div class="column column-2 col-md-12">
                   <div class = "form-group col-md-12 ">
                      Select the Crop Name  : &nbsp; 
                          <select  name="cr_id" class="form-select move-on-hover" required>
                              <option value="">Select...</option>
                                    <?php 
                                        $sql = "SELECT * FROM wh_001_crops_main  WHERE yr_name = $default_year  ORDER BY cr_id";
                                        $result = mysqli_query($connection , $sql);		
                                      while ($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['cr_id'].">".$row['cr_name']."</option>";                      
                                            
                        
                                      }
                                    ?>       
                          </select>
                  </div>


                  <div class = "form-group col-md-12 input-group  move-on-hover">
                      <input type="number" name="uc_area"   min="0"  minlength="1" maxlength="10"    placeholder="Total Area to be irrigated"     class="form-control \" >
                      <span class="input-group-text" style = " padding:0; ">

                        <select name="uc_area_unit" class="form-select move-on-hover text-xs" style = "width: 150px;"  required>
                            <option value="Hectare">   Hectare    </option>
                            <option value="Acre">      Acre       </option>
                            <option value="Sqr KM ">   Sqr KM     </option>
                            <option value="Sqr yard">  Sqr yard   </option>                              
                        </select>
  
                      </span>
                  </div>


                  <div class="row col-md-12 pt-5  justify-content-center"  >
          <button class="btn btn-success text-dark text-center " style= "width: 70%"type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i class="fas fa-plus"></i> Add second crop
          </button>
                                    </div>
             <div style="height: 220px;"> 
            <div class="collapse " id="collapseExample">
                              <div class = "form-group col-md-12">
                                  Select the Crop Name  : &nbsp; 
                                      <select  name="cr_id_second" class="form-select move-on-hover" >
                                          <option value="">Select...</option>
                                                <?php 
                                                    $sql = "SELECT * FROM wh_001_crops_main WHERE yr_name = $default_year  ORDER BY cr_id";
                                                    $result = mysqli_query($connection , $sql);		
                                                  while ($row = mysqli_fetch_array($result)){
                                                    echo "<option value=".$row['cr_id'].">".$row['cr_name']."</option>";                      
                                                        
                                    
                                                  }
                                                ?>       
                                      </select>
                              </div>  



                              <div class = "form-group col-md-12 input-group  move-on-hover">
                                  <input type="number" name="uc_area_second"   min="0"  minlength="1" maxlength="10"     placeholder="Total Area to be irrigated"     class="form-control \" >
                                  <span class="input-group-text" style = " padding:0; ">

                                    <select name="uc_area_unit_second" class="form-select move-on-hover text-xs" style = "width: 150px; "  >
                                        <option value="Hectare">   Hectare    </option>
                                        <option value="Acre">      Acre       </option>
                                        <option value="Sqr KM ">   Sqr KM     </option>
                                        <option value="Sqr yard">  Sqr yard   </option>                              
                                    </select>
              
                                  </span>
                              </div>
            </div>
            </div>  
            <button type="submit" style ="width: 50%; float:right; " name="submit" value="submit" class="btn bg-gradient-dark  ">Save</button>
 
 
        </div>
        

     </form>

                </div>   
              </div>
            </div>
          </div>
                                               
          <!-- End content Editing -->

       <!-- footer -->
       <?php include("../includes/footer.php");?>
        
  
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