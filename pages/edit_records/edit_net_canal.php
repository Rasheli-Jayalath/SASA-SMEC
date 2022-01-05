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

  <main class="main-content mt-1 border-radius-lg">

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
  xmlhttp.open("GET","../../Scripts/net_canal_control.php?q="+str,true);
  xmlhttp.send();

  
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
  xmlhttp.open("GET","../../Scripts/net_canal_control_ter.php?ca_id="+ ca_id +"&second="+str,true);
  xmlhttp.send();


}

    </script>


<script>
$(document).ready(function(){
  $("#hide_iframe").click(function(){
    $("#py-4").hide();
  });

});
</script>

<?php 

	$errors = array();
  $ca_id ='';
	$nc_id = '';
	$nc_name = '';
	$nc_type = '';
	$nc_conveyance_coeff = '';
	$nc_length = '';
	$nc_length_unit = '';
	$nc_volume = '';
	$nc_volume_unit = '';
  $nc_flow_capacity = '';
	$nc_flow_unit = '';
  $nc_command_area = '';
	$nc_command_area_unit = '';

	
		if (isset($_GET['id'])  && $_GET['id'] >0 ) {
			
		// getting record information
		$nc_id = mysqli_real_escape_string($connection, $_GET['id']);
		$query = "SELECT * FROM wh_000_network_canals WHERE nc_id = {$nc_id} LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
        $ca_id = $result['ca_id'];
				$nc_name = $result['nc_name'];
				$nc_type = $result['nc_type'];
				$nc_conveyance_coeff = $result['nc_conveyance_coeff'];
				$nc_length = $result['nc_length'];
				$nc_length_unit = $result['nc_length_unit'];
				$nc_volume = $result['nc_volume'];
        $nc_volume_unit = $result['nc_volume_unit'];
				$nc_flow_capacity = $result['nc_flow_capacity'];
        $nc_flow_unit = $result['nc_flow_unit'];
        $nc_command_area = $result['nc_command_area'];
        $nc_command_area_unit = $result['nc_command_area_unit'];
      

				
			} else {
				// record not found
				header('Location: edit_net_canal.php?err=record_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: edit_net_canal.php?err=query_failed');
		}

	}

?>
						
        <!-- alert -->
        <?php include("../../includes/success_message.php");?>		
        
    <div class=" py-4 " id = "py-4">    
       <button id="hide_iframe" type="button"  class=" float-end btn bg-gradient-dark btn-sm me-1 btn-lg" aria-label="Close"> Close <i class="far fa-times-circle "></i> </button>              
          <div class=" py-4  bg-gradient-secondary">
            <div class="py-4 border border-secondary rounded mt-3">
                  <?php
                  if(isset($_GET['id'])   && $_GET['id'] >0  ){ 
                      $nc_id= $_GET['id']  ;
                    echo "<h5 class=\" offset-1 text-dark fw-bolder me-2\"> Modify the record </h5>" ;
                    echo " <h6 class=\" text-end text-dark me-2\">";
                    echo "[network canal ID - ".$nc_id."] <br>"; 
                    echo " </h6>";
                  }else{
                    echo "<h5 class=\" offset-1 text-dark fw-bolder me-2\"> Adding new record </h5>" ;
                  } ?>  
            

              <div class="  py-4 ms-2 me-2">
                <form action="../../classes/save/save_network_canal.php?nc_id=<?php echo $nc_id ?>" method="post" class="text-white" enctype="multipart/form-data" autocomplete="off">
                
                  <div class = "form-group">

                  Select the Main component : &nbsp; 
                      <select onchange="yesnoCheck(this.value);"  name="main_comp_id" class="form-select move-on-hover" required>
                          <option value="">Select...</option>
                                <?php 
                                     $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id=0 ORDER BY ca_id";
                                     $result = mysqli_query($connection , $sql);
                                     
                                  while ($row = mysqli_fetch_array($result)){
                                    $obj = new check_equality(); 		
                                    echo "<option value=".$row['ca_id'] . " ". $obj->_check($row['ca_id'], $ca_id ). ">".$row['ca_name']."</option>";                      
   
                                  }
                                ?>       
                      </select>

                  </div>

 
                  <div id="txtHint">  </div>


                  <div class = "form-group">
                      <input type="text" name="nc_name"   minlength="1" maxlength="30"  <?php echo 'value="' . $nc_name . '"'; ?>   placeholder="Canal Name "        required  class="form-control move-on-hover" >
                  </div>

                  <div class = "form-group">


                      Canal type : &nbsp; 
                      <select name="nc_type" class="form-select move-on-hover"  onchange="checking(this.value);" required>
                        <option value="">            Select...   </option>
                        <option value="Secondary"  <?php $obj = new check_equality(); echo $obj->_check('Secondary',  $nc_type ); ?>>   Secondary    </option>
                        <option value="Tertiary"   <?php $obj = new check_equality(); echo $obj->_check('Tertiary',   $nc_type ); ?>>    Tertiary    </option>
                        <option value="Quaternary" <?php $obj = new check_equality(); echo $obj->_check('Quaternary', $nc_type ); ?>>  Quaternary    </option>
                        <option value="Aggregate"  <?php $obj = new check_equality(); echo $obj->_check('Aggregate',  $nc_type ); ?>>   Aggregate    </option>                              
                      </select>

                  </div>
                  <div id="canal_type_option">  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_length"        minlength="1" maxlength="15" <?php echo 'value="' . $nc_length . '"'; ?>    placeholder="length of Canal"    required  class="form-control" >
                      <span class="input-group-text">meters</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_volume"        minlength="1" maxlength="15" <?php echo 'value="' . $nc_volume . '"'; ?>    placeholder="Volume of canal"    required  class="form-control " >
                      <span class="input-group-text">cubic meter</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_flow_capacity" minlength="1" maxlength="15"  <?php echo 'value="' . $nc_flow_capacity . '"'; ?>   placeholder="Flow capacity`"     required  class="form-control " >
                      <span class="input-group-text">m3/sec</i></span>
                  </div>

                  <div class = "form-group input-group  move-on-hover">
                      <input type="text" name="nc_command_area"  minlength="1" maxlength="15"  <?php echo 'value="' . $nc_command_area . '"'; ?>   placeholder="Area"               required  class="form-control " >
                      <span class="input-group-text">Hectare</i></span>
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