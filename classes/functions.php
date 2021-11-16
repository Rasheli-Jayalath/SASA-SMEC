<?php


class functions{
    function _countRecords($main_comp_id){
        $connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
	    $sql = "SELECT * FROM wh_000_command_area WHERE ca_parent_id = $main_comp_id ";	
		
		$result=mysqli_query($connection,$sql);
		$rowcount=mysqli_num_rows($result);
		
		return ($rowcount+1) ; 
    }


}

    
