<!--     making the connection with DB     -->
  <?php require_once('../../Config/connection.php'); ?>
  <?php  //include '../Config/getting_year.php';  ?>

      
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();

        $cr_id ='';
        if( isset($_GET['cr_id'])   ){
          $cr_id = $_GET['cr_id'] ;
        }     
        if( isset($_GET['yr_name'])   ){
          $year = $_GET['yr_name'] ;
        }
    
    
        $cr_name =       $_POST['cr_name'];
        $cr_wat_req =    $_POST['cr_wat_req'];

        $message = '';
    
            // checking required fields
        $req_fields = array('cr_name', 'cr_wat_req');
    
        foreach ($req_fields as $field) {
          if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
          }
        }
        
        // checking max length
        $max_len_fields = array('cr_name' => 30, 'cr_wat_req' =>30,);
    
        foreach ($max_len_fields as $field => $max_len) {
          if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
          }
        }
        
        // checking min length
        $min_len_fields = array('cr_name' => 2, 'cr_wat_req' =>2);
        foreach ($min_len_fields as $field => $min_len) {
          if (strlen(trim($_POST[$field])) < $min_len) {
            $errors[] = $field . ' must be more than ' . $min_len . ' characters';
          }
        }
        
        if (!(is_numeric($cr_wat_req))) {
          $errors[] = 'Enter a numeric value to Area.';
        }


      if (empty($errors)) {

        if (!isset($_GET['cr_id']) || $cr_id<=0 ) { 

          $query = "INSERT INTO wh_001_crops_main ( ";
          $query .= "yr_name,     cr_name,      cr_wat_req";
          $query .= ") VALUES (";
          $query .= "'{$cr_name}', '{$cr_name}', '{$cr_wat_req}'";
          $query .= ")";


        
       }else if( isset($_GET['cr_id'])   ){
        $query = " UPDATE wh_001_crops_main SET ";

        $query .= "cr_name = '{$cr_name}', ";        
        $query .= "cr_wat_req = '{$cr_wat_req}' ";
      
        $query .= " WHERE cr_id = {$cr_id}";


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