<?php 
    $a= array("ttr","January","February","March","April","May","June","July","August","September", "October", "November", "December"); 
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
  
    for($i=$starting_month; $i<$ending_month+1; $i++) {
        echo '<div class="row pt-3">'; 
        echo '<div class="col-md-4">'; 
        echo '<div class="form-group text-sm">'; 
        echo ''.$a[$i] .' Decadal 1 : &nbsp; '; 
        echo '<input class="form-control" type="number" value="" id="" min="0" placeholder="Enter the value here ">'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '<div class="col-md-4">'; 
        echo '<div class="form-group text-sm">'; 
        echo ''.$a[$i] .' Decadal 2 : &nbsp; '; 
        echo '<input class="form-control" type="number" value="" id="" min="0" placeholder="Enter the value here ">'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '<div class="col-md-4">'; 
        echo '<div class="form-group text-sm">'; 
        echo ''.$a[$i] .' Decadal 3 : &nbsp; '; 
        echo '<input class="form-control" type="number" value="" id="" min="0" placeholder="Enter the value here "> '; 
        echo '</div>'; 
        echo ' </div>'; 
        echo '</div>'; 


        }
    
} 

?>
