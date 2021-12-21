    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg  shadow-none border-radius-xl pt-3 mb-n2" id="navbarBlur" navbar-scroll="true" style="max-height: 50px; overflow: hidden;">
      <div class="container-fluid ">
        <nav aria-label="breadcrumb">
          <div class="breadcrumb bg-transparent ">
            <button  id="second" style="display:none;"> -</button>
            <button onclick="changeme(this.id);" class="button-rotate ml-2 d-none d-xl-block" > <i class="fa fa-bars" aria-hidden="true"></i></button>
            <div class=" d-none d-xl-block " >
              <span class="text-dark font-weight-bold " style=""><strong>SMEC Agriculture Water Management System  </strong></span>
            </div> 
         </div>         
        </nav>
        <div class="collapse navbar-collapse " id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center mt-n3">
            <div class="input-group">
              <form action="" method="get" id="filter" name="filter" >
                <label style="padding-left:15px; " class="text-muted text-sm "> <strong>Year:&nbsp;&nbsp;</strong></label>
                    <select id="yr_name" name="yr_name" style="width:100px; " >
                    <?php 
                  $objTimescale->getYears();
                  while($yrows=$objTimescale->dbFetchArray())
                  {?>
                    <option value="<?php echo $yrows["yr_name"];?>" <?php if($default_year==$yrows["yr_name"]){ ?>  selected="selected" <?php }?>>
                  <?php echo $yrows["yr_name"];?></option>
                    <?php  }?>
                    </select>
                    <button type="submit" id="go" value="GO" class="btn bg-gradient-secondary btn-sm  py-1 mb-1"> Go <i class="fa fa-angle-double-right text-sm" ></i></button>   
              </form>
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end mt-n4">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0 " title="Super Admin">
                <i class="fa fa-user me-sm-1"></i>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav" onclick="sidebar();">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
            </li>
          </ul> 
        </div>
      </div>
    </nav>
    <!-- End Navbar -->