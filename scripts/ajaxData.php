
<?php 
// Include the database config file 
include_once '../Config/connection.php'; 
 
if(!empty($_POST["ca_id"])){ 

    $query = "SELECT * FROM wh_000_network_canals WHERE ca_id = ".$_POST['ca_id']." AND is_deleted = 0 AND nc_type = 'Secondary' ORDER BY nc_name ASC"; 
    $result = $connection->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Secondary Canal</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['nc_id'].'">'.$row['nc_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value=""> Secondary Canal not available</option>'; 
    } 
}elseif(!empty($_POST["nc_id"])){ 
    $secondary_canal = $_POST["nc_id"];
    $query1 = "SELECT nc_code FROM wh_000_network_canals WHERE nc_id = ' $secondary_canal'  "; 
    $result1 = $connection->query($query1);
    
        while($data=$result1->fetch_assoc()){
            $secondary_canal_nc_code = $data['nc_code'];
            $part_of_nc_code = substr($secondary_canal_nc_code,0,7);
        }

    $query = "SELECT * FROM wh_000_network_canals WHERE substring(nc_code,1,7) = '$part_of_nc_code' AND yr_name='2020' AND nc_type = 'Tertiary' ORDER BY nc_name ASC"; 
    $result = $connection->query($query); 
     

    if($result->num_rows > 0){ 
        echo '<option value="">Select Tertiary Canal </option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['nc_id'].'">'.$row['nc_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Tertiary Canal not available</option>'; 
    } 
} elseif(!empty($_POST["nc_id_tertiary"])){ 
    $tertiary_canal = $_POST["nc_id_tertiary"];
    echo     $tertiary_canal;
    $query2 = "SELECT nc_code FROM wh_000_network_canals WHERE nc_id = ' $tertiary_canal'  "; 
    $result2 = $connection->query($query2);
    
        while($data=$result2->fetch_assoc()){
            $tertiary_canal_nc_code = $data['nc_code'];
            $part_of_nc_code_tertiary = substr($tertiary_canal_nc_code,0,9);
        }

    $query = "SELECT * FROM wh_000_network_canals WHERE  substring(nc_code,1,9) = '$part_of_nc_code_tertiary' AND yr_name='2020' AND nc_type = 'Quaternary' ORDER BY nc_name ASC"; 
    $result = $connection->query($query); 
     

    if($result->num_rows > 0){ 
        echo '<option value="">Select Quaternary Canal </option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['nc_id'].'">'.$row['nc_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value=""> Quaternary Canal not available </option>'; 
    } 
} 
?>