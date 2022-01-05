<!--     making the connection with DB     -->
<?php require_once('../../Config/connection.php'); ?>
<?php  include '../../Config/getting_year.php';  ?>
      
      <!-- adding records to the database  -->
      <?php 
      if (isset($_POST['submit'])  ) {   //clicked save button
        $errors = array();
        $start_month ='';
        $end_month ='';
        $message='';
        
        if( isset($_POST['start_month'])  &&  isset($_POST['end_month'])){
          $start_month = $_POST['start_month'] ;
          $end_month = $_POST['end_month'] ;
          
        }
    
      if (empty($errors)) {

          $sql = "SELECT * FROM wh_001_tscale_main  WHERE yr_name = 2020  AND ts_month BETWEEN $start_month AND $end_month";
          $result = mysqli_query($connection , $sql);	
          $i = 1;
          while ($row = mysqli_fetch_array($result)) {

            $ts_id = $row['ts_id'];
            
            if( isset($_POST['cr_id'])){

              $cr_id =         $_POST['cr_id'];
              $sch_wat_value = $_POST['sch_wat_value'.$i] ;
              $percent_value = $_POST['percent_value'.$i] ;
              $year = 2020;

              $sql_cwp = "SELECT * FROM wh_001_crop_per_main WHERE ts_id = $ts_id AND cr_id = $cr_id AND yr_name =  $year LIMIT 1 ";
              $result_cwp = mysqli_query($connection, $sql_cwp) or die( mysqli_error($connection));
              $num_of_raws_cwp = mysqli_num_rows($result_cwp);
              if($num_of_raws_cwp>0  ){
                $query =  " UPDATE wh_001_crop_per_main SET sch_wat = '{$sch_wat_value}', percent = '{$percent_value}' ";
                $query .= " WHERE ts_id = {$ts_id} AND cr_id = {$cr_id} AND yr_name =  {$year}";
                $result_save = mysqli_query($connection, $query);
          
     
                if (!$result_save) {
                  $errors[] = 'Failed to add the new record';
                } 
              }else {
                $query = "INSERT INTO wh_001_crop_per_main ( ";
                $query .= "yr_name,     cr_id,      ts_id,       sch_wat,       percent";
                $query .= ") VALUES (";
                $query .= "'{$year}', '{$cr_id}', '{$ts_id}' , '{$sch_wat_value}' , '{$percent_value}'";
                $query .= ")";
  
                $result_save = mysqli_query($connection, $query);
                if (!$result_save) {
                  $errors[] = 'Failed to add the new record';
                } 
              }
            }
          $i++;
          }
        								
      }

      if (!empty($errors)) {
          $message .= '<b>There were error(s) on your form.</b><br>';
            foreach ($errors as $error) {
              $error = ucfirst(str_replace("_", " ", $error));
              $message .= '- ' . $error . '<br>';
              
              header('Location: ../../pages/form_tscale_irri_sch.php?msg='.$message.'&status=false');
            }
      }else{
        $message .= ' All records are successfully added !!';
        header('Location: ../../pages/form_tscale_irri_sch.php?msg='.$message.'&status=true');
        
      
      }

    }
      
      ?>