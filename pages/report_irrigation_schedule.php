<style>

table{ text-align: center; }
.table-container{ 
  overflow: scroll;
}
table th, table td {
  white-space: nowrap;


}
table tr th:first-child, table td:first-child{
  position: sticky;
  left: 0;
  z-index: 10;
  background: rgb(240, 240, 255);
  opacity: 1;

}
table tr th:first-child{
  z-index: 11;
}
table tr th{
  position: sticky;
  top: 0;
  z-index: 9;
}

</style>


<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	
$objCropsT = new Crops(); 
$objReports->resetProperty();
$objReports->setProperty("rps_id",3);
$reports=$objReports->getReports();
$reports_rows=$objReports->dbFetchArray();
$report_title=$reports_rows["report_title"];
$start_period=$reports_rows["report_start_id"];
$end_period=$reports_rows["report_end_id"];
 
?>
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="text-center text-gradient  text-dark   opacity-9 font-weight-bold "><?php //echo $report_title." ".$default_year; 
			  echo "Proposed Irrigation Schedule (m<sup class=\" text-center text-gradient  text-dark \">3</sup>/ha) for ".$default_year; ?></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" > 
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Crop</th>
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
    <th>
    Total
    </th>
     <th>
    Norm 
    </th><th>
    Difference
    </th>
                    </tr>
                    <tr>
            <th >&nbsp;</th>
            <?php 
			$prv1=0;
			$current1=0;
	   $objTimescale->setProperty("yr_name", $default_year);
	   $objTimescale->setProperty("start",$start_period);
  	   $objTimescale->setProperty("end",$end_period);
	   $timescae_res2=$objTimescale->getTimescale();
	 
	   while($timescae_res2=$objTimescale->dbFetchArray())
	{
		  $current1=$timescae_res2["ts_month"];
	
   if($current1!=$prv1)
   {?>
              <th style="text-align:center"><?php echo "I";?></th>
              <th style="text-align:center"><?php echo "II";?></th>
              <th style="text-align:center"><?php echo "III";?></th>
             
      <?php }
	  $prv1=$current1;
	  }?>
      <th>
      </th>
      <th>
      <span class="text-xs text-muted text-lowercase font-italic " style="padding-top: -5px;"> (m<sub>3</sub>/ha) </span> <br>

      </th>
      <th>
      </th>
              </tr>
                  </thead>
                  <tbody>
                   <?php $objCrops->setProperty("yr_name", $default_year);
   $objCrops->getCrops();
	while($crows=$objCrops->dbFetchArray())
	{
	?>
        <tr>
        
		 <td align="center" style="vertical-align:middle"><?php 	 echo $cr_name=$crows["cr_name"];  ?></td>
          <?php  
  $objTimescaleT->setProperty("yr_name", $default_year);
  $objTimescaleT->setProperty("start",$start_period);
  $objTimescaleT->setProperty("end",$end_period);
  $timescae_res=$objTimescaleT->getTimescale();
   $total_crop_sch=0;
	while($trows=$objTimescaleT->dbFetchArray())
	{
		
			$objCropsS->setProperty("cr_id", $crows["cr_id"]);
			
			$objCropsS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsS->getCropsSchedule();
			$crp_sch=$objCropsS->dbFetchArray();
	?>
		 <td align="center"><?php echo number_format($crp_sch["sch_wat"]);?></td>
         
		 <?php 
		 $total_crop_sch+=$crp_sch["sch_wat"];}?>
          <td align="center"><?php echo $total_crop_sch;?></td>
          <td align="center"><?php echo $crows["cr_wat_req"];?></td>
          <td align="center"><?php echo $crows["cr_wat_req"]-$total_crop_sch;?></td>
			</tr>
            
        <?php 
	}
	?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
