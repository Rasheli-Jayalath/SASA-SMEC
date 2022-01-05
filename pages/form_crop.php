  <!--     making the connection with DB     -->
<?php require_once('../Config/connection.php'); ?>
<?php  include '../Config/getting_year.php';  ?>


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

      <!----------------------- Start content Editing -------------------------->

      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();
    
        $ca_name = $_POST['ca_name'];
    
            // checking required fields
        $req_fields = array('ca_name', 'ca_area_unit', 'ca_area');
    
        foreach ($req_fields as $field) {
          if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
          }
        }
        
        // checking max length
        $max_len_fields = array('ca_name' => 30, 'ca_area_unit' =>30, 'ca_area' => 10);
    
        foreach ($max_len_fields as $field => $max_len) {
          if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
          }
        }
        
        // checking min length
        $min_len_fields = array('ca_name' => 2, 'ca_area_unit' =>2, 'ca_area' => 1);
        foreach ($min_len_fields as $field => $min_len) {
          if (strlen(trim($_POST[$field])) < $min_len) {
            $errors[] = $field . ' must be more than ' . $min_len . ' characters';
          }
        }
        
        if (!(is_numeric($ca_area))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


      if (empty($errors)) {

		    $query = "INSERT INTO wh_000_command_area ( ";
        $query .= "yr_name, ca_area_unit, ca_area, yr_name, ca_parent_id, ca_code ";
        $query .= ") VALUES (";
        $query .= "'{$year}', '{$ca_area_unit}', '{$ca_area}', '{$yr_name}', '{$ca_parent_id}', '{$ca_code}' ";
        $query .= ")";

        $result = mysqli_query($connection, $query);
        if (!$result) {
          $errors[] = 'Failed to add the new record';
        }     								
      }

      if (!empty($errors)) {
          $message .= '<b>There were error(s) on your form.</b><br>';
            foreach ($errors as $error) {
              $error = ucfirst(str_replace("_", " ", $error));
              $message .= '- ' . $error . '<br>';
              
              header('Location: user_table.php?msg='.$message.'&status=false');
            }
      }else{
          $message .= ' All records are successfully added !!';
          echo $message;
          header('Location: index.php?msg='.$message.'&status=true');
      }

    }
      
      ?>
		      	
			
    <div class="container-fluid py-4 ">      
              <!-- alert -->
              <?php include("../includes/success_message.php");?>
                
        <div class="col-md-6 m-auto py-4  bg-gradient-secondary" style=" background-image: linear-gradient(rgba(98, 117, 148,0.9), rgba(168, 184, 216,0.9)), url('../assets/img/home.jpg');" >
           <div class="col-md-10 m-auto py-4 border border-secondary rounded ">
              <div class="col-md-10 m-auto py-4  ">

                <form action="../Classes/save/crop_table_save.php"  method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">

                  <div class = "form-group">
                      <input type="text" name="cr_name"         minlength="2" maxlength="10"     placeholder="Crop Name "         required  class="form-control move-on-hover" >
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="cr_wat_req"    minlength="2" maxlength="30"     placeholder="Lenght of Canal (cr_wat_req)"    required  class="form-control" >
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