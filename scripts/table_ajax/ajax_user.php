<?php

if(isset($_GET['q'])  ){
      $u_id = $_GET['q'];
     // Modal
     echo   "

     <iframe class=\"ms-xxl-n3 height-600  max-height-600 \" src=\"../pages/edit_records/edit_user.php?id=$u_id\" title=\"user Table Form\" style = \"width: 107%;  \"></iframe>       
            " ;
}

?>
