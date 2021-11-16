<!--     making the connection with DB     -->
<?php require_once('../../Config/connection.php'); ?>
<?php  include '../Config/getting_year.php';  ?>
      
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();

        $ucp_id ='';
        if( isset($_GET['ucp_id'])   ){
          $ucp_id = $_GET['ucp_id'] ;
        }

        $ucp_area =             $_POST['ucp_area'];
        $cr_id    =             $_POST['cr_id'];
        $uc_id     =             $_POST['uc_id'];
        
        $ucp_area_unit =        $_POST['u_area_unit'];
        $message = '';
    
            // checking required fields
        $req_fields = array('ucp_area', 'cr_id', 'uc_id');
    
        foreach ($req_fields as $field) {
          if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
          }
        }
        
        // checking max length
        $max_len_fields = array('ucp_area' => 30);
    
        foreach ($max_len_fields as $field => $max_len) {
          if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
          }
        }
        
        // checking min length
        $min_len_fields = array('ucp_area' => 1);
        foreach ($min_len_fields as $field => $min_len) {
          if (strlen(trim($_POST[$field])) < $min_len) {
            $errors[] = $field . ' must be more than ' . $min_len . ' characters';
          }
        }
        
        if (!(is_numeric($ucp_area))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


      if (empty($errors)) {
        if (!isset($_GET['ucp_id']) || $ucp_id<=0 ) { 
          $query = "INSERT INTO wh_002_users_crops ( ";
          $query .= "yr_name,     ucp_area,      ucp_area_unit,       uc_id,       cr_id";
          $query .= ") VALUES (";
          $query .= "'{$year}', '{$ucp_area}', '{$ucp_area_unit}' , '{$uc_id}' , '{$cr_id}'";
          $query .= ")";
        }else if( isset($_GET['ucp_id'])   ){

          $query = " UPDATE wh_002_users_crops SET ";

          $query .= "uc_id = '{$uc_id}', ";        
          $query .= "cr_id = '{$cr_id}', ";
          $query .= "ucp_area = '{$ucp_area}', ";
          $query .= "ucp_area_unit = '{$ucp_area_unit}', ";
          $query .= "yr_name = '{$yr_name}' ";
		    
          $query .= " WHERE ucp_id = {$ucp_id}";

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
              
              header('Location: user_crop_table.php?msg='.$message.'&status=false');
            }
      }else{
        $message .= ' All records are successfully added !!';
        if (isset($_GET['ucp_id'])  ) { 
          header('Location: edit_records/success_message.php?msg='.$message.'&status=true');
        }else{
          header('Location: index.php?msg='.$message.'&status=true');
        }
      
      }

    }
      
      ?>