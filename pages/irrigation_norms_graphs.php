<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	

function getMonthlyCropWater($cr_id,$ts_month,$cr_wat_req)
{
	$objCropsSS = new Crops();	
	$objTimescaleTT = new Timescale();
	$total_crp_perc=0;
	//$objTimescaleTT->setProperty("yr_name", $default_year);
	$objTimescaleTT->setProperty("ts_month", $ts_month);
	$timescae_res=$objTimescaleTT->getTimescale();
  	$total_months=$objTimescaleTT->totalRecords();
	while($tsrows=$objTimescaleTT->dbFetchArray())
	{
	$objCropsSS->setProperty("cr_id", $cr_id);
	$objCropsSS->setProperty("ts_id", $tsrows["ts_id"]);
	$objCropsSS->getCropsSchedule();
	$crp_sch=$objCropsSS->dbFetchArray();
	$crp_perc=$crp_sch["percent"]*$cr_wat_req/(100*1);
	$total_crp_perc=$total_crp_perc+$crp_perc;
	$total_crp_perc=round($total_crp_perc);
	}
	
	return $total_crp_perc;
} 
$objReports->resetProperty();
$objReports->setProperty("rps_id", 6);
$reports=$objReports->getReports();
$reports_rows=$objReports->dbFetchArray();
$report_title=$reports_rows["report_title"];
$start_period=$reports_rows["report_start_id"];
$end_period=$reports_rows["report_end_id"];
$objTimescale->setProperty("yr_name", $default_year);
$objTimescale->setProperty("start",$start_period);
$objTimescale->setProperty("end",$end_period);
  $timescae_res=$objTimescale->getTimescale();
  $total_months=$objTimescale->totalRecords();
  $i=0;
$prev=0;
	while($tsrows=$objTimescale->dbFetchArray())
	{
		
	$current=$tsrows["ts_month"];
	
   if($current!=$prev)
   {
	   $month="01-".$tsrows["ts_month"]."-".$tsrows["yr_name"]; 
	   $month=date("M", strtotime($month));
	   $months_str .="'".$month."'";
	    $i++; 
	 if($i<$total_months/3)
	  {
	   $months_str .=" , ";
	  }  
	  
	   
	 
   }
   $prev=$current; 
  
  
   }
 $objCrops->setProperty("yr_name", $default_year);
 $objCrops->getCrops();
 $j=0;
 $total_crp_perc1=0;
 $total_crp_perc=0;
 $tcrops=$objCrops->totalRecords();
	while($crows=$objCrops->dbFetchArray())
	{
		$j++;
		   $crp_atr.="{
                name: '".$crows["cr_name"]."',
                data: [";
				  $prev1=0;
				  $k=0;
				  $objTimescaleT->setProperty("start",$start_period);
				  $objTimescaleT->setProperty("end",$end_period);
				  $objTimescaleT->setProperty("yr_name", $default_year);
				  $timescae_res=$objTimescaleT->getTimescale();
				   $total_months=$objTimescaleT->totalRecords();
					while($trows=$objTimescaleT->dbFetchArray())
					{ 
							$current1=$trows["ts_month"];
	
						   if($current1!=$prev1)
						   {   
						       $crp_perc=getMonthlyCropWater($crows["cr_id"],$trows["ts_month"],$crows["cr_wat_req"]);
							   $crp_atr.=$crp_perc;
							   $k++;
							   if($k<$total_months/3)
							  {
							   $crp_atr.=" , ";
							  }  
							  $total_crp_perc=0;
							}
							
						   $prev1=$current1;
						   
					}
					
			
			$crp_atr.="]  
            }"; // crp_area_str:7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6
		if($j<$tcrops)	
		{
			$crp_atr.=",";
		}
	$total_crp_perc=0;
	}
//echo $crp_atr;
?>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            title: {
                text: 'Crop Water Use As per Norm',
                x: -20 //center
            },
            subtitle: {
                text: 'Month Wise (<?php echo $default_year;?>)',
                x: -20
            },
            xAxis: {
                categories: [<?php echo $months_str;?>]
            },
            yAxis: {
                title: {
                    text: 'Irrigated Aread m3/ha'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' (m3/ha)'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [<?php echo $crp_atr; ?>]
        });
    });
    

		</script>


           <figure class="highcharts-figure text-center" style="width:99.8%; margin-left: 0;">
              <div id="container" style="width:99.8%; margin-left: 0;"></div>
           </figure>
