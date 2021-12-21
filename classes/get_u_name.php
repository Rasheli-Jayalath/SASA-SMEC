<?php


class Get_u_name{
    function _check($u_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM wh_002_users WHERE u_id = $u_id LIMIT 1";	
		
		$result_set=mysqli_query($connection,$sql);
		
		if ($result_set) {
			
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$u_name = $result['u_name'];
			
                return $u_name;

				
			}
        } 
    }


}
?>
