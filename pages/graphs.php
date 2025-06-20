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
 
 $tcrops=$objUserCropsS->totalRecords();
	while($crows=$objUserCropsS->dbFetchArray())
	{
    if($crows["crp_area"]>0){
		$crop_perc=($crows["crp_area"]/$total_crop_area)*100;
		$crop_perc=number_format($crop_perc,2);
		$j++;
		
		   $crp_atr.=' {
                    name: "'.$crows["cr_name"].'",
                    y: '.$crop_perc.',
                    drilldown: "'.str_replace(" ","",$crows["cr_name"]).'"
                }';
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
		  }
?>  

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS scrollbar Files -->
    <link id="pagestyle" href="assets/css/scrollbar.css" rel="stylesheet" />
</head>

<body >


          
     <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
            
                   <figure class="highcharts-figure">
    <div id="container"></div>
    <script>
// Returns 'column' if any point in array has negative value, default pie
function drilldownType(drilldownData) {
  return drilldownData.reduce(function(acc, val) {
    if (acc !== 'column') {
      acc = val[1] < 0 ? 'column' : 'pie'
    }
    return acc
  }, 'column')
}

 <?php echo  $srt_data; ?>

// Create the chart
Highcharts.chart('container', {
  chart: {
    type: 'pie'
  },
   title: {
        text: 'Cropping Pattern Summary Irrigated Area %'
    },
    subtitle: {
        text: 'Click the slices to view Canal Wise'
    },
	 plotOptions: {
        series: {
            dataLabels: {
                enabled: true
            }
        }
    },
    credits: {
    enabled: false
  },
  series: [{
    name: 'Crops',
    colorByPoint: true,
    data: [<?php echo $crp_atr;?>]
  }],
  drilldown: {
    series: [
	
	<?php echo $dril_str;?>
	]
  }
});

</script>
</figure>
                

            </div>
          </div>
        </div>  

        <div class="col-lg-7" >
          <div class="card"  >
      
            <iframe class ="" src="includes/chart-right.php?yr_name= <?php echo $default_year; ?> " style = " height :450px  " ></iframe>
   
          </div>
        </div>
      </div>

    </body>

</html>