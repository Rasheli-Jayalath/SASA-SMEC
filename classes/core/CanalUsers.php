<?php
/**
*
* This is a class CanalUsers
*
**/
class CanalUsers extends DataBase{
	
	protected $uc_id;
	protected $u_id;
	protected $nc_id;
	protected $uc_area;
	protected $uc_area_unit;
	protected $yr_name;
	
	/**
	* This is the constructor of the class Canal Users
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getUserCanal()
	{
		
		$Sql="SELECT a.uc_id,
					 a.u_id,
					 (select b.u_name from wh_002_users b where b.u_id=a.u_id) as uname,
					 a.nc_id, 
					 a.uc_area,
					 a.uc_area_unit,
					 a.yr_name
					 FROM wh_002_users_canal a
					WHERE 1=1 ";
		if($this->isPropertySet("uc_id", "V"))
			$Sql .= " AND a.uc_id=" . $this->getProperty("uc_id");
		if($this->isPropertySet("nc_id", "V"))
			$Sql .= " AND a.nc_id=" . $this->getProperty("nc_id");
			
			

		if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			if($this->isPropertySet("u_id", "V"))
			$Sql .= " AND a.u_id =" . $this->getProperty("u_id")."";
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	public function getUserCanalIds()
	{
		$result=$this->dbQuery("SELECT uc_id from wh_002_users_canal");
	   	return $result;
	
	}
}
?>