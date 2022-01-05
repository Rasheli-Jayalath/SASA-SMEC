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

<?php 
$objTimescaleT = new Timescale();
$objCropsS = new Crops();	
$objUserCropsS = new UsersCrops();
$objUserCropsSS = new UsersCrops();
$objUserCropsSS->setProperty("yr_name",$default_year);
$objUserCropsSS->TotalgetUserCrops();
$tcrows=$objUserCropsSS->dbFetchArray();
$total_crop_area=$tcrows["total_crp_area"];
$objUserCropsS->setProperty("GROUP_BY", 'cr_id');
$objUserCropsS->setProperty("yr_name",$default_year);
$objUserCropsS->getUserCrops();
 $j=0;
 $yAxis_titiles_array = array();
 $tcrops=$objUserCropsS->totalRecords();
	while($crows=$objUserCropsS->dbFetchArray())
	{
		if($crows["crp_area"]>0){
			$crop_perc=($crows["crp_area"] /10);
			$crop_perc=number_format($crop_perc,2);
			$j++;
			
			$crp_atr.=' {
						name: "'.$crows["cr_name"].'",
						y: '.$crop_perc.',
						drilldown: "'.str_replace(" ","",$crows["cr_name"]).'"
					}';
					array_push($yAxis_titiles_array,$crows["cr_name"]);
						if($j<$tcrops)
								{
								$crp_atr.=" , ";
								} 
		}					  
		
	}?>
  <?php
  
   $total_canals=0;
   $total_crops=0;
   $i=0;
 $objCropsS->setProperty("yr_name", $default_year);
 $objCropsS->getCrops();
 $total_crops=$objCropsS->totalRecords();
		while($crows=$objCropsS->dbFetchArray())
		{
 
  $srt_data.= ' const '.str_replace(" ","",$crows["cr_name"]).' = [ ';
  $dril_str.= "{
      type: drilldownType(".str_replace(" ","",$crows["cr_name"])."),
      name: '".$crows["cr_name"]."',
      id: '".$crows["cr_name"]."',
      data: ".str_replace(" ","",$crows["cr_name"])." }";
 $canalNet->setProperty("yr_name", $default_year);
  $canalNet->setProperty("nc_code", $nc_code);
  $canal_result=$canalNet->getCannalNetwork();
  $total_canals=$canalNet->totalRecords();
  $j=0;
  $total_canals=17;
	while($rows=$canalNet->dbFetchArray())
	{
		
		
	 $nc_name=$rows["nc_name"];
	 $nc_type=$rows["nc_type"];
	 $total_crp_area=0;
		 if($nc_type!="Secondary"&&$nc_type!="Aggregate")
		{
		 $srt_data.=	"['".trim($rows["nc_name"])."', ";
		 $objCanalUser->setProperty("nc_id",$rows["nc_id"]);
		 $objCanalUser->getUserCanal();
		 if($objCanalUser->totalRecords()>0)
		 {
		  while($ucrows=$objCanalUser->dbFetchArray())
		  {
			 
			$objUserCrops->setProperty("uc_id", $ucrows["uc_id"]);
			$objUserCrops->setProperty("cr_id", $crows["cr_id"]);
			$objUserCrops->setProperty("yr_name",$default_year);
			$objUserCrops->getUserCrops();
			while($crp_sch=$objUserCrops->dbFetchArray())
			{
				$crp_area=$crp_sch["ucp_area"];
				$total_crp_area=$total_crp_area+$crp_area;
			}
		  
		   }
		   
		   }
		 $srt_data.=$total_crp_area.']';
		 $j++;	
		 if($j<$total_canals)
		  {
		   $srt_data.=", ";
		  }  
		}
  		$total_crp_area=0;	
	  } // end canal 
	      $srt_data.=']    
		  ' ;
				 $i++;	
				 if($i<$total_crops)
							  {
							   $dril_str.=", ";
							  }  
							
							 	  ?>
         <?php 
		  }
	  // end Canal Loop
	 // echo  $srt_data;
	 // echo $dril_str;?>  
 <div class="row text-center">
        <div class="col-sm-4" style="width:99.7%">
          <div class="well" style="width:99.7%">
       <figure class="highcharts-figure" style="width:101%; margin-left: -2%;">
    <div id="container"></div>
    <script>
// Returns 'column' if any point in array has negative value, default pie
function drilldownType(drilldownData) {
  return drilldownData.reduce(function(acc, val) {
    if (acc !== 'column') {
      acc = val[1] < 0 ? 'column' : 'bar'
    }
    return acc
  }, 'column')
}

 <?php echo  $srt_data; ?>

// Create the chart
Highcharts.chart('container', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Irrigated Cropping Summary'
  },
  subtitle: {
    text: 'Year (<?php echo $default_year;?> )'
  },
  xAxis: {
    categories: [<?php echo " '" .join($yAxis_titiles_array, '\', \''). "'"; ?>],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Area in Hectares'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' hectares '
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  credits: {
    enabled: false
  },
  series: [{
    showInLegend: false,
    name: 'Area in Hectares',
    colorByPoint: true,
    data: [<?php echo $crp_atr;?>]
  }]
});

</script>
</figure>
          </div>
        </div>
    	
      </div>