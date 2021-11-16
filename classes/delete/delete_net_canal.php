<?php require_once('../../Config/connection.php'); ?>

<?php 
		if (isset($_GET['nc_id'])) {
		
		// getting  information
		$nc_id = mysqli_real_escape_string($connection, $_GET['nc_id']);

		$query = "UPDATE tbl000_network_canals SET  is_Deleted = 1 WHERE nc_id = {$nc_id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		   
		
			if($result){
				header('Location: ../../pages/table_net_canal.php?msg=record_deleted');
			}else{
				header('Location: ../../pages/table_net_canal.php?msg=record_not_deleted');
			} 


		}else {
			header('Location: ../../pages/table_net_canal.php');
		}
?>