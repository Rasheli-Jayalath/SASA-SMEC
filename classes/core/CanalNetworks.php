<?php
/**
*
* This is a class Canal Networks
*
**/
class CanalNetworks extends Database {
	
	protected $nc_id;
	protected $nc_name;
	protected $nc_code;
	protected $nc_type;
	
	/**
	* This is the constructor of the class Canal Networks
	*/
	public function __construct(){
		parent::__construct();
	}



public function getCannalNetwork()
	{
		$Sql = "SELECT 
		a.nc_id, 
		a.ca_id, 
		a.nc_code, 
		a.nc_name, 
		a.nc_type, 
		a.nc_length, 
		a.nc_length_unit, 
		a.nc_volume, 
		a.nc_volume_unit, 
		a.nc_flow_capacity, 
		a.nc_flow_unit, 
		a.nc_command_area, 
		a.nc_command_area_unit, 
		a.nc_conveyance_coeff,
		a.yr_name
		FROM wh_000_network_canals a
				WHERE 
					1=1";
		if($this->isPropertySet("nc_id", "V"))
			$Sql .= " AND a.nc_id=" . $this->getProperty("nc_id");
			
			if($this->isPropertySet("ca_id", "V"))
			$Sql .= " AND a.ca_id=" . $this->getProperty("ca_id");

			$Sql .= " AND a.ca_id=3";
			
			if($this->isPropertySet("nc_code", "V"))
			$Sql .= " AND a.nc_code LIKE '%" . $this->getProperty("nc_code")."%'";

			//$Sql .= " AND a.nc_code LIKE '%NC0101%'";
			
			if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			
			$Sql .= " ORDER BY nc_code,nc_type ASC";
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		// print_r('<pre>');
		// print_r( $Sql);
		return $this->dbQuery($Sql);
		
	}
	
	public function CheckQuaternary()
	{
		$Sql = "SELECT 
		count(*) as total_canals from wh_000_network_canals a
				WHERE 
					1=1";
		
			if($this->isPropertySet("nc_code", "V"))
			$Sql .= " AND a.nc_code LIKE '%" . $this->getProperty("nc_code")."%'";
			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);
		
	}
	
	
}
?>