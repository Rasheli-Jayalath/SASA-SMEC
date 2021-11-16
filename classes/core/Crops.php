<?php
/**
*
* This is a class Crops
*
**/
class Crops extends DataBase{
	

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

	
	public function getCrops()
	{
		$Sql = "SELECT 
		a.cr_id, 
		a.cr_name, 
		a.cr_wat_req, 
		a.yr_name
		FROM wh_001_crops_main a
				WHERE 
					1=1 AND a.yr_name=2020";
		if($this->isPropertySet("cr_id", "V"))
			$Sql .= " AND a.cr_id=" . $this->getProperty("cr_id");
		if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			
			$Sql .= " ORDER BY cr_name ASC";
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);
	}
	public function getCropsSchedule()
	{
		$Sql = "SELECT 
		a.cwp_id,
		a.cr_id, 
		a.ts_id, 
		a.percent, 
		a.sch_wat,
		a.yr_name
		FROM wh_001_crop_per_main a
				WHERE 
					1=1";
		if($this->isPropertySet("cwp_id", "V"))
			$Sql .= " AND a.cwp_id=" . $this->getProperty("cwp_id");
		if($this->isPropertySet("cr_id", "V"))
			$Sql .= " AND a.cr_id=" . $this->getProperty("cr_id");
		if($this->isPropertySet("ts_id", "V"))
			$Sql .= " AND a.ts_id=" . $this->getProperty("ts_id");
			$Sql .= " ORDER BY cwp_id ASC";
		
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