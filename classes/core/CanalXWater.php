<?php
/**
*
* This is a class is user for Canal-Wise Water Distribution Plan report
*
**/
class CanalXWater extends DataBase{
	
	/**
	* This is the constructor of the class Crop
	*/
	public function __construct(){
		parent::__construct();
	}

	public function getCanalWiseWater()
	{
		$Sql = "SELECT x.nc_name, x.nc_code, x.nc_type, x.factor, SUM(x.total) AS water, SUM(x.flow) AS flow 
        FROM (
            SELECT
            nc.nc_name, nc.nc_code, nc.nc_type, nc.nc_conveyance_coeff AS factor,
            uc.cr_id, SUM(uc.ucp_area) AS ucp_sum,
            cp.sch_wat,
            SUM(uc.ucp_area) * cp.sch_wat AS total,
            tm.ts_days,
            (SUM(uc.ucp_area) * cp.sch_wat) * 1000 / (24*tm.ts_days*3600*nc.nc_conveyance_coeff) AS flow
            FROM wh_002_users_crops AS uc
            INNER JOIN wh_002_users_canal AS ca ON ca.uc_id = uc.uc_id
            RIGHT JOIN wh_000_network_canals AS nc ON nc.nc_id = ca.nc_id
            LEFT JOIN wh_001_crop_per_main AS cp ON cp.cr_id = uc.cr_id AND cp.ts_id =". $this->getProperty("ts_id").
            " LEFT JOIN wh_001_tscale_main AS tm ON tm.ts_id = cp.ts_id
            WHERE 1=1 ";

        if($this->isPropertySet("ca_id", "V"))
        $Sql .= " AND nc.ca_id=" . $this->getProperty("ca_id");
        
        if($this->isPropertySet("nc_code", "V"))
        $Sql .= " AND nc.nc_code LIKE '%" . $this->getProperty("nc_code")."%'";
        
        // if($this->isPropertySet("ts_id", "V"))
        // $Sql .= " AND cp.ts_id=" . $this->getProperty("ts_id");

        $Sql .= " GROUP BY nc.nc_name, uc.cr_id
                    ORDER BY nc.nc_code, uc.cr_id ASC
                        ) as x 
                        GROUP BY x.nc_name
                        ORDER BY x.nc_code ";

	   	return $this->dbQuery($Sql);
	}
}
?>