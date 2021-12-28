
<?php 
// Include the database config file 
include_once '../Config/connection.php'; 

if(!empty($_POST["ca_id"])){ 
    $q = $_POST["ca_id"] ;
    if($q>0){
        $query = "SELECT * FROM wh_000_command_area WHERE ca_parent_id  = ".$_POST['ca_id']."  ";
        $result = $connection->query($query); 
        
        // Generate HTML of state options list 
        if($result->num_rows > 0 && $q>0){ 
            echo 'Select sub componant : &nbsp;' ;
            echo '<select  name="sub_comp" class="form-select move-on-hover" >';
            
            echo '<option value="">Select Sub component </option>'; 
            while($row = $result->fetch_assoc()){  
                echo " <option value=".$row['ca_id'].">".$row['ca_name']."</option>";
            } 
            echo '</select>' ;
        }
    }
}



?>
