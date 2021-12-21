  <!--     making the connection with DB     -->
  <?php require_once('../Config/connection.php'); ?>
  <?php  include '../Classes/check_dedical_num.php';  ?>

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
} elseif(  !empty($_POST["starting_month"]) && !empty($_POST["ending_month"])){ 
    $starting_month = $_POST["starting_month"];
    $ending_month = $_POST["ending_month"];
    $sql = "SELECT * FROM wh_001_tscale_main  WHERE yr_name = 2020  AND ts_month BETWEEN $starting_month AND $ending_month";
    $result = mysqli_query($connection , $sql);	
    $i = 1;
    echo '<div class="row pt-3" >'; 
    while ($row = mysqli_fetch_array($result)) {

	$month_id = $row['ts_month'];

        echo '<div class="col-md-4" >'; 
        echo '<div class="form-group text-sm">'; 
        $obj = new check_dedical_num();
        $dedical_num = $obj->_check( $row['ts_period'] ) ; 
        echo '<b>'.$a[$month_id] .'</b> ('.$row['ts_period'].')  &nbsp; <b>Dedical-'.$dedical_num .'</b>'; 
        echo '<div style = " display: flex;">'; 
        echo '<input class="form-control" type="number" value="" id="" min="0" placeholder="Enter value"" name="sch_wat_value'.$i.'" style="width: 155%; padding-right: 0; ">   &nbsp; '; 
        echo '<input class="form-control" type="number" value="" id="" min="0" max="100"placeholder="Percentage" name="percent_value'.$i.'" style="width: 89%; border-top-right-radius: 0; border-bottom-right-radius: 0; padding-left: 5px; padding-right: 0; "> '; 
        echo '<span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0; padding-right: 8px; padding-left: 5px;">%</span>';
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        $i++;
        }              
        echo '</div>'; 
    
} 

?>
