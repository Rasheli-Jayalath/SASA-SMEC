<!--     making the connection with DB     -->
  <?php require_once('../../Config/connection.php'); ?>
  <?php  include '../get_uc_id.php';  ?>
  <?php  //include '../Config/getting_year.php';  ?>
      
  
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();
        $uc_id = '';
        $nc_id = 0;
        $year = 2020;
        
          $u_id         = $_POST['u_id'] ;
          $ca_id        = $_POST['ca_id'] ;
          $cr_id        = $_POST['cr_id'] ;
          $uc_area      = $_POST['uc_area'] ;
          $uc_area_unit  = $_POST['uc_area_unit'] ;

        if( isset($_GET['yr_name'])   ){
          $year = $_GET['yr_name'] ;
        }
    
       // NC_ID
        if       (isset($_POST['quaternary'])){
          $nc_id =      $_POST['quaternary'] ;

        }else if( isset($_POST['tertiary'])){
          $nc_id =      $_POST['tertiary'] ;

        }else if( isset($_POST['secondary'])){
          $nc_id =      $_POST['secondary'] ; 
        }


        $message = '';
    
        $sql = "SELECT * FROM wh_002_users_canal WHERE nc_id = '".$nc_id."' AND u_id = $u_id ";
        $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
        $num_of_raws = mysqli_num_rows($result);
        if($num_of_raws>0  ){
          $row = mysqli_fetch_array($result);
          $uc_id = $row['uc_id'];
          $query = " UPDATE wh_002_users_canal SET ";
          $query .= "uc_area = uc_area+'{$uc_area}' ";     
          $query .= " WHERE uc_id = {$uc_id}";
          $result_sql = mysqli_query($connection, $query);
          if (!$result_sql) {
            $errors[] = 'Failed1 to add the new record';
          } 
        }else{
          $nc_id = 202020;
          $query = "INSERT INTO wh_002_users_canal ( ";
          $query .= "yr_name,     u_id,      nc_id,     uc_area,       uc_area_unit";
          $query .= ") VALUES (";
          $query .= "'{$year}', '{$u_id}', '{$nc_id}', '{$uc_area}', '{$uc_area_unit}' ";
          $query .= ")";
          $result_sql = mysqli_query($connection, $query);
          if (!$result_sql) {
            $errors[] = "Failed2 to add the new record yr-".$year ." u-id-".$u_id ." nc-id-".$nc_id ." uc-a-".$uc_area. " u-".$uc_area_unit;
          } 
        }


      if (empty($errors)) {

        $obj = new Get_uc_id();
        $uc_id = $obj->_check( $u_id, $nc_id) ; 

        $query  = "INSERT INTO wh_002_users_crops ( ";
        $query .= "yr_name,     uc_id,      cr_id,     ucp_area,    ucp_area_unit";
        $query .= ") VALUES (";
        $query .= "'{$year}', '{$uc_id}', '{$cr_id}','{$uc_area}','{$uc_area_unit}' ";
        $query .= ")";
        $result_sql2 = mysqli_query($connection, $query);
        if (!$result_sql2) {
            $errors[] = 'Failed3 to add the new record';
        }
   
        $query  = " UPDATE wh_002_users SET ";
        $query .= "u_area = u_area+'{$uc_area}' ";        
        $query .= " WHERE u_id = {$u_id} AND yr_name = {$year}";
        $result_sql3 = mysqli_query($connection, $query);
        if (!$result_sql3) {
          $errors[] = 'Failed4 to add the new record';

        }  

        $query  = " UPDATE wh_000_command_area SET ";
        $query .= "ca_area = ca_area+'{$uc_area}' ";        
        $query .= " WHERE ca_id = {$ca_id}";
        $result_sql4 = mysqli_query($connection, $query);
        if (!$result_sql4) {
          $errors[] = 'Failed5 to add the new record';
        } 

        $query  = " UPDATE wh_000_network_canals SET ";
        $query .= "nc_command_area = nc_command_area+'{$uc_area}' ";  
        $query .= " WHERE nc_id = {$nc_id}";
        $result_sql5 = mysqli_query($connection, $query);
        if (!$result_sql5) {
          $errors[] = 'Failed6 to add the new record';
        } 
        
      }

      if(isset($_POST['cr_id_second'])  && isset($_POST['uc_area_second'])){ // if user select second crop -- 
            $cr_id_second        = $_POST['cr_id_second'] ;
            $uc_area_second     = $_POST['uc_area_second'] ;
            $uc_area_unit_second = $_POST['uc_area_unit_second'] ;


            $sql = "SELECT * FROM wh_002_users_canal WHERE nc_id = $nc_id AND u_id = $u_id ";
            $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
            $num_of_raws = mysqli_num_rows($result);
            if($num_of_raws>0  ){
              $row = mysqli_fetch_array($result);
              $uc_id = $row['uc_id'];
              $query = " UPDATE wh_002_users_canal SET ";
              $query .= "uc_area = uc_area+'{$uc_area_second}' ";     
              $query .= " WHERE uc_id = {$uc_id}";
              $result_sql = mysqli_query($connection, $query);
              if (!$result_sql) {
                $errors[] = 'Failed7 to add the new record';
              } 
            }else{
              $query = "INSERT INTO wh_002_users_canal ( ";
              $query .= "yr_name,     u_id,      nc_id,     uc_area,       uc_area_unit";
              $query .= ") VALUES (";
              $query .= "'{$year}', '{$u_id}', '{$nc_id}', '{$uc_area_second}', '{$uc_area_unit_second}',";
              $query .= ")";
              $result_sql = mysqli_query($connection, $query);
              if (!$result_sql) {
                $errors[] = 'Failed8 to add the new record';
              } 
            }


          if (empty($errors)) {

            $obj = new Get_uc_id();
            $uc_id = $obj->_check( $u_id, $nc_id) ; 

            $query  = "INSERT INTO wh_002_users_crops ( ";
            $query .= "yr_name,     uc_id,      cr_id,     ucp_area,    ucp_area_unit";
            $query .= ") VALUES (";
            $query .= "'{$year}', '{$uc_id}', '{$cr_id_second}','{$uc_area_second}','{$uc_area_unit_second}' ";
            $query .= ")";
            $result_sql2 = mysqli_query($connection, $query);
            if (!$result_sql2) {
                $errors[] = 'Failed9 to add the new record';
            }
      
            $query  = " UPDATE wh_002_users SET ";
            $query .= "u_area = u_area+'{$uc_area_second}' ";        
            $query .= " WHERE u_id = {$u_id} AND yr_name = {$year}";
            $result_sql3 = mysqli_query($connection, $query);
            if (!$result_sql3) {
              $errors[] = 'Failed10 to add the new record';

            }  

            $query  = " UPDATE wh_000_command_area SET ";
            $query .= "ca_area = ca_area+'{$uc_area_second}' ";        
            $query .= " WHERE ca_id = {$ca_id}";
            $result_sql4 = mysqli_query($connection, $query);
            if (!$result_sql4) {
              $errors[] = 'Failed11 to add the new record';
            } 

            $query  = " UPDATE wh_000_network_canals SET ";
            $query .= "nc_command_area = nc_command_area+'{$uc_area_second}' ";  
            $query .= " WHERE nc_id = {$nc_id}";
            $result_sql5 = mysqli_query($connection, $query);
            if (!$result_sql5) {
              $errors[] = 'Failed12 to add the new record';
            } 
          }

      }// -- end if user select second crop 

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