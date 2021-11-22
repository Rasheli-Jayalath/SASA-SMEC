<!--     making the connection with DB     -->
<?php require_once('Config/connection.php'); ?>
<?php 
//========================================
$start_time = microtime(true); //checker
//========================================
error_reporting(0);
include_once("config/config.php");
$dbconn = new Database();
$objCmdArea = new CommandArea();
$canalNet = new CanalNetworks();
$objUser = new Users();
$objCanalUser = new CanalUsers();
$objUserCrops = new UsersCrops();
$objCrops = new Crops();
$objTimescale = new Timescale();
$objReports = new Reports();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <script src="../scripts/jquery.min.js"></script>
  <script src="../scripts/bootstrap.min.js"></script>
  <script src="../Highcharts/code/highcharts.js"></script>
  <script src="../Highcharts/code/modules/exporting.js"></script>
  <script src="../Highcharts/code/modules/jquery.highchartTable.js"></script>

  <style>
    .non-btn{
      background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
    }

    rcorners2 {
  border-radius: 15px 50px 30px;
  background: #73AD21;
  padding: 20px; 
  width: 200px;
  height: 150px; 
}
    </style>
</head>
<body>

        <!-- Small boxes (Stat box) -->
        <div class="row">

        <div class="col-xl-3 col-sm-6 ">
          <div class="card ">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                
                    <h3 class="font-weight-bolder mb-0">
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
                      <span class="text-success text-sm font-weight-bolder">Hecter</span>
                    </h3>
                    <p class="text-sm mb-0 text-capitalize text-muted font-weight-bold">Total Irrigated Area</p>
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
        
        
          <!-- ./col -->
          <div class="col-lg-3 col-6 ">
            <div class="card card-body p-3  shadow  rounded">
              <div class="row">
                <div class="col-8">
                
                  <h3 class="font-weight-bolder mb-0">
                  <?php  
                      $sql = " SELECT * FROM wh_000_command_area WHERE ca_parent_id = 0 AND is_deleted = 0 ";			
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $total_p_canal = mysqli_num_rows($result) ;	
                      echo $total_p_canal;
                    ?>
                    </h3>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Water Demand</p>
                </div>

                  <div class="icon icon-shape  text-center border-radius-md bg-image hover-zoom ">
                  <a href="pages/table_user.php"> <img src="images/canal.png" class="ml-4 " width="50px" height="50px"/></a>
                  </div>
                  
              </div>
            </div>
        </div>
          <!-- ./col -->
        <div class="col-lg-3 col-6 ">
            <div class="card card-body p-3  shadow-lg rounded">
              <div class="row">
                <div class="col-8">
                
                  <h3 class="font-weight-bolder mb-0">
                    <?php  
                      $sql = " SELECT * FROM wh_002_users WHERE is_deleted = 0 ";			
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $total_useres = mysqli_num_rows($result) ;	
                      echo $total_useres;
                    ?>
                    </h3>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total No. of Farmers</p>
                </div>

                  <div class="icon icon-shape  text-center border-radius-md bg-image hover-zoom ">
                  <a href="pages/table_user.php"> <img src="images/farmers.png" class="ml-4 " width="50px" height="50px"/></a>
                  </div>
                  
              </div>
            </div>
        </div> 
          <!-- ./col -->
          <div class="col-lg-3 col-6 ">
            <div class="card card-body p-3  shadow  rounded">
              <div class="row">
                <div class="col-8">
                
                  <h3 class="font-weight-bolder mb-0">
                  <?php  
                      $sql = " SELECT * FROM wh_000_command_area WHERE ca_parent_id != 0 AND is_deleted = 0 ";			
                      $result = mysqli_query($connection, $sql) or die( mysqli_error($connection));           
                      $total_s_canal = mysqli_num_rows($result) ;	
                      echo $total_s_canal;
                    ?>
                    </h3>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Secondary Canals</p>
                </div>

                  <div class="icon icon-shape  text-center border-radius-md bg-image hover-zoom ">
                  <a href="pages/table_user.php"> <img src="images/canal.png" class="ml-4 " width="50px" height="50px"/></a>
                  </div>
                  
              </div>
            </div>
        </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

          <div class="card bg-gradient-light" >
              <div class="card-header border-0" style="margin: -5px;">
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="non-btn mr-2" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools --> 
              </div>
              <div class="card-body" style=" margin: -2.5% -2.2% -4.5% -2.2%">
                <?php include("graphs1.php");?>
                </div>
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->

          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Map card -->

            <!-- /.card -->

            <!-- solid sales graph -->
            <div class="card bg-gradient-secondary" >
              <div class="card-header border-0" style="margin: -5px;">
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-dark btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools --> 
              </div>
              <div class="card-body" style="max-height: 380px; overflow: hidden; ">
              <?php include("graphs2.php");?>
                </div>
            </div>
            <!-- /.card -->

          </section>

          <section class="col-lg-12 connectedSortable">
          <div class="card bg-gradient-light"  >
              <div class="card-header border-0" style="margin: -5px;">
                <!-- card tools -->
                <div class="card-tools">
                  <button  class="non-btn" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus  "  ></i>
                  </button>
                </div>
                <!-- /.card-tools --> 
              </div>
              <div class="card-body" style="max-height: 405px; overflow: hidden;" >
        
            <iframe class ="" src="includes/chart1.php?yr_name= <?php echo $default_year; ?> "  style = "width: 100%; height: 600px; margin-top: -35px; overflow-y: hidden; margin-left: -20px"  frameBorder="0"></iframe>
               
          </div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    
</body>
</html>