<?php


class functions{

	function _countRecords_net($check_value){
		
		if ($check_value=='Secondary'){

			$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
			$sql = "SELECT * FROM wh_000_network_canals WHERE nc_type = 'Secondary' ";			
			$result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
			$rowCount_plus_one=mysqli_num_rows($result) +1;		
			$formatted = sprintf('%01d', $rowCount_plus_one);
			return ($formatted.'0000') ; 

		}else if ($check_value=='Tertiary'){

			$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
			$sql = "SELECT * FROM wh_000_network_canals WHERE nc_type = 'Tertiary' ";			
			$result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
			$rowCount_plus_one=mysqli_num_rows($result) + 1;		
			$formatted = sprintf('%02d', $rowCount_plus_one);
			return ($formatted.'00') ; 

		}else if ($check_value=='Quaternary'){
			
			$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
			$sql = "SELECT * FROM wh_000_network_canals WHERE nc_type = 'Quaternary' ";			
			$result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
			$rowCount_plus_one=mysqli_num_rows($result) +1;	
			$formatted = sprintf('%01d', $rowCount_plus_one);	
			return ($formatted) ; 

		}else if ($check_value=='Aggregate'){

			$connection = mysqli_connect('localhost', 'root', '', 'sas20210601');
			$sql = "SELECT * FROM wh_000_network_canals WHERE nc_type = 'Aggregate' ";			
			$result = mysqli_query($connection, $sql) or die( mysqli_error($connection));
			$rowCount_plus_one=mysqli_num_rows($result) +1;			
			$formatted = sprintf('%01d', $rowCount_plus_one);
			return ($formatted.'00') ; 

		}else{
			return ('000000') ; 
		}



		
    }
}

?>


    
