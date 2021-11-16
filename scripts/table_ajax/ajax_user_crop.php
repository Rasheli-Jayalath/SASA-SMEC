<?php

if(isset($_GET['q'])  ){
      $ucp_id = $_GET['q'];
     // Modal
     echo   "

     <iframe class=\"ms-xxl-n3 height-600  max-height-600 \" src=\"../pages/edit_records/edit_user_crop.php?id=$ucp_id\" title=\"user Table Form\" style = \"width: 107%;  \"></iframe>       
            " ;
}

?>
