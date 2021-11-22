<?php 
//========================================
$start_time = microtime(true); //checker
//========================================
error_reporting(0);
include_once("../config/config.php");
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

<aside class="main-sidebar sidebar-light-info elevation-4 bg-gradient" style="background-color: #dee2e6;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Agriculture System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <form action="" method="get" id="filter" name="filter" class="mt-4">
       <label style="padding-left:15px; font-size:16px;"> <strong>Year:&nbsp;&nbsp;</strong></label>
       <select id="yr_name" name="yr_name" style="width:100px; height:25px">
      <?php 
	  $objTimescale->getYears();
	  while($yrows=$objTimescale->dbFetchArray())
	  {?>
      <option value="<?php echo $yrows["yr_name"];?>" <?php if($default_year==$yrows["yr_name"]){ ?>  selected="selected" <?php }?>>
	  <?php echo $yrows["yr_name"];?></option>
      <?php  }?>
      </select>
       <input type="submit" id="go" value="GO"  />
       </form>

          <li class="nav-header">REPORTS</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link active">
            <i class="nav-icon fas fa-file"></i>
              <p>
               Use Values
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
              <p>
              Use Values as Percent
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
              <p>
              Proposed Irrigation
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
              <p>
              Proposed Irrigation
              </p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
              <p>
              Schedule for the SPA 
              </p>
            </a>
          </li>

          <li class="nav-header">SETTING/FORMS</li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>  
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>  
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>  
              <p>Documentation</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->


      
    </div>
    <!-- /.sidebar -->
  </aside>