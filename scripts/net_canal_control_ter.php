<?php

if(isset($_GET['second']) AND isset($_GET['ca_id']) ){
      $ca_id = $_GET['ca_id'];
      $q = $_GET['second'];
 
      $connection = mysqli_connect('localhost', 'root', '', 'sas'); 
  
      mysqli_select_db($connection,"ajax_demo");
  
      $sql = "SELECT * FROM wh_000_network_canals WHERE nc_type = 'Tertiary' AND ca_id = '".$ca_id."'";
      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));

      if( $q=='Quaternary' ){
          echo "    <div id=\"Ter\" class = \"form-group\" >";
          echo "   Select the Parent Tertiary : &nbsp; ";
          echo "   <select name= \"parent_tertiary\" class=\"form-select move-on-hover\">";
          echo "   <option value=\"0\"> None </option>";
        
          while($row = mysqli_fetch_array($result)){
                echo " <option value=".$row['nc_code'].">".$row['nc_name']."</option>";
                          }
                                                    
          echo "  </select>";
          echo "  </div>";
      }
}

?>
