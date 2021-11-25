<?php 

include_once("../config/config.php");
  $dbconn =       new Database();
  $objCmdArea =   new CommandArea();
  $canalNet =     new CanalNetworks();
  $objUser =      new Users();
  $objCanalUser = new CanalUsers();
  $objUserCrops = new UsersCrops();
  $objCrops =     new Crops();
  $objTimescale = new Timescale();
  $objReports =   new Reports();

?>
<?php 
if(isset($_REQUEST['yr_name'])&& $_REQUEST['yr_name']!="")
{
$default_year=$_REQUEST['yr_name'];
}
else
{
$default_year=CROP_YEAR;
}
if(isset($_REQUEST['nc_code'])&& $_REQUEST['nc_code']!="")
{
	
$nc_code=$_REQUEST['nc_code'];	
if($nc_code=="CA0100")
{
	$nc_code="NC0101";
}


}
else
{
$nc_code=NC_CODE;
}?>  

<aside class="sidenav navbar navbar-vertical  border-0 border-radius-xl scrolll-sidebar " style="overflow-y: hidden; overflow-x: hidden; background-color: #dee2e6; height: 95vh;"   id="sidenav-main ">
<div class="sidenav-header mt-n3 mb-3 text-center"  style ="">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php">
        <div  >
          <img src="../assets/img/logo-ct.png" class="  " style=" max-height: 40px ; " alt="...">
        </div>
        <span class="ms-3 font-weight-bold pl-2"> SAS Management System </span>
      </a>
    </div>

       <ul class="navbar-nav" style=" overflow-y: hidden; overflow-x: hidden; " >

<li class="nav-item mt-3">
  <h6 class="ps-4 ms-3 text-uppercase text-xs font-weight-bolder opacity-6 mb-n1">	&nbsp;Reports</h6>
</li>
 <li class="nav-item">
  <a class="nav-link  "  href="../irrigation_norms.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"     title=" Decadal Crop Water Use Values ">
  <i class="nav-icon fas fa-file"></i> 
  <span class="nav-link-text text-sm">Decadal Crop Water Use Values</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  " href="../irrigation_norms_details.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"   title=" Irrigation Norms and Decadal Crop Water Use Values as Percent "> 
  <i class="nav-icon fas fa-file"></i> 
    <span class="nav-link-text ms-1">Irrigation Norms and Decadal..</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  " href="../irrigation_schedule.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"   title=" Proposed Irrigation Schedule for the SPA  ">
  <i class="nav-icon fas fa-file"></i> 
    <span class="nav-link-text ms-1"> Proposed Irrigation Schedule.. </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  " href="../cropping_pattern_summary.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"   title="  Cropping Pattern Summary">
  <i class="nav-icon fas fa-file"></i> 
    <span class="nav-link-text ms-1">Cropping Pattern Summary </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="../cropping_pattern.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"   title="Cropping Pattern   ">
  <i class="nav-icon fas fa-file"></i> 
    <span class="nav-link-text ms-1">Cropping Pattern </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="../water_distribution_report.php?nc_code=<?php echo $nc_code;?>" style = " text-indent: -0.3em;"    title="  Canal-Wise Water Distribution Plan">
  <i class="nav-icon fas fa-file"></i> 
    <span class="nav-link-text ms-1">Canal-Wise Water Distribution.. </span>
  </a>
</li>
<li class="nav-item mt-3">
</ul>
<ul class="navbar-nav" style=" overflow-y: hidden; overflow-x: hidden; height: 100vh;" >
  <h6 class="ps-4 ms-3 text-uppercase text-xs font-weight-bolder opacity-6 mb-n1">	&nbsp;Setting/Forms</h6>

</li>
<li class="nav-item">
  <a class="nav-link  " href="form_year.php" style = " text-indent: -0.3em;"   title=" Year Form ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1">Entering Year Records </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link " href="table_net_canal.php" style = " text-indent: -0.3em;"   title=" Manage Network Canal  ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1">Manage Network Canal </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  " href="table_crop.php" style = " text-indent: -0.3em;"  title=" Manage Crops ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1"> Manage Crops </span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  " href="table_user.php" style = " text-indent: -0.3em;"  title=" Manage Users ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1"> Manage Users </span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link  " href="table_user_canal.php" style = " text-indent: -0.3em;" title=" Manage User Canal ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1"> Manage User Canal </span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link  " href="table_user_crop.php" style = " text-indent: -0.3em;"  title=" Manage User Crops ">
     <i class="fas fa-circle nav-icon "></i>
    <span class="nav-link-text ms-1">Manage User Crops </span>
  </a>
</li>

</ul>
  </aside>