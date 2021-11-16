<?php
/**
*
* This is a class Crops
*
**/
class SumJoin extends DataBase{
	

	protected $cr_id;
	protected $cr_name;
	protected $cr_wat_req;
	protected $yr_name;
	
	
	/**
	* This is the constructor of the class Crop
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getSumOfUserCropsXCrops($yr_name, $cr_name)
	{

		$Sql = "SELECT cm.cr_name as name,SUM(uc.ucp_area) As total
                FROM wh_001_crops_main AS cm
                JOIN wh_002_users_crops AS uc
                ON uc.cr_id = cm.cr_id
				WHERE 
					1=1";
		// if($this->isPropertySet("cr_id", "V"))
		// 	$Sql .= " AND cm.cr_id=" . $this->getProperty("cr_id");
		// if($this->isPropertySet("yr_name", "V")){
        //     echo $this->getProperty("yr_name");
		// 	$Sql .= " AND cm.yr_name=" . $this->getProperty("yr_name");
        // }
        // if($this->isPropertySet("cr_name", "V"))
		// 	$Sql .= " AND cm.cr_name=" . $this->getProperty("cr_name");
			// $Sql .= " ORDER BY cm.cr_id ASC";
		
            $Sql .= " AND cm.yr_name=" . $yr_name;
            $Sql .= " AND cm.cr_name='" . $cr_name . "'";
		

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);
	}

	public function getCanalCrops($command, $code, $year)
	{

		$Sql = "SELECT 
		a.nc_name,
		a.nc_type, 
		a.nc_code, 
		(SELECT cm.cr_name FROM wh_001_crops_main AS cm WHERE cm.cr_id = ur.cr_id AND cm.yr_name =".$year.") AS crop,
		ur.ucp_area,
		SUM(ur.ucp_area) AS total
		FROM wh_002_users_canal AS uc
		JOIN wh_000_network_canals AS a ON a.nc_id=uc.nc_id
		JOIN wh_002_users_crops AS ur ON uc.uc_id = ur.uc_id
				WHERE 
					1=1";
		// if($this->isPropertySet("cwp_id", "V"))
		// 	$Sql .= " AND a.cwp_id=" . $this->getProperty("cwp_id");
		// if($this->isPropertySet("cr_id", "V"))
		// 	$Sql .= " AND a.cr_id=" . $this->getProperty("cr_id");
		// if($this->isPropertySet("ts_id", "V"))
		// 	$Sql .= " AND a.ts_id=" . $this->getProperty("ts_id");

			$Sql .= " AND a.ca_id =".$command;
			$Sql .= " AND a.nc_code LIKE '%".$code."%'";
			$Sql .= " AND a.yr_name = ". $year;
			$Sql .= " GROUP BY a.nc_name, crop ORDER BY a.nc_code, crop ASC";
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);
	}
	public function getCropsIds()
	{
		$result=$this->dbQuery("SELECT cr_id from wh_001_crops_main");
	   	return $result;
	
	}
}
?>