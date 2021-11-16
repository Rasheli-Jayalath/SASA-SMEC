<?php
/**
*
* This is a class Command Area
*
**/
class CommandArea extends DataBase{
	
	protected $ca_id;
	protected $ca_name;
	protected $ca_area;
	protected $ca_unit;
	protected $yr_name;
	
	/**
	* This is the constructor of the class Command Area
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getCommandArea()
	{
		$Sql = "SELECT 
		a.ca_id, 
		a.ca_name, 
		a.ca_area,
		a.ca_unit,
		a.yr_name
		 
		FROM wh_000_command_area a
				WHERE 
					1=1";
		
			if($this->isPropertySet("ca_id", "V"))
			$Sql .= " AND a.ca_id=" . $this->getProperty("ca_id");
			
			$Sql .= " ORDER BY ca_id ASC";
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			return $this->dbQuery($Sql);
	}
	public function getCommandAreaIds()
	{
		 $Sql = "SELECT a.ca_id FROM wh_000_command_area a
				WHERE 
					1=1";
		
			if($this->isPropertySet("ca_id", "V"))
			$Sql .= " AND a.ca_id=" . $this->getProperty("ca_id");
			return $this->dbQuery($Sql);
			
	
	}
}
?>