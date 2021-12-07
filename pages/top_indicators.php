<!--     making the connection with DB     -->
<?php require_once('Config/connection.php'); ?>

<div class="row">
   <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Irrigated Area</p>
                    <h5 class="font-weight-bolder mb-0">
                    <?php  
                      $sql = " SELECT SUM(ca_area) AS total FROM wh_000_command_area ";		
					    if(isset($_REQUEST['yr_name'])&& $_REQUEST['yr_name']!="")
						{
						$default_year=$_REQUEST['yr_name'];
						$sql .=" WHERE yr_name=".$default_year;
						}
						else
						{
						$default_year=CROP_YEAR;
						$sql .=" WHERE yr_name=".$default_year;
						}			
           
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $row = mysqli_fetch_assoc($result) ;	
                      $sum = $row['total'];
                      echo $sum;                 
                    ?>
                      <span class="text-success text-sm font-weight-bolder">Hectares</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape  text-center border-radius-md">
                   <a href="pages/table_net_canal.php"> <img src="images/grain-rice.png" width="50px" height="50px"/></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold"> Water Requirement </p>
                    <h5 class="font-weight-bolder mb-0">

                    <?php  
                      $sql = " SELECT sum(cr_wat_req) as total_water FROM wh_001_crops_main ";
				    if(isset($_REQUEST['yr_name'])&& $_REQUEST['yr_name']!="")
						{
						$default_year=$_REQUEST['yr_name'];
						$sql .=" WHERE yr_name=".$default_year;
						}
						else
						{
						$default_year=CROP_YEAR;
						$sql .=" WHERE yr_name=".$default_year;
						}					
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));   
                      $row = mysqli_fetch_assoc($result) ;	
                      $total_water = $row['total_water'];
                      echo $total_water;
                
                    ?>

                    
                    <span class="text-success text-sm font-weight-bolder">Per Hectare</span>
                      <?php /*?><span class="text-success text-sm font-weight-bolder">+3%</span><?php */?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                 <div class="icon icon-shape  text-center border-radius-md">
                    <a href="pages/table_net_canal.php"> <img src="images/canal.png" width="50px" height="50px"/></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total No. of Farmers</p>
                    <h5 class="font-weight-bolder mb-0">

                    <?php  
                      $sql = " SELECT * FROM wh_002_users WHERE is_deleted = 0 ";	
					  if(isset($_REQUEST['yr_name'])&& $_REQUEST['yr_name']!="")
						{
						$default_year=$_REQUEST['yr_name'];
						$sql .=" AND yr_name=".$default_year;
						}
						else
						{
						$default_year=CROP_YEAR;
						$sql .=" AND yr_name=".$default_year;
						}		
					  $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $total_useres = mysqli_num_rows($result) ;	
                      echo $total_useres;
                    ?>

                     <?php /*?> <span class="text-success text-sm font-weight-bolder">+55%</span><?php */?>
                    </h5>
                  </div>
                </div>
                  <div class="icon icon-shape  text-center border-radius-md">
                  <a href="pages/table_user.php"> <img src="images/farmers.png" width="50px" height="50px"/></a>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Primary Canals</p>
                    <h5 class="font-weight-bolder mb-0">
                    <?php  
                      $sql = " SELECT * FROM wh_000_command_area WHERE ca_parent_id = 0 AND is_deleted = 0 ";
					    if(isset($_REQUEST['yr_name'])&& $_REQUEST['yr_name']!="")
						{
						$default_year=$_REQUEST['yr_name'];
						$sql .=" AND yr_name=".$default_year;
						}
						else
						{
						$default_year=CROP_YEAR;
						$sql .=" AND yr_name=".$default_year;
						}					
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $total_p_canal = mysqli_num_rows($result) ;	
                      echo $total_p_canal;
                    ?>
                      <?php /*?><span class="text-danger text-sm font-weight-bolder">-2%</span><?php */?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                <div class="icon icon-shape  text-center border-radius-md">
                    <a href="pages/table_net_canal.php"> <img src="images/canal.png" width="50px" height="50px"/></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</div>