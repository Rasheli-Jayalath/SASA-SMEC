<?php 

  class check_active{
	  
	  function _check($checking_value, $default_value){
		  if($checking_value == $default_value) {
			return "active";
		  }else{
			return "";
		  }
	
		
     }
}
//   <?php $obj = new check_active(); echo $obj->_check( '1',  $navbar ); 
// <?php  include '../Classes/navbar_active.php';  


?>

