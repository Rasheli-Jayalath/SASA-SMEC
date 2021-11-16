<?php require_once('../../Config/connection.php'); ?>

<?php 
		if (isset($_GET['u_id'])) {
		
		// getting  information
		$u_id = mysqli_real_escape_string($connection, $_GET['u_id']);

		$query = "UPDATE wh_002_users SET  is_Deleted = 1 WHERE u_id = {$u_id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		   
		
			if($result){
				header('Location: ../../pages/table_user.php?msg=record_deleted');
			}else{
				header('Location: ../../pages/table_user.php?msg=record_not_deleted');
			} 


		}else {
			header('Location: ../../pages/table_user.php');
		}
?>