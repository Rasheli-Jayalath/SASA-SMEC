<?php 

$objTimescaleT = new Timescale();
$objCropsS = new Crops();
$objSumJoin = new SumJoin();	

$objReports->resetProperty();
$objReports->setProperty("rps_id", 5);
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
            <th colspan="40" ><?php echo $report_title;?></th>
            </tr>
            <tr style="color:#fff">
            <th rowspan="2" style="text-align:center; vertical-align:middle">Canal Name</th>
            <?PHP 

		$total_crp_area=0;
		$first= 0;
		$objCrops->setProperty("yr_name", $default_year);
		$objCrops->getCrops();
		$totalCrop = $objCrops->totalRecords();
		while($crows=$objCrops->dbFetchArray7())
		{
			?>
   <th  style="text-align:center;"><?php echo $crows["cr_name"];?></th>
    <?php
	
	}
	?>
            </tr>

            </thead>
            <tr style="background-color:#09F;">
        <td><?php 
		
			echo "<strong>KAPAL Canal</strong> ";  
		?></td>
       
         <?php  
		 
	$total_crp_area=0;
		  $objCrops->setProperty("yr_name", $default_year);
		  $objCrops->getCrops();
		while($crows=$objCrops->dbFetchArray())
		{
			
			$total_crp_area=0;	
			$objSumJoin->resetProperty();
			$objSumJoin->setProperty("yr_name", $default_year);
			$objSumJoin->setProperty("cr_name", $crows["cr_name"]);
			$objSumJoin->getSumOfUserCropsXCrops($default_year, $crows["cr_name"]);
			$sum = $objSumJoin->dbFetchArray();
			$total_crp_area = $sum["total"];
		
		?>
		 <td align="center"><?php echo number_format($total_crp_area);?></td>
          
		 <?php
		
		
	  } //end crop
	 
		?>
         </tr>
   <?php 
    //exit();

   $i=0;
   $current_canal=0;
   $pev_canal=0;
   $array=array();
//    $canalNet->setProperty("ca_id", $idsrows["ca_id"]);
//    $canalNet->setProperty("nc_code", $nc_code);
   $canal_result=$objSumJoin->getCanalCrops(3, "NC0101",2020);
	while($rows=$objSumJoin->dbFetchArray())
	{
		
		$total_crp_area =0;
	 $nc_name=$rows["nc_name"];
	 $nc_type=$rows["nc_type"];
	 $array[$i] = $rows["total"];
	 
	 if($i === 0){
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
		
	}

		  if($nc_type!="Secondary"&&$nc_type!="Aggregate")
		  { 
			 if($i===0){ ?>
		  
    			<tr style="background-color:<?php echo $bgcolor;?>;">
				<td> <?php echo "<strong>$nc_name</strong> ";?></td>
				<?php 
			}
			
				if($i >= $totalCrop-1){
					
					foreach($array as $data){
					?>
				<td align="center"><?php echo number_format($data);}?></td>
				</tr>
				<?php
				
				}
		}
		
		$i++;
		
		if($i >= $totalCrop) $i=0;
	}
	 ?>
</table>
          </div>