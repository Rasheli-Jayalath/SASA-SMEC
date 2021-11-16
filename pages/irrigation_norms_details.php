<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	 
$objReports->resetProperty();
$objReports->setProperty("rps_id", 2);
$reports=$objReports->getReports();
$reports_rows=$objReports->dbFetchArray();
$report_title=$reports_rows["report_title"];
$start_period=$reports_rows["report_start_id"];
$end_period=$reports_rows["report_end_id"];
 
?>
<div class="well">
          	<table class="table table-bordered" style="color: black"> 
            <thead style="background-color:#337ab7; vertical-align:middle; text-align:center;">
             <tr>
            <th colspan="40" text-align="center"><?php echo $report_title;?></th>
            </tr>
            <tr>
            <th rowspan="3">Norm (m3/ha)</th>
            <th rowspan="3">Crop</th>
            <th>Month</th>
            <?PHP 
  $objTimescale->setProperty("yr_name", $default_year);
  $objTimescale->setProperty("start",$start_period);
  $objTimescale->setProperty("end",$end_period);
  $timescae_res=$objTimescale->getTimescale();
	$prev=0;
	while($tsrows=$objTimescale->dbFetchArray())
	{
	$current=$tsrows["ts_month"];
	
   if($current!=$prev)
   {
	   $month="01-".$tsrows["ts_month"]."-".$tsrows["yr_name"]; ?>
   <th colspan="3" style="text-align:center"><?php echo date("F", strtotime($month));?></th>
    <?php }
	$prev=$current; }?>
            </tr>
            <tr>
            
            <th>Dec. Period</th>
          
           
       <?php 
	   $timescae_res2=$objTimescale->getTimescale();
	   while($timescae_res2=$objTimescale->dbFetchArray())
	{?>
              <th style="text-align:center"><?php echo $timescae_res2["ts_period"];?></th>
             
      <?php }?>
              </tr>
              <tr>
              <th># of Days</th>
               <?php 
	   $timescae_res2=$objTimescale->getTimescale();
	   while($timescae_res3=$objTimescale->dbFetchArray())
	{?>
              <th style="text-align:center"><?php echo $timescae_res3["ts_days"];?></th>
             
      <?php }?>
              </tr>
            </thead>
   <?php 
   $objCrops->setProperty("yr_name", $default_year);
   $objCrops->getCrops();
	while($crows=$objCrops->dbFetchArray())
	{
	?>
        <tr>
        <td align="center" style="vertical-align:middle"><?php echo $cr_wat_req=$crows["cr_wat_req"];?></td>
		 <td rowspan="2" align="center" style="vertical-align:middle"><?php 	 echo $cr_name=$crows["cr_name"];  ?></td>
          <td align="center" ><?php 	 echo "m3/ha";  ?></td>
        
        <?php 
  $objTimescaleT->setProperty("yr_name", $default_year); 
  $objTimescaleT->setProperty("start",$start_period);
  $objTimescaleT->setProperty("end",$end_period);
  $timescae_res=$objTimescaleT->getTimescale();
	while($trows=$objTimescaleT->dbFetchArray())
	{
		
			$objCropsS->setProperty("cr_id", $crows["cr_id"]);
			$objCropsS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsS->getCropsSchedule();
			$crp_sch=$objCropsS->dbFetchArray();
			$crp_perc=$crp_sch["percent"]*$cr_wat_req/(100*1);
	?>
		 <td align="center"><?php echo number_format($crp_sch["percent"]);?></td>
          
		 <?php }?>
			</tr>
            
        <tr>
          <td align="center" style="vertical-align:middle">1</td>
          <td align="center" valign="middle">%</td>
           <?php  
  $objTimescaleT->setProperty("yr_name", $default_year);
  $objTimescaleT->setProperty("start",$start_period);
  $objTimescaleT->setProperty("end",$end_period);
  $timescae_res=$objTimescaleT->getTimescale();
	while($trows=$objTimescaleT->dbFetchArray())
	{
		
			$objCropsS->setProperty("cr_id", $crows["cr_id"]);
			$objCropsS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsS->getCropsSchedule();
			$crp_sch=$objCropsS->dbFetchArray();
			$crp_perc=$crp_sch["percent"]*$cr_wat_req/(100*1);
	?>
     <td align="center"><?php echo number_format($crp_perc);?></td>
          
		 <?php }?>
        </tr>		
		<?php 
	}
	?>
</table>
          </div>