<?php

if(isset($_GET['q'])){
    $q = intval($_GET['q']);
 
    $connection = mysqli_connect('localhost', 'root', '', 'sas'); 

    mysqli_select_db($connection,"ajax_demo");

    $sql = "SELECT * FROM wh_000_network_canals WHERE ca_id = '".$q."'";
    $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
    $num_of_raws = mysqli_num_rows($result);
    if($num_of_raws>1 AND $q!=0 ){

        echo "    <div  class = \"form-group\" >";
        echo "   Select the Canal : &nbsp; ";
        echo "   <select name= \"nc_id\" class=\"form-select move-on-hover\">";
        echo "   <option value=\"0\">None</option>";
      
        while($row = mysqli_fetch_array($result)){
              echo " <option value=".$row['nc_id'].">".$row['nc_name']."</option>";
                        }
                                                  
        echo "  </select>";
        echo "  </div>";
    }

}






?>
