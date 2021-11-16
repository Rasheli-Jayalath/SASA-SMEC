<?php

if(isset($_GET['q'])  ){
      $uc_id = $_GET['q'];
     // Modal
     echo   "

     <iframe class=\"ms-xxl-n3 height-600  max-height-600 \" src=\"../pages/edit_records/edit_user_canal.php?id=$uc_id\" title=\"user canal\" style = \"width: 107%;  \"></iframe>       
            " ;
}

?>
