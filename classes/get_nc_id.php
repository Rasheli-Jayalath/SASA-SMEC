<?php

class Get_nc_id{
    function _check($uc_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM wh_002_users_canal WHERE u_id = $uc_id LIMIT 1";	
		
		$result_set=mysqli_query($connection,$sql);
		
		if ($result_set) {
			
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$nc_id = $result['nc_id'];
			
                return $nc_id;

				
			}
        } 
    }


}
?>
