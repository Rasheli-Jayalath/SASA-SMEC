<?php require_once('../../Config/connection.php'); ?>

<?php 
		if (isset($_GET['uc_id'])) {
		
		// getting  information
		$uc_id = mysqli_real_escape_string($connection, $_GET['uc_id']);

		$query = "UPDATE wh_002_users_canal SET  is_Deleted = 1 WHERE uc_id = {$uc_id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		   
		
			if($result){
				header('Location: ../../pages/table_user_canal.php?msg=record_deleted');
			}else{
				header('Location: ../../pages/table_user_canal.php?msg=record_not_deleted');
			} 


		}else {
			header('Location: ../../pages/table_user_canal.php');
		}
?>