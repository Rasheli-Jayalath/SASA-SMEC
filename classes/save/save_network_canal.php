<!--     making the connection with DB     -->
<?php require_once('../../Config/connection.php'); ?>
<?php  include '../functions_Net.php';  ?>
<?php 

if (isset($_POST['submit'])  ) {   //clicked save button
    $errors = array();
    $message= ' ';

    $nc_id ='';
    if( isset($_GET['nc_id'])   ){
      $nc_id = $_GET['nc_id'] ;
    }

    $ca_id = $_POST['main_comp_id'];
	  $nc_name = $_POST['nc_name'];
    $canal_type = $_POST['nc_type'];
  	$nc_length = $_POST['nc_length'];
    $nc_length_unit = 'meter';
    $nc_volume = $_POST['nc_volume'];
    $nc_volume_unit = 'cubic meter';
    $nc_flow_capacity = $_POST['nc_flow_capacity'];
    $nc_flow_unit = 'm3/sec';
    $nc_command_area = $_POST['nc_command_area'];
    $nc_command_area_unit = 'Hectare';
    $sub_comp_id = '';
    $nc_conveyance_coeff = 0.8;

    if (isset($_POST['sub_comp_id'])  ) {
      $sub_comp_id = $_POST['sub_comp_id'];
     }
    
    $nc_code = 'NC'.sprintf('%02d', $ca_id) ; //NC 01 -- -- --   
    $secondary   = 0 ;
    $tertiary    = 0 ;
    $Quaternary  = 0 ;

    $obj = new functions() ;
    $Quaternary .= $obj->_countRecords_net($canal_type, $ca_id);
    $count = strlen($Quaternary);

    if($count<=3){       // User have select Quaternary
        if  (isset($_POST['parent_tertiary'])  ) {
          $tertiary_comp_id = $_POST['parent_tertiary'];
          $secondary = substr($tertiary_comp_id, 4,2);
        }else if (isset($_POST['sub_comp_id'])  ) {
          $secondary = substr($sub_comp_id, -2);
        }else{
          $secondary = 00 ;
        }
   
        if (isset($_POST['parent_tertiary'])  ) {
          $tertiary_comp_id = $_POST['parent_tertiary'];
          $tertiary = substr($tertiary_comp_id, 6,2);
        }else{
          $tertiary = 00 ;
        }

         $nc_code.= $secondary . $tertiary. $Quaternary;

      }else if ($count <=5){   // User have select tertiary or Aggregate
        if (isset($_POST['sub_comp_id'])  ) {
          $secondary = substr($sub_comp_id, -2);
        }else{
          $secondary = 00 ;
        }
        $nc_code.= $secondary .$Quaternary;
        
      }else if ($count <=7){   // User have select secondary

        $nc_code.= $Quaternary;

      }

    		// checking required fields
		$req_fields = array('nc_name','nc_length','nc_volume','nc_flow_capacity','nc_command_area');

		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				$errors[] = $field . ' is required';
			}
		}
		
		// checking max length
		$max_len_fields = array('nc_name' => 30, 'nc_length' =>30, 'nc_volume' => 10);

		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . ' must be less than ' . $max_len . ' characters';
			}
		}
		
		// checking min length
		$min_len_fields = array('nc_name' => 1, 'nc_length' =>1, 'nc_volume' => 1);
		foreach ($min_len_fields as $field => $min_len) {
			if (strlen(trim($_POST[$field])) < $min_len) {
				$errors[] = $field . ' must be more than ' . $min_len . ' characters';
			}
		}

    		// Getting Integer inputs
        if (!(is_numeric($nc_length))) {
          $errors[] = 'Enter a numeric value to Length of Canal.';
        }
        if (!(is_numeric($nc_volume))) {
          $errors[] = 'Enter a numeric value to Volume of Canal.';
        }
        if (!(is_numeric($nc_flow_capacity))) {
          $errors[] = 'Enter a numeric value to Flow Capacity.';
        }
        if (!(is_numeric($nc_command_area))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


	
        if (isset($_POST['sub_comp_id'])  ) {
          $sub_comp_id = substr($sub_comp_id, 5,2);
         }
       
		if (empty($errors)) {
      if (!isset($_GET['nc_id']) || $nc_id<=0 ) { 
        $query = "INSERT INTO tbl000_network_canals ( ";
        $query .= "ca_id, nc_code, nc_name, nc_type, nc_length, nc_length_unit, nc_volume, nc_volume_unit, nc_flow_capacity, nc_flow_unit, nc_command_area, nc_command_area_unit, nc_conveyance_coeff, ca_sub_id";
        $query .= ") VALUES (";
        $query .= "'{$ca_id}','{$nc_code}','{$nc_name}','{$canal_type}','{$nc_length}','{$nc_length_unit}','{$nc_volume}','{$nc_volume_unit}','{$nc_flow_capacity}','{$nc_flow_unit}','{$nc_command_area}','{$nc_command_area_unit}' ,'{$nc_conveyance_coeff}','{$sub_comp_id}'";
        $query .= ")";

      }else if( isset($_GET['nc_id'])   ){

        $query = " UPDATE tbl000_network_canals SET ";

        $query .= "ca_id = '{$ca_id}', ";        
        $query .= "nc_code = '{$nc_code}', ";
        $query .= "nc_name = '{$nc_name}', ";
        $query .= "nc_type = '{$nc_type}', ";
        $query .= "nc_length = '{$nc_length}', ";
        $query .= "nc_length_unit = '{$nc_length_unit}', ";
        $query .= "nc_volume = '{$nc_volume}', ";
        $query .= "nc_volume_unit = '{$nc_volume_unit}', ";
        $query .= "nc_flow_capacity = '{$nc_flow_capacity}', ";
        $query .= "nc_flow_unit = '{$nc_flow_unit}', ";
        $query .= "nc_command_area = '{$nc_command_area}', ";
        $query .= "nc_command_area_unit = '{$nc_command_area_unit}', ";
        $query .= "nc_conveyance_coeff = '{$nc_conveyance_coeff}', ";
        $query .= "ca_sub_id = '{$ca_sub_id}' ";
      
        $query .= " WHERE nc_id = {$nc_id}";

     }
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
          header('Location: ../../Includes/success_message.php?msg='.$message.'&status=false');
        }
  }else{
    $message .= ' All records are successfully added !!';
    if (isset($_GET['cr_id'])  ) { 
      header('Location: ../../Includes/success_message.php?msg='.$message.'&status=true');
    }else{
      header('Location: ../../index.php?msg='.$message.'&status=true');
    }
  }
}
?>