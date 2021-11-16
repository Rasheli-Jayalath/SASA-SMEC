<?php
/**
*
* This is a class UsersCrop
*
**/
class UsersCrops extends DataBase{
	protected $ucp_id;
	protected $uc_id;
	protected $cr_id;
	protected $ucp_area;
	protected $ucp_area_unit;
	protected $yr_name;
	
	/**
	* This is the constructor of the class UsersCrop
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getUserCrops()
	{
		$Sql="SELECT a.ucp_id,
					 a.uc_id, 
					 a.cr_id,
					 (select cr_name from wh_001_crops_main b where a.cr_id=b.cr_id) as cr_name,
					 a.ucp_area,
					 a.ucp_area_unit,
					 sum(a.ucp_area) as crp_area,
					 a.yr_name
					 FROM wh_002_users_crops a
					WHERE 1=1 ";
		if($this->isPropertySet("ucp_id", "V"))
			$Sql .= " AND a.ucp_id=" . $this->getProperty("ucp_id");
		if($this->isPropertySet("uc_id", "V"))
			$Sql .= " AND a.uc_id=" . $this->getProperty("uc_id");
			
			if($this->isPropertySet("cr_id", "V"))
			$Sql .= " AND a.cr_id =" . $this->getProperty("cr_id")."";

			if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			if($this->isPropertySet("GROUP_BY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUP_BY")."";
		
		return $this->dbQuery($Sql);
	
	}
	public function TotalgetUserCrops()
	{
		$Sql="SELECT 
					 sum(a.ucp_area) as total_crp_area,
					 a.yr_name
					 FROM wh_002_users_crops a
					WHERE 1=1 ";
		if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			if($this->isPropertySet("GROUP_BY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUP_BY")."";
		
		return $this->dbQuery($Sql);
	
	}
	public function getUserCropsIds()
	{
		$result=$this->dbQuery("SELECT ucp_id from wh_002_users_crops");
	   	return $result;
	
	}
	public function CanalWiseUserCropArea()
	{
		$Sql="SELECT a.nc_id, 
					 b.cr_id, 
					 sum(b.ucp_area) as total_croparea 
					 FROM wh_002_users_canal a 
					 INNER JOIN wh_002_users_crops b ON (a.uc_id = b.uc_id) 
					WHERE 1=1 ";
		if($this->isPropertySet("nc_id", "V"))
			$Sql .= " AND a.nc_id=" . $this->getProperty("nc_id");
			
			if($this->isPropertySet("cr_id", "V"))
			$Sql .= " AND b.cr_id =" . $this->getProperty("cr_id")."";
			
			$Sql .= "  GROUP BY a.nc_id, b.cr_id";
		
			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);
		
	}
}
?>