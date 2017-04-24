<?php
    /* ========== PHP Helper ========== */
            /*
            - directories' & files' paths
            - utility functions'
            */
            
class S_Helper
{
    /* ---------- Variables ---------- */
    protected		$_root_path = "";
    protected		$_sleipnir_ini_path = "";
    protected		$_sleipnir_settings = array();

    /* ---------- Methods ---------- */
    public      	function __construct()
    {
        // Get paths
        $this->_root_path = "/var/www/html";
        $this->_sleipnir_ini_path = $this->_root_path . "/include/config/sleipnir_settings.ini";

        // Parse the sleipnir_settings.ini into a protected array
        $this->_sleipnir_settings[] = parse_ini_file($this->_sleipnir_ini_path);
    }

    public      	function    __destruct(){}
}

class S_User extends S_Helper
{
    /* ---------- Variables ---------- */
    private     	$_email;
    private     	$_password;
    private     	$_level;

    /* ---------- Methods ---------- */
    public      	function	__construct($email, $password, $level)
    {
    	parent::__construct();
        $this->_email = $email;
        $this->_password = $password;
        $this->_level = $level;
    }

    public      	function 	__destruct(){}
}

class S_Database extends S_Helper
{
    /* ---------- Variables ---------- */
    private			$_sql_host;
    private     	$_sql_user;
    private     	$_sql_password;
    private			$_sql_db;
    private			$_sql_table;

    /* ---------- Methods ---------- */
    public			function	__construct($db_type)
    {
        /// PARSER
        parent::__construct();
		$this->_sql_host = $this->_sleipnir_settings[0]['sleipnir_sql_host'];
        $this->_sql_user = $this->_sleipnir_settings[0]['sleipnir_sql_user'];
        $this->_sql_password = $this->_sleipnir_settings[0]['sleipnir_sql_password'];
        
        if ($db_type == "user")
        {
	        $this->_sql_db = $this->_sleipnir_settings[0]['sleipnir_sql_users_db'];
	        $this->_sql_table = $this->_sleipnir_settings[0]['sleipnir_sql_users_table'];
		}
		elseif ($db_type == "equipment")
		{
	        $this->_sql_db = $this->_sleipnir_settings[0]['sleipnir_equipments'];
	        $this->_sql_table = $this->_sleipnir_settings[0]['Equipment'];
		}
    }

    public      	function	__destruct(){}
    
    public   		function    get_sql_host()
    {
        return $this->_sql_host;
    }
    
    public   		function    get_sql_user()
    {
        return $this->_sql_user;
    }
    public   		function    get_sql_password()
    {
        return $this->_sql_password;
    }
    public   		function    get_sql_db()
    {
        return $this->_sql_db;
    }
    public   		function    get_sql_table()
    {
        return $this->_sql_table;
    }
}
?>