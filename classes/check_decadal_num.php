<?php 

  class check_dedical_num{
	  
	  function _check($checking_value ){
		  if($checking_value == '01-10') {
				return "1";

		  }	else if($checking_value == '11-20') {
				return "2";

		  } else if($checking_value == '21-28' || $checking_value == '21-30' || $checking_value == '21-31') {
				return "3";

		  } else {
				return "";

		  }
	
		
     }
}

?>