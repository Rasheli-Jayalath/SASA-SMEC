<?php
/**
*
* This is a class Reports
*
**/
class Reports extends DataBase{
	
	protected $rps_id;
	protected $report_title;
	protected $report_start_id;
	protected $report_end_id;
	
	/**
	* This is the constructor of the class Reports
	*/
	public function __construct(){
		parent::__construct();
	}

	
	public function getReports()
	{
		
		$Sql = "SELECT 
		a.rps_id, 
		a.report_title, 
		a.report_start_id, 
		a.report_end_id
		FROM wh_003_report_scale a
				WHERE 
					1=1";
		if($this->isPropertySet("rps_id", "V"))
			$Sql .= " AND a.rps_id=" . $this->getProperty("rps_id");
			
			if($this->isPropertySet("report_title", "V"))
			$Sql .= " AND a.report_title LIKE '%" . $this->getProperty("report_title")."%' ";
			
			$Sql .= " ORDER BY rps_id ASC";
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
		
	}
	
}
?>