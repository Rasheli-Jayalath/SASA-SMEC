<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	
$CxW = new CanalXWater();

$objReports->resetProperty();
$objReports->setProperty("rps_id", 1);
$reports=$objReports->getReports();
$reports_rows=$objReports->dbFetchArray();
$report_title=$reports_rows["report_title"];
$start_period=$reports_rows["report_start_id"];
$end_period=$reports_rows["report_end_id"];

$irrigationPeriod=0;

 function getSecondaryAggregateWaterVolume($nc_code,$ts_id,$nc_conveyance_coeff)
 {
	
	$objCanalNet = new CanalNetworks(); 
	$objCanalNetC = new CanalNetworks(); 
	$objTimescaleTN = new Timescale();
	$objCropsSA = new Crops();
	$objCropsSAS = new Crops();	
	$objUserCropsS = new UsersCrops();	 
	$grand_total=0;
	$tflow_rate=0;
	$sum_vw=0;
	$vw=0;
	$flow_rate_sum=0;
	$flow_rate=0;
	$grand_flrate=0;
	   $total_canal=0;
	  $nc_code=substr($nc_code,0,6);
	 $objCanalNet->setProperty("nc_code",$nc_code);
	  
	 $canal_result=$objCanalNet->getCannalNetwork();
	
	while($rows=$objCanalNet->dbFetchArray())
	{
	 if($rows["nc_type"]=="Aggregate")
   {
	   
	 $taggwatervol= getTertiaryAggregateWaterVolume($rows["nc_code"],$ts_id,$rows["nc_conveyance_coeff"]);
	  $flow_rate=$taggwatervol['fr'];
	
	 //$sum_vw=$taggwatervol['wv'];
	  
	 //echo "<br/>";
	 
   }
   
	else
	{
	//check if tertiary have quaternary
	$sbcode=substr($rows["nc_code"],0,8);
	$objCanalNetC->setProperty("nc_code",$sbcode);
	$objCanalNetC->CheckQuaternary();
	$cres=$objCanalNetC->dbFetchArray();
	$total_canal=$cres["total_canals"];
	 
  $objTimescaleTN->setProperty("ts_id",$ts_id);
	$timescae_res=$objTimescaleTN->getTimescale();
	while($trows=$objTimescaleTN->dbFetchArray())
	{
		
		$objCropsSA->getCrops();
		while($crows=$objCropsSA->dbFetchArray())
		{
			
			$objCropsSAS->setProperty("cr_id", $crows["cr_id"]);
			$objCropsSAS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsSAS->getCropsSchedule();
			$crp_sch=$objCropsSAS->dbFetchArray();
			$objUserCropsS->setProperty("cr_id", $crows["cr_id"]);
			$objUserCropsS->setProperty("nc_id", $rows["nc_id"]);
			$objUserCropsS->CanalWiseUserCropArea();
			$cr_area=$objUserCropsS->dbFetchArray();
			$vw=$cr_area["total_croparea"]*$crp_sch["sch_wat"];
			 $sum_vw=$sum_vw+$vw;
			
		}
		
		if($rows["nc_conveyance_coeff"]!=0)
			{
			$flow_rate=$sum_vw*1000/(24*$trows["ts_days"]*3600*$rows["nc_conveyance_coeff"]);   /* 1000 for cubic meters to liters , 24 hours , 3600 for seconds  */
			}
			else
			{
			$flow_rate=0;
			}
	}
	
	}
	$grand_total=$grand_total+$sum_vw;
	   if($total_canal>1)
	   {
   			$flow_rate_sum=$flow_rate_sum+0;
	   }
	   else
	   {
		   $flow_rate_sum=$flow_rate_sum+$flow_rate;
		 }
		
		  $sum_vw=0;
         
		 } //end time scale
	
	if($nc_conveyance_coeff!=0)
	{
	$tflow_rate=$flow_rate_sum/$nc_conveyance_coeff;
	}
	$result = array();
	$result["wv"]= $grand_total;
	$result["fr"]= $tflow_rate;
	return $result;
 }

 function getTertiaryAggregateWaterVolume($nc_code,$ts_id,$nc_conveyance_coeff)
 {
	
	$objCanalNet = new CanalNetworks(); 
	$objTimescaleTN = new Timescale();
	$objCropsSA = new Crops();
	$objCropsSAS = new Crops();	
	$objUserCropsS = new UsersCrops();	 
	$grand_total=0;
	$tflow_rate=0;
	$sum_vw=0;
	$vw=0;
	$flow_rate_sum=0;
	$flow_rate=0;
	$grand_flrate=0;
	   
	  $nc_code=substr($nc_code,0,8);
	 $objCanalNet->setProperty("nc_code",$nc_code);
	  
	 $canal_result=$objCanalNet->getCannalNetwork();
	
	while($rows=$objCanalNet->dbFetchArray())
	{
	
	
  $objTimescaleTN->setProperty("ts_id",$ts_id);
	$timescae_res=$objTimescaleTN->getTimescale();
	while($trows=$objTimescaleTN->dbFetchArray())
	{
		
		$objCropsSA->getCrops();
		while($crows=$objCropsSA->dbFetchArray())
		{
			
			$objCropsSAS->setProperty("cr_id", $crows["cr_id"]);
			$objCropsSAS->setProperty("ts_id", $trows["ts_id"]);
			$objCropsSAS->getCropsSchedule();
			$crp_sch=$objCropsSAS->dbFetchArray();
			$objUserCropsS->setProperty("cr_id", $crows["cr_id"]);
			$objUserCropsS->setProperty("nc_id", $rows["nc_id"]);
			$objUserCropsS->CanalWiseUserCropArea();
			$cr_area=$objUserCropsS->dbFetchArray();
			$vw=$cr_area["total_croparea"]*$crp_sch["sch_wat"];
			 $sum_vw=$sum_vw+$vw;
			
		}
		
		if($rows["nc_conveyance_coeff"]!=0)
			{
			$flow_rate=$sum_vw*1000/(24*$trows["ts_days"]*3600*$rows["nc_conveyance_coeff"]);   /* 1000 for cubic meters to liters , 24 hours , 3600 for seconds  */
			}
			else
			{
			$flow_rate=0;
			}
		 $grand_total=$grand_total+$sum_vw;
		 $flow_rate_sum=$flow_rate_sum+$flow_rate;
		  $sum_vw=0;
         
		 } //end time scale
	}
	
	if($nc_conveyance_coeff!=0)
	{
	$tflow_rate=$flow_rate_sum/$nc_conveyance_coeff;
	}
	$result = array();
	$result["wv"]= $grand_total;
	$result["fr"]= $tflow_rate;
	return $result;
 }
?>

<script>
	function addCells( a, b, elementId){
		var row = document.getElementById("cellCount"+elementId);
		
		var x = row.insertCell(-1);
		x.innerHTML = a;
		var y = row.insertCell(-1);
		y.innerHTML = b;
	}

	function updateCell(a, b, elementId){
		var row = document.getElementById(elementId);
		// row[column].innerHTML = a;
		// row[column+1].innerHTML = b;
		var x = row.insertCell(-1);
		x.innerHTML = a;
		var y = row.insertCell(-1);
		y.innerHTML = b;
	}
</script>

<div class="well" style="">
	<table class="table table-bordered"  style="color:black" > 
		<thead style="background-color:#000066; vertical-align:middle; text-align:center; color:#FFF">
			<tr>
				<th colspan="44" align="center"><?php echo $report_title." (".$default_year.") ";?></th>
			</tr>
			<tr style="color:#fff">
				<th rowspan="2" style="text-align:center; vertical-align:middle">Sl. No</th>
				<th rowspan="2" style="text-align:center; vertical-align:middle">Canal Code</th>
				<th rowspan="2" style="text-align:center; vertical-align:middle">Canal Name</th>
				<th rowspan="2" style="text-align:center; vertical-align:middle">Canal Type</th>
				<th rowspan="2" style="text-align:center; vertical-align:middle" nowrap="nowrap">Conveyance Coefficient</th>
				
				<?PHP 
   
				$objTimescale->setProperty("yr_name", $default_year);
				$objTimescale->setProperty("start",$start_period);
				$objTimescale->setProperty("end",$end_period);
				$timescae_res=$objTimescale->getTimescale();
				$q=0;
				while($objTimescale->dbFetchArray())
				{ 
					echo "<th colspan=\"2\" style=\"text-align:center;\" >". (($q==0)? "Pre-Irrigation" : "Period-".$q). "</th>";
					$q++;
				} 
				
				?><th colspan="2" style="text-align:center; vertical-align:middle" >Total</th>
            </tr>
            <tr style="color:#fff">
				<?php 
				$irrigationPeriod = $q;
				while($q--)
				{
					echo "<th style=\"text-align:center\">VW,m3</th>";
					echo "<th style=\"text-align:center\">FR,l/s</th>";
				 
				}
				echo "<th style=\"text-align:center\">VW,m3</th>";
				echo "<th style=\"text-align:center\">FR,l/s</th>";
				?>
				
            </tr>
        </thead>
		<?php 
			
			$i=1; 
			$flag = true;

			$objTimescaleT->setProperty("yr_name", $default_year);	
			$objTimescaleT->setProperty("start",$start_period);
			$objTimescaleT->setProperty("end",$end_period);
			$timescae_res=$objTimescaleT->getTimescale();
			

			while($trows=$objTimescaleT->dbFetchArray())
			{
				$k=0;
				$agg = array();
				$row = 0;
				$secondaryRow = -1;

				$CxW->setProperty("ca_id", 3);
				$CxW->setProperty("nc_code", "NC0101");
				$CxW->setProperty("ts_id", $trows["ts_id"]);
				$CxW->getCanalWiseWater();

				while($cxw=$CxW->dbFetchArray()){

					$nc_type=$cxw["nc_type"];
					$nc_code = $cxw["nc_code"];
					$checkIsFound = false;

					if($nc_type==="Aggregate"|| $nc_type==="Secondary"){
						array_push($agg, $cxw);
						$agg[$row]['water'] = 0;
						$arr[$row]['flow'] =0;
						if($nc_type==="Secondary"){ $secondaryRow = $row; }
						$row++;
					} else{
						 $sub_nc_code=substr($nc_code,0,8);
						foreach($agg as &$value){
							$c = substr($value['nc_code'],0,8);
							if(strnatcmp($sub_nc_code, $c) == 0){
								$value['water'] += $cxw["water"];
								$value['flow'] += $cxw["flow"];
								$checkIsFound = true;
							}

							unset($value);
						}
						$agg[$secondaryRow]['water'] += $cxw["water"];
						if(!$checkIsFound){
							$agg[$secondaryRow]['flow'] += $cxw["flow"];
						}
					}
					
					if($flag){
						$nc_name=$cxw["nc_name"];
	
						if($nc_type==="Secondary")
						{
							$nc_name='<strong>'.$nc_name.'</strong>';
							$bgcolor = "#09F;";
						}
						else if($nc_type==="Aggregate")
						{
							$nc_name='&nbsp;&nbsp;<strong>'.$nc_name.'</strong>';
							$bgcolor = "#005CB9";
						}
						else if($nc_type==="Tertiary")
						{
							$nc_name='&nbsp;&nbsp;'.$nc_name;
							$bgcolor = "#C6E2FF";
						}
						else
						{
							$nc_name='&nbsp;&nbsp;&nbsp;&nbsp;'.$nc_name;
							$bgcolor = "#EAF4FF" ;
						}

						if($nc_type==="Aggregate" || $nc_type==="Secondary"){
							echo "<tr id=\"".$nc_code."\" style=\"background-color:" . $bgcolor . "\">";
						}
						else {
							echo "<tr id=\"cellCount".$k++."\" style=\"background-color:" . $bgcolor . "\">";
						}
							echo "<td>". $i++ ."</td>";
							echo "<td>". $nc_code."</td>";
							echo "<td nowrap=\"nowrap\">". $nc_name."</td>";
							echo "<td align=\"center\">".$nc_type."</td>";
							echo "<td align=\"center\">".$cxw["factor"]."</td>";
							if($nc_type==="Aggregate" || $nc_type==="Secondary"){

							}else {
								echo "<td align=\"center\">". number_format($cxw["water"]).    "</td>";
								echo "<td align=\"center\">". number_format($cxw["flow"]).     "</td>";
							}
			
					} 
					else { 
						if($nc_type==="Aggregate" || $nc_type==="Secondary"){

						}else {
							$var1 = number_format($cxw["water"]);
							$var2 = number_format($cxw["flow"]);
							echo "<script>addCells('$var1', '$var2', '$k');</script>";
							$k++;
						}
					}
				}

				$flag = false;
				$k=0;
				echo "</tr>";

				$secFlow = 0;
				
				foreach($agg as $value){
					$var1 = number_format($value['water']);
					$var2 = number_format($value['flow']/$value['factor']);
					$r = $value['nc_code'];
					if($value['nc_type']==="Aggregate"){
						$secFlow += $value['flow']/$value['factor'];
						echo "<script>updateCell('$var1', '$var2', '$r');</script>";
					}
				}
				
				
				$var1 = number_format($agg[$secondaryRow]['water']);
				$var2 = number_format(($agg[$secondaryRow]['flow']+$secFlow)/$agg[$secondaryRow]['factor']);
				$r = $agg[$secondaryRow]['nc_code'];
				echo "<script>updateCell('$var1', '$var2', '$r');</script>";

				unset($agg);
				//echo "<td align=\"center\">total</td>";
				//echo "<td align=\"center\">total 1</td>";
			} 
			?>
	</table>
</div>