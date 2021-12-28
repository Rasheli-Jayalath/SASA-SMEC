<?php

class Get_uc_id{
    function _check($u_id, $nc_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM wh_002_users_canal WHERE u_id = $u_id AND nc_id = $nc_id LIMIT 1";	
		
		$result_set=mysqli_query($connection,$sql);
		
		if ($result_set) {
			
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$uc_id = $result['uc_id'];
			
                return $uc_id;
			}
        } 
    }


}
?>
