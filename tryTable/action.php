<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'sas20210601');

$input = filter_input_array(INPUT_POST);

$nc_code = mysqli_real_escape_string($connect, $input["nc_code"]);
$nc_name = mysqli_real_escape_string($connect, $input["nc_name"]);

if($input["action"] === 'edit')
{
 $query = " UPDATE wh_000_network_canals SET nc_code = '".$nc_code."', nc_name = '".$nc_name."' WHERE nc_id = '".$input["nc_id"]."' ";

 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM wh_000_network_canals 
 WHERE nc_id = '".$input["nc_id"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>
