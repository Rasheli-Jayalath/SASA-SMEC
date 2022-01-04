<?php
	ob_start();
	session_cache_expire(30);
	define('PNAME',"SAS");
	//session_name(PNAME);
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	$dbCfg = array();
	include_once(dirname(__FILE__) . '/global_config.php');
	
	// database configuration
	if($_SERVER['HTTP_HOST'] == "localhost")
	{
		$dbCfg['host']			= "localhost";
		$dbCfg['db_user']		= "root";
		$dbCfg['db_passwd']		= "";
		$dbCfg['db_name']		= "sas20210601";
	}
	
		/*********** Define the values *********/
		
		/**
	 * doDefine()
	 *
	 * @param mixed $configs
	 * @return
	 */
	function doDefine($configs){
		$str = "";
		if($configs){
			foreach($configs as $key=>$value){
				$str .= "define(\"" . strtoupper($key) . "\",\"" . $value . "\");\n";
			}
		}
		return $str;
	}
		
		/*********** Define the values *********/
	$defines = doDefine($_CONFIG);
	echo eval($defines);


  /**
	 * __autoload()
	 *
	 * @param string $class_name
	 * @return
	 */
	 /*spl_autoload_register($class_name){
		// class directories
		$dirs = array('classes/','classes/core/')
		
		// for each directory
		foreach($dirs as $dir){
			// see if the file exsists
						if(file_exists(SITE_PATH . $dir . $class_name . '.php')){
				require_once(SITE_PATH . $dir . $class_name . '.php');
				// only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
			}
		}
	} */
	require_once(SITE_PATH . 'classes/core/'. 'Property'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Database'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'CanalNetworks'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'CanalXWater'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'CommandArea'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Crops'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Paginate'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Paging'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Reports'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'SumJoin'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Timescale'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Users'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'CanalUsers'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'UsersCrops'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Validate'. '.php');
	require_once(SITE_PATH . 'classes/core/'. 'Login'. '.php');
	
	/*********** Define the values *********/
	define("HOST", $dbCfg['host']);
	define("DBUSER", $dbCfg['db_user']);
	define("DBPASSWD", $dbCfg['db_passwd']);
	define("DBNAME", $dbCfg['db_name']);
	define("SITE_URL", 'ROOT_HOST');

	$host=HOST;
	$dbnmame=DBNAME;
	$con = new PDO("mysql:host=$host;dbname=$dbnmame;charset=UTF8", DBUSER, DBPASSWD);


	$_SESSION["dbConnection"] = $con;

	//$_SESSION["username"] ;

	
?>