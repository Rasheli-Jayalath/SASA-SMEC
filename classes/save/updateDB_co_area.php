<!--     making the connection with DB     -->
  <?php require_once('../../Config/connection.php'); ?>
  <?php  include '../functions.php';  ?>


<?php 

if (isset($_POST['submit']) AND isset($_GET['year']) ) {   //clicked save button
    $errors = array();

    $ca_parent_id = $_POST['main_comp_id'];
    $ca_code = '';
	$ca_name = $_POST['ca_name'];
	$ca_area = $_POST['ca_area'];
    $ca_area_unit = $_POST['ca_area_unit'];
    $yr_name = $_GET['year'];

    if($ca_parent_id>0){  //subca_name

        $obj = new functions() ;
        $count = $obj->_countRecords($ca_parent_id);
        $number = ($ca_parent_id*100) + $count;
        $ca_code = 'CA0'.$number ;

    }else{  // main ca_name

        $obj = new functions() ;
        $count = $obj->_countRecords($ca_parent_id);
        $number = ($count*100) ;
        $ca_code = 'CA0'.$number ;

    }


  

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
			$query .= "ca_name, ca_area_unit, ca_area, yr_name, ca_parent_id, ca_code ";
			$query .= ") VALUES (";
			$query .= "'{$ca_name}', '{$ca_area_unit}', '{$ca_area}', '{$yr_name}', '{$ca_parent_id}', '{$ca_code}' ";
			$query .= ")";

			$result = mysqli_query($connection, $query);
			

      $message= '';
			if ($result) {
			  $message .= ' All records are successfully added !!';
			  header('Location: ../../pages/index.php?msg='.$message.'&status=true');
			} else {
        $errors[] = 'Failed to add the new record.';
			}     								
	
		}

    if (!empty($errors)) {
    $errors[] = 'Failed to add the new record.';
    $message .= '<b>There were error(s) on your form.</b><br>';
    foreach ($errors as $error) {
      $error = ucfirst(str_replace("_", " ", $error));
      $message .= '- ' . $error . '<br>';
    }
    header('Location: ../../pages/form_details.php?msg='.$message.'&status=false &year='.$yr_name);
  }



}

?>
