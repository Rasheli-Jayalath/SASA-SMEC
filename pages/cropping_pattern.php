<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	

$objReports->resetProperty();
$objReports->setProperty("rps_id", 4);
$reports=$objReports->getReports();
$reports_rows=$objReports->dbFetchArray();
$report_title=$reports_rows["report_title"];
$start_period=$reports_rows["report_start_id"];
$end_period=$reports_rows["report_end_id"];

?>
<div class="well">
          	<table class="table table-bordered" style="color: black"> 
            <thead style="background-color:#000066; vertical-align:middle; text-align:center; color:#FFF">
            <tr>
            <th colspan="40" align="center"><?php echo $report_title;?></th>
            </tr>
            <tr style="color:#fff">
            <th rowspan="2" style="text-align:center; vertical-align:middle">Canal Name</th>
            <th rowspan="2" style="text-align:center; vertical-align:middle">No</th>
            <th rowspan="2" style="text-align:center; vertical-align:middle">Water User</th>
           
            <?PHP 
		//echo  $default_year;
//$objCrops->setProperty("yr_name", $default_year);
$objCrops->getCrops();
		while($crows=$objCrops->dbFetchArray())
		{   ?>
   <th  style="text-align:center;"><?php echo $crows["cr_name"];?></th>
    <?php }?>
            </tr>
           
            </thead>
            <tr style="background-color:#09F;">
        <td><?php 	
			echo "<strong>KAPAL Canal</strong> ";  
		?></td>
        <td align="center"></td>
		 <td><?php 	
			echo "<strong>Total</strong> ";  
		?></td>
         <?php  
		 
	$total_crp_area=0;
	$grand_total=0;
		  $objCrops->setProperty("yr_name", $default_year);
		  $objCrops->getCrops();
		while($crows=$objCrops->dbFetchArray())
		{
		 $objCanalUser->setProperty("nc_id",$rows["nc_id"]);
		 $objCanalUser->getUserCanal();
		 if($objCanalUser->totalRecords()>0)
		 {
		  while($ucrows=$objCanalUser->dbFetchArray())
		  {
			
			$objUserCrops->setProperty("uc_id", $ucrows["uc_id"]);
			$objUserCrops->setProperty("cr_id", $crows["cr_id"]);
			$objUserCrops->getUserCrops();
			while($crp_sch=$objUserCrops->dbFetchArray())
			{
				$crp_area=$crp_sch["ucp_area"];
				$total_crp_area=$total_crp_area+$crp_area;
			}
			$grand_total=$grand_total+$total_crp_area;
		  }}
		?>
		 <td align="center"><?php echo number_format($total_crp_area);?></td>
          
		 <?php
		$total_crp_area=0;	
		
	  } // end crop
		?>
         </tr>
   <?php $i=0;
   $current_canal=0;
   $pev_canal=0;
   $canalNet->setProperty("ca_id", $idsrows["ca_id"]);
   $canal_result=$canalNet->getCannalNetwork();
   
	while($rows=$canalNet->dbFetchArray())
	{
		$i=0;
	 $objCanalUser->setProperty("nc_id",$rows["nc_id"]);
	 $objCanalUser->getUserCanal();
	 if($objCanalUser->totalRecords()>0)
	 {
	  while($ucrows=$objCanalUser->dbFetchArray())
	  {
		  $i++;
	 $nc_name=$rows["nc_name"];
	 $nc_type=$rows["nc_type"];
	 if($nc_type=="Secondary")
	 {
		  $nc_name='<strong>'.$nc_name.'</strong>';
		  $bgcolor = "#09F;";

	 }
	  else if($nc_type=="Aggregate")
	 {
		   $nc_name='&nbsp;&nbsp;<strong>'.$nc_name.'</strong>';
		  $bgcolor = "#005CB9";

	 }
	 else if($nc_type=="Tertiary")
	 {
		  $nc_name='&nbsp;&nbsp;'.'<strong>'.$nc_name.'</strong>';;
		  $bgcolor = "#C6E2FF";

	 }
	 else
	 {
	 $nc_name='&nbsp;&nbsp;&nbsp;&nbsp;'.'<strong>'.$nc_name.'</strong>';
	 $bgcolor = "#EAF4FF" ;
	 }
	 $current_canal=$rows["nc_id"];
		?>
        <tr style="background-color:<?php echo $bgcolor;?>;">
        <td><?php 	if($current_canal!=$pev_canal) 
		{
			echo $nc_name;  
		}?></td>
        <td align="center"><?php 	 echo $i;  ?></td>
		 <td><?php 	echo $ucrows["uname"];  ?></td>
        <?php 
		$objCrops->setProperty("yr_name", $default_year); 
		$objCrops->getCrops();
		while($crows=$objCrops->dbFetchArray())
		{
			
			$objUserCrops->setProperty("uc_id", $ucrows["uc_id"]);
			$objUserCrops->setProperty("cr_id", $crows["cr_id"]);
			$objUserCrops->getUserCrops();
			$crp_sch=$objUserCrops->dbFetchArray();
		?>
		 <td align="center"><?php echo number_format($crp_sch["ucp_area"]);?></td>
          
		 <?php
		} // end crop
	 
	// end  For Tertiary and Quaternary Canal
	?>
    
			</tr>		
		<?php 
	$pev_canal=$current_canal;
	} // user canal loop
	?>
    <tr style="background-color:#005CB9;">
        <td></td>
        <td align="center"></td>
		 <td><?php 	
			echo "<strong>Total</strong> ".$nc_name;  
		?></td>
         <?php  
		 
		  $total_crp_area=0;
		  $objCrops->setProperty("yr_name", $default_year);
		  $objCrops->getCrops();
		while($crows=$objCrops->dbFetchArray())
		{
		 $objCanalUser->setProperty("nc_id",$rows["nc_id"]);
		 $objCanalUser->getUserCanal();
		 if($objCanalUser->totalRecords()>0)
		 {
		  while($ucrows=$objCanalUser->dbFetchArray())
		  {
			
			$objUserCrops->setProperty("uc_id", $ucrows["uc_id"]);
			$objUserCrops->setProperty("cr_id", $crows["cr_id"]);
			$objUserCrops->getUserCrops();
			while($crp_sch=$objUserCrops->dbFetchArray())
			{
				$crp_area=$crp_sch["ucp_area"];
				$total_crp_area=$total_crp_area+$crp_area;
			}
		  }}
		?>
		 <td align="center"><?php echo number_format($total_crp_area);?></td>
          
		 <?php
		$total_crp_area=0;	
		
	  } // end crop
		?>
         </tr>
	 <?php }
	 } // end Canal Loop?>
	 
	
</table>
          </div>