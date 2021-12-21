<?php require_once('../Config/connection.php'); ?>
<?php 
$sql = 'SELECT yr_name FROM tbl001_year_main ORDER BY yr_name DESC LIMIT 1 ';
$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
$row = mysqli_fetch_assoc($result);
$latest_year = $row['yr_name']

?>
<?php

class check_active{
	  
    function _check($checking_value, $latest_year){
        if( 2020 == $latest_year) {
            
            echo "test";
        
        }else{
            echo "test1";
        
        }
  
      
   }
}



?>

