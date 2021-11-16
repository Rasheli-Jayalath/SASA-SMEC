<!--     making the connection with DB     -->
<?php require_once('../../Config/connection.php'); ?>
<?php  include '../../Config/getting_year.php';  ?>

      
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();

        $u_id ='';
        if( isset($_GET['u_id'])   ){
          $u_id = $_GET['u_id'] ;
        }

        $u_name =             $_POST['u_name'];
        $u_business_name =    $_POST['u_business_name'];
        $u_phone =            $_POST['u_phone'];
        $u_email =            $_POST['u_email'];
        $u_area =             $_POST['u_area'];
        $u_area_unit =        $_POST['u_area_unit'];
        $message = '';
    
            // checking required fields
        $req_fields = array('u_name', 'u_business_name', 'u_phone', 'u_email', 'u_area' );
    
        foreach ($req_fields as $field) {
          if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
          }
        }
        
        // checking max length
        $max_len_fields = array('u_name' => 30, 'u_business_name' =>30, 'u_phone' => 20, 'u_email' => 30 , 'u_area' => 20  );
    
        foreach ($max_len_fields as $field => $max_len) {
          if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
          }
        }
        
        // checking min length
        $min_len_fields = array('u_name' => 2, 'u_business_name' =>2, 'u_phone' => 1);
        foreach ($min_len_fields as $field => $min_len) {
          if (strlen(trim($_POST[$field])) < $min_len) {
            $errors[] = $field . ' must be more than ' . $min_len . ' characters';
          }
        }
        
        if (!(is_numeric($u_area))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


      if (empty($errors)  ) {
      
        if (!isset($_GET['u_id']) || $u_id<=0 ) { 

          $query = "INSERT INTO wh_002_users ( ";
          $query .= "yr_name,     u_name,      u_business_name,      u_phone,      u_email,       u_area,      u_area_unit";
          $query .= ") VALUES (";
          $query .= "'{$year}', '{$u_name}', '{$u_business_name}', '{$u_phone}', '{$u_email}', '{$u_area}', '{$u_area_unit}' ";
          $query .= ")";


        
       }else if( isset($_GET['u_id'])   ){

          $query = " UPDATE wh_002_users SET ";

          $query .= "u_name = '{$u_name}', ";        
          $query .= "u_business_name = '{$u_business_name}', ";
          $query .= "u_phone = '{$u_phone}', ";
          $query .= "u_area = '{$u_area}', ";
          $query .= "u_area_unit = '{$u_area_unit}', ";
          $query .= "u_email = '{$u_email}' ";
		    
          $query .= " WHERE u_id = {$u_id}";

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
              
              header('Location: edit_records/success_message.php?msg='.$message.'&status=false');
            }
      }else{
          $message .= ' All records are successfully added !!';
          if (isset($_GET['u_id'])  ) { 
            header('Location: edit_records/success_message.php?msg='.$message.'&status=true');
          }else{
            header('Location: index.php?msg='.$message.'&status=true');
          }
        
      }

    }
      
      ?>