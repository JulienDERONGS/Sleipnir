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
    private     	$_sql_login;
    private     	$_sql_password;

    /* ---------- Methods ---------- */
    public			function	__construct()
    {
        /// PARSER
        parent::__construct();
        
        $this->_sql_host = "host";
        $this->_sql_login = "login";
        $this->_sql_password = "password";
    }

    public      	function	__destruct(){}
    
    public   		function    get_sql_host()
    {
        return $this->_sql_host;
    }

    public   		function    set_sql_host($new_sql_host)
    {
        $this->_sql_host = $new_sql_host;
    }
}
?>