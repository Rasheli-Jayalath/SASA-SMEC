<?php


class Get_cr_name{
    function _check($cr_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM wh_001_crops_main WHERE cr_id = $cr_id LIMIT 1";	
		
		$result_set=mysqli_query($connection,$sql);
		
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$cr_name = $result['cr_name'];
			
                return $cr_name;

				
			}
        } 
    }


}
