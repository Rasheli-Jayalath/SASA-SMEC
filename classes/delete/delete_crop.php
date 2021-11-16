<?php require_once('../../Config/connection.php'); ?>

<?php 
		if (isset($_GET['cr_id'])) {
		
		// getting  information
		$cr_id = mysqli_real_escape_string($connection, $_GET['cr_id']);

		$query = "UPDATE wh_001_crops_main SET  is_Deleted = 1 WHERE cr_id = {$cr_id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		   
		
			if($result){
				header('Location: ../../pages/table_crop.php?msg=record_deleted');
			}else{
				header('Location: ../../pages/table_crop.php?msg=record_not_deleted');
			} 


		}else {
			header('Location: ../../pages/table_crop.php');
		}
?>