<?php require_once('../../Config/connection.php'); ?>

<?php 
		if (isset($_GET['ucp_id'])) {
		
		// getting  information
		$ucp_id = mysqli_real_escape_string($connection, $_GET['ucp_id']);

		$query = "UPDATE wh_002_users_crops SET  is_Deleted = 1 WHERE ucp_id = {$ucp_id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		   
		
			if($result){
				header('Location: ../../pages/table_user_crop.php?msg=record_deleted');
			}else{
				header('Location: ../../pages/table_user_crop.php?msg=record_not_deleted');
			} 


		}else {
			header('Location: ../../pages/table_user_crop.php');
		}
?>