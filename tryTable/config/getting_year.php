     <!-- Getting the year, which is year_status = 1 -->

	 <?php require_once('connection.php'); ?>


     <?php 
        $year = '';
		$query = "SELECT * FROM year_main WHERE yr_status = 1 LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// record found
				$result = mysqli_fetch_assoc($result_set);
				$year = $result['yr_name'];
				
			}
		}

     ?>