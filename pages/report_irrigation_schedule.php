<!--     making the connection with DB     -->
<?php require_once('Config/connection.php'); ?>

<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	 
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
              <h6><?php //echo $report_title." ".$default_year; 
			  echo "Proposed Irrigation Schedule (m<sup>3</sup>/ha) for ".$default_year; ?></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" > 
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Crop</th>
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
        <th >&nbsp; TOTAL</th>
        <th >&nbsp;Norms<small autocapitalize="none" >(m<sup>3</sup>/ha) </small></th>
        <th >Difference</th>
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
	while($trows=$objTimescaleT->dbFetchArray())
	{
		
			$objCropsS->setProperty("cr_id", $crows["cr_id"]);
			$objCropsS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsS->getCropsSchedule();
			$crp_sch=$objCropsS->dbFetchArray();
	?>
  
		 <td align="center"><?php echo number_format($crp_sch["sch_wat"]);?></td>
          
		 <?php }?>
     <td align="center"> -- </td>
     <td align="center"> <?php 
          $query = "SELECT cr_wat_req FROM `wh_001_crops_main` WHERE yr_name = $default_year "; 
          $result = $connection->query($query); 
            if($result->num_rows > 0){ 

                while($row = $result->fetch_assoc()){  
                    echo ' '.$row['cr_wat_req']. ' '; 

                } 
            } ?>
     </td>
  
     <td align="center">  </td>
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
