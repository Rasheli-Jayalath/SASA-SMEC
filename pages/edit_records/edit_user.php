  <!--     making the connection with DB     -->
  <?php require_once('../../Config/connection.php'); ?>
  <?php  include '../../classes/check_equality.php';  ?>
  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    SAS Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.2" rel="stylesheet" />   
  <!-- CSS scrollbar style -->
  <link id="pagestyle" href="../../assets/css/scrollbarStyle.css" rel="stylesheet" />

    <!-- Hide and show button -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
</head>

<body class="g-sidenav-show   bg-gray-100">


      <!-- ---------- Start content Editing ---------------- -->
      

		
         <!-- Display message  -->
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



<script>
$(document).ready(function(){
  $("#hide_iframe").click(function(){
    $("#py-4").hide();
  });

});
</script>

<?php 

	$errors = array();
	$u_id = '';
	$u_name = '';
	$u_business_name = '';
	$u_phone = '';
	$u_area = '';
	$u_area_unit = '';
	$u_email = '';
	$yr_name = '';

	
		if (isset($_GET['id'])  && $_GET['id'] >0 ) {
			
		// getting record information
		$u_id = mysqli_real_escape_string($connection, $_GET['id']);
		$query = "SELECT * FROM wh_002_users WHERE u_id = {$u_id} LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$u_name = $result['u_name'];
				$u_business_name = $result['u_business_name'];
				$u_phone = $result['u_phone'];
				$u_area = $result['u_area'];
				$u_area_unit = $result['u_area_unit'];
				$u_email = $result['u_email'];
				$yr_name = $result['yr_name'];

				
			} else {
				// record not found
				header('Location: edit_user_table.php?err=record_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: edit_user_table.php?err=query_failed');
		}

	}

?>

			
    <div class=" py-4 " id = "py-4">    
    <button id="hide_iframe" type="button"  class=" float-end btn bg-gradient-dark btn-sm me-1 btn-lg" aria-label="Close"> Close <i class="far fa-times-circle "></i> </button>          
        <div class=" py-4  bg-gradient-secondary">
           <div class="py-4 border border-secondary rounded mt-3">

               <?php
                if(isset($_GET['id'])   && $_GET['id'] >0  ){ 
                  $u_id= $_GET['id']   ;
                    echo "<h5 class=\" offset-1 text-dark fw-bolder me-2\"> Modify the record </h5>" ;
                    echo " <h6 class=\" text-end text-dark me-2\">";
                    echo "[u_id - ".$u_id."] <br>"; 
                    echo "[year - ".$yr_name."]";
                    echo " </h6>";
                  }else{
                    echo "<h5 class=\" offset-1 text-dark fw-bolder me-2\"> Adding new record </h5>" ;
                  } ?>  
              <div class="  py-4 ms-2 me-2">

                <form action="../../classes/save/user_table_save.php?u_id= <?php echo $u_id ?>"  method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">

                  <div class = "form-group">
                      <input type="text" name="u_name"         minlength="2" maxlength="30"   <?php echo 'value="' . $u_name . '"'; ?>   placeholder="User Name "                   required  class="form-control move-on-hover" >
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="u_business_name"    minlength="2" maxlength="30"    <?php echo 'value="' . $u_business_name . '"'; ?>  placeholder="Business Name"                required  class="form-control" >
                    </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="u_phone"    minlength="2" maxlength="20"    <?php echo 'value="' . $u_phone . '"'; ?>  placeholder="Phone number"                 required  class="form-control \" >
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="u_email"    minlength="2" maxlength="30"    <?php echo 'value="' . $u_email . '"'; ?>  placeholder="Email ID`"                    required  class="form-control \" >
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="u_area"    minlength="2" maxlength="20"   <?php echo 'value="' . $u_area . '"'; ?>   placeholder="Total Area to be irrigated"   required  class="form-control \" >
                      <span class="input-group-text">         
                          <select name="u_area_unit" class="form-select move-on-hover"  style = "width: 150px;"  >
                          <option value="Hectare"  <?php $obj = new check_equality(); echo $obj->_check('Hectare',   $u_area_unit ); ?>>   Hectare    </option>
                          <option value="Acre"     <?php $obj = new check_equality(); echo $obj->_check('Acre',      $u_area_unit ); ?>>      Acre    </option>
                          <option value="Sqr KM"   <?php $obj = new check_equality(); echo $obj->_check('Sqr KM',    $u_area_unit ); ?>>   Sqr KM     </option>
                          <option value="Sqr yard" <?php $obj = new check_equality(); echo $obj->_check('Sqr yard',  $u_area_unit ); ?>>  Sqr yard    </option>     
                        </select>
                     </span>
                  </div>

                   <button type="submit" name="submit" value="submit" class="btn bg-gradient-dark btn-lg  m-auto">Save</button>

              
                </form>


              </div>
            </div>
          </div>
          
          <!-- End content Editing -->


    </div>


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