<?php 

$objTimescaleTT = new Timescale();
$objCropsSS = new Crops();	

function getMonthlyCropWater($cr_id,$ts_month)
{
	$objCropsSSS = new Crops();	
	$objTimescaleTTT = new Timescale();
	$total_crp_perc=0;
	$objTimescaleTTT->setProperty("ts_month", $ts_month);
	$objTimescaleTTT->setProperty("yr_name", $default_year);
	$timescae_res=$objTimescaleTTT->getTimescale();
  	$total_months=$objTimescaleTTT->totalRecords();
	while($tsrows=$objTimescaleTTT->dbFetchArray())
	{
	$objCropsSSS->setProperty("cr_id", $cr_id);
	$objCropsSSS->setProperty("ts_id", $tsrows["ts_id"]);
	$objCropsSSS->getCropsSchedule();
	$crp_sch=$objCropsSSS->dbFetchArray();
	$crp_perc=$crp_sch["sch_wat"];
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
				  $objTimescaleTT->setProperty("yr_name", $default_year);
				  $objTimescaleTT->setProperty("start",$start_period);
				  $objTimescaleTT->setProperty("end",$end_period);
				  $timescae_res=$objTimescaleTT->getTimescale();
				   $total_months=$objTimescaleTT->totalRecords();
					while($trows=$objTimescaleTT->dbFetchArray())
					{ 
							$current1=$trows["ts_month"];
	
						   if($current1!=$prev1)
						   {   
						       $crp_perc=getMonthlyCropWater($crows["cr_id"],$trows["ts_month"]);
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
            }"; 
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
        $('#container1').highcharts({
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
 <div class="row">
        <div class="col-sm-4" style="width:1400px">
          <div class="well" style="width:1400px">
           <figure class="highcharts-figure" style="width:1390px">
    <div id="container1" style="width:1390px"></div>
   
</figure>
          </div>
        </div>
    	
      </div>