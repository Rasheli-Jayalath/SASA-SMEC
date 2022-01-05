  <!--     making the connection with DB     -->
  <?php require_once('../Config/connection.php'); ?>
  <?php  include '../Classes/check_decadal_num.php';  ?>
  <?php  include '../Classes/get_values_crop_per.php';  ?>


<?php 

    $a= array(" ","January","February","March","April","May","June","July","August","September", "October", "November", "December"); 
    $max=sizeof($a);
    $default_year = 2020;

if(!empty($_POST["start_month_id"])){ 
    $start_month_id = $_POST["start_month_id"];
    echo '<option value=""> Select end month </option>'; 
    for($i=$start_month_id; $i<$max; $i++) { 
    echo '<option value="'.$i.'">'.$a[$i] ."&nbsp;&nbsp; <span style= \" \">".$default_year.'</option>'; 

    }

}elseif(!empty($_POST["end_month_id"])){ 
    $end_month_id = $_POST["end_month_id"];
    echo ' <select >'; 
    echo '<option value=""> Select end month </option>'; 
    for($i=$start_month_id; $i<$end_month_id+1; $i++) {
    echo '<option value="'.$i.'">'. str_pad($a[$i],20,"_",STR_PAD_LEFT) .$default_year.'</option>'; 
    }
    echo ' </select>'; 
} elseif(  !empty($_POST["starting_month"]) && !empty($_POST["ending_month"]) && !empty($_POST["IDcrop_name"]) ){ 
    $starting_month = $_POST["starting_month"];
    $ending_month = $_POST["ending_month"];
    $IDcrop_name = $_POST["IDcrop_name"];
    $sql = "SELECT * FROM wh_001_tscale_main  WHERE yr_name = 2020  AND ts_month BETWEEN $starting_month AND $ending_month";
    $result = mysqli_query($connection , $sql);	


    $sql_wat_req = "SELECT * FROM wh_001_crops_main   WHERE yr_name = 2020  AND cr_id= $IDcrop_name LIMIT 1 ";  
    $result_set_wat_req=mysqli_query($connection,$sql_wat_req);
    $result_wat_req = mysqli_fetch_assoc($result_set_wat_req);
    $cr_wat_req = $result_wat_req['cr_wat_req'];

    $i = 1;
    echo '<div class="row pt-1" >'; 
    echo '<h6 class="text-center mb-1"> Records for Crop - '. $result_wat_req['cr_name'].'</h6>';
    while ($row = mysqli_fetch_array($result)) {

	$month_id = $row['ts_month'];

        echo '<div class="col-md-4" >'; 
        echo '<div class="form-group text-sm">'; 
        $obj = new check_decadal_num();
        $decadal_num = $obj->_check( $row['ts_period'] ) ; 

        $obj2 = new get_Values_crop_per();
        $sch_wat = $obj2->_get_sch_wat( $row['ts_id'] , $IDcrop_name) ; 
        $percent = $obj2->_get_percent( $row['ts_id'] , $IDcrop_name) ; 

        echo '<b>'.$a[$month_id] .'</b> ('.$row['ts_period'].')  &nbsp; <b>Decadal-'.$decadal_num.'</b>'; 
        echo '<div style = " display: flex;">'; 
        echo '<input class="form-control" type="number"  id="value_sch_wat'.$i.'" value="' . $sch_wat . '"  name="sch_wat_value'.$i.'" style="width: 155%; padding-right: 0;" readonly>   &nbsp; '; 
        echo '<input class="form-control" type="number" step=0.00001 value="' . $percent . '" id=""  min="0" max="100" placeholder="Percentage" name="percent_value'.$i.'" '; 
        echo 'style="width: 89%; border-top-right-radius: 0; border-bottom-right-radius: 0; padding-left: 5px; padding-right: 0;" '; 
        echo 'oninput="LengthConverter(this.value,'.$i.')" onchange="LengthConverter(this.value,'.$i.')"> '; 
        echo '<span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0; padding-right: 8px; padding-left: 5px;">%</span>';
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        $i++;

        }

        echo '<script>'; 
        echo 'function LengthConverter(valNum,cellID) {'; 
        echo '  document.getElementById("value_sch_wat"+cellID).value =('.$cr_wat_req.'/100)*valNum;'; 
        echo '}'; 
        echo '</script> '; 

        echo '</div>'; 
    
} 

?>
