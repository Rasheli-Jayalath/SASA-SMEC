<!--     making the connection with DB     -->
<?php require_once('../../Config/connection.php'); ?>
<?php  include '../Config/getting_year.php';  ?>
      
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();
        
        $uc_id ='';
        if( isset($_GET['uc_id'])   ){
          $uc_id = $_GET['uc_id'] ;
        }

        $uc_area =             $_POST['uc_area'];
        $uc_area_unit =        $_POST['u_area_unit'];
        $u_id         =        $_POST['user_id'];
        $message = '';
        $nc_id = $_POST['nc_id']; ;

   
    
            // checking required fields
        $req_fields = array('uc_area');
    
        foreach ($req_fields as $field) {
          if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
          }
        }
        
        // checking max length
        $max_len_fields = array('uc_area' => 30);
    
        foreach ($max_len_fields as $field => $max_len) {
          if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
          }
        }
        
        // checking min length
        $min_len_fields = array('uc_area' => 2);
        foreach ($min_len_fields as $field => $min_len) {
          if (strlen(trim($_POST[$field])) < $min_len) {
            $errors[] = $field . ' must be more than ' . $min_len . ' characters';
          }
        }
        
        if (!(is_numeric($uc_area))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


      if (empty($errors)) {
        if (!isset($_GET['uc_id']) || $uc_id<=0 ) { 
          $query = "INSERT INTO wh_002_users_canal ( ";
          $query .= "yr_name,     uc_area,      uc_area_unit,         u_id,    nc_id ";
          $query .= ") VALUES (";
          $query .= "'{$year}', '{$uc_area}', '{$uc_area_unit}' , '{$u_id}', '{$nc_id}'  ";
          $query .= ")";

        }else if( isset($_GET['uc_id'])   ){

          $query = " UPDATE wh_002_users_canal SET ";

          $query .= "nc_id = '{$nc_id}', ";        
          $query .= "u_id = '{$u_id}', ";
          $query .= "uc_area = '{$uc_area}', ";
          $query .= "uc_area_unit = '{$uc_area_unit}', ";
          $query .= "yr_name = '{$yr_name}' ";
		    
          $query .= " WHERE uc_id = {$uc_id}";

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
              
              header('Location: user_canal_table.php?msg='.$message.'&status=false');
            }
      }else{
        $message .= ' All records are successfully added !!';
        if (isset($_GET['uc_id'])  ) { 
          header('Location: edit_records/success_message.php?msg='.$message.'&status=true');
        }else{
          header('Location: index.php?msg='.$message.'&status=true');
        }
      }

    }
      
      ?>