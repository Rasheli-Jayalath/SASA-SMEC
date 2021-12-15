<?php

if(isset($_GET['q'])  ){
      $cr_id = $_GET['q'];
     // Modal
     echo   "

     <iframe class=\"ms-xxl-n3 height-600  max-height-600 \" src=\"../pages/edit_records/edit_crop.php?id=$cr_id\" title=\"Crop-form\" style = \"width: 107%;  \"></iframe>       
            " ;
}

?>
