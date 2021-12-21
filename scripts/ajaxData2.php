
<?php 
// Include the database config file 
include_once '../Config/connection.php'; 
 
if(!empty($_POST["ca_id"])){ 
    $q = $_POST["ca_id"] ;
    $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id  = ".$_POST['ca_id']."  ";
    $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
    $num_of_raws = mysqli_num_rows($result);
    if($num_of_raws>1 AND $q!=0 ){
    
        echo "    <div  class = \"form-group\" >";
        echo "   Select the Sub component : &nbsp; ";
        echo "   <select name= \"sub_comp_id\" class=\"form-select move-on-hover\">";
        echo "   <option value=\"0\">None</option>";
      
        while($row = mysqli_fetch_array($result)){
              echo " <option value=".$row['ca_code'].">".$row['ca_name']."</option>";
                        }
                                                  
        echo "  </select>";
        echo "  </div>";
    }
 
}



?>
