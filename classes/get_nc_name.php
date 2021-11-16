<?php


class Get_nc_name{
    function _check($nc_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM tbl000_network_canals WHERE nc_id = $nc_id LIMIT 1";	
		
		$result_set=mysqli_query($connection,$sql);
		
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$nc_name = $result['nc_name'];
			
                return $nc_name;

				
			}
        } 
    }


}
