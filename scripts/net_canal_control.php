<?php

if(isset($_GET['q'])){
    $q = intval($_GET['q']);
 
    $connection = mysqli_connect('localhost', 'root', '', 'sas20210601'); 

    mysqli_select_db($connection,"ajax_demo");

      //  $sql = "SELECT * FROM user1 WHERE id = '".$q."'";
    $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id = '".$q."'";
    $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
    $num_of_raws = mysqli_num_rows($result);
    if($num_of_raws>0 AND $q!=0 ){

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
