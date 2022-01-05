<?php 

  class get_values_crop_per{



	  function _get_sch_wat($ts_id, $IDcrop_name ){
		$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
		$sql = "SELECT * FROM wh_001_crop_per_main WHERE ts_id = $ts_id AND cr_id = $IDcrop_name LIMIT 1";	
		$result_set=mysqli_query($connection,$sql);
		if ($result_set) {

			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$sch_wat = $result['sch_wat'];
                return $sch_wat;

			}else {
				return "";
		    }
        } 
		
     }

	 function _get_percent($ts_id, $IDcrop_name ){
		$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
		$sql2 = "SELECT * FROM wh_001_crop_per_main WHERE ts_id = $ts_id AND cr_id = $IDcrop_name LIMIT 1";	
		$result_set2=mysqli_query($connection,$sql2);
		if ($result_set2) {

			if (mysqli_num_rows($result_set2) == 1) {
				// record found
				$result2 = mysqli_fetch_assoc($result_set2);
				$percent = $result2['percent'];
                return $percent;

			}else {
				return "";
		    }
        } 
		
     }


}

?>