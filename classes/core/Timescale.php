<?php
/**
*
* This is a class Timescale
*
**/
class Timescale extends DataBase{
	
	protected $ts_id;
	protected $ts_period;
	protected $ts_days;
	protected $ts_month;
	protected $yr_name;

	
	/**
	* This is the constructor of the class TimeScale
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getTimescale()
	{
		
		$Sql = "SELECT 
		a.ts_id, 
		a.ts_period, 
		a.ts_days, 
		a.ts_month, 
		a.yr_name
		
		FROM wh_001_tscale_main a
				WHERE 
					1=1";
		if($this->isPropertySet("ts_id", "V"))
			$Sql .= " AND a.ts_id=" . $this->getProperty("ts_id");
			if($this->isPropertySet("ts_month", "V"))
			$Sql .= " AND a.ts_month=" . $this->getProperty("ts_month");
			if($this->isPropertySet("start", "V"))
			$Sql .= " AND a.ts_id>=" . $this->getProperty("start");
			if($this->isPropertySet("end", "V"))
			$Sql .= " AND a.ts_id<=" . $this->getProperty("end");
			if($this->isPropertySet("yr_name", "V"))
			$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
			$Sql .= " ORDER BY ts_id ASC";
			
			
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			// print_r('<pre>');
			// print_r( $Sql);
		return $this->dbQuery($Sql);

	}
	
	public function TimeScale()
	{
		$result=$this->dbQuery("SELECT ts_id from wh_001_tscale_main");
	   	return $result;
	
	}
	
	public function getYears()
	{
		
		$Sql = "SELECT 
		a.yr_id, 
		a.yr_name
		FROM tbl001_year_main a
				WHERE 
					1=1";
		if($this->isPropertySet("yr_id", "V"))
		$Sql .= " AND a.yr_id=" . $this->getProperty("yr_id");
		if($this->isPropertySet("yr_name", "V"))
		$Sql .= " AND a.yr_name=" . $this->getProperty("yr_name");
		$Sql .= " ORDER BY yr_id ASC";
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
	
			
		return $this->dbQuery($Sql);

	}
}
?>