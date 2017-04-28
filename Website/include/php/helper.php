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
        parent::__construct();
		$this->_sql_host = $this->_sleipnir_settings[0]['sleipnir_sql_host'];
        $this->_sql_user = $this->_sleipnir_settings[0]['sleipnir_sql_user'];
        $this->_sql_password = $this->_sleipnir_settings[0]['sleipnir_sql_password'];
        
        if ($db_type == "user")
        {
	        $this->_sql_db = $this->_sleipnir_settings[0]['sleipnir_sql_users_db'];
	        $this->_sql_table = $this->_sleipnir_settings[0]['sleipnir_sql_users_table'];
		}
		elseif ($db_type == "equip")
		{
	        $this->_sql_db = $this->_sleipnir_settings[0]['sleipnir_sql_equipment_db'];
	        $this->_sql_table = $this->_sleipnir_settings[0]['sleipnir_sql_equipment_table'];
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

/* ========== Unicode-proof htmlentities ========== */
/* ---------- Returns 'normal' chars as chars and weirdos as numeric html entites ---------- */
function	superHtmlEntities($str)
{
	$str2 = NULL;
    // Get rid of existing entities, and else double-escape
    $str = html_entity_decode(stripslashes($str), ENT_QUOTES, 'UTF-8'); 
    $ar = preg_split('/(?<!^)(?!$)/u', $str);  // return array of every multi-byte character
    foreach ($ar as $c){
        $o = ord($c);
        if ((strlen($c) > 1) || /* multi-byte [unicode] */
            ($o <32 || $o > 126) || /* <- control / latin weirdos -> */
            ($o >33 && $o < 40) || /* quotes + ambersand */
            ($o >59 && $o < 63)) /* html */
        {
            // convert to numeric entity
            $c = mb_encode_numericentity($c, array(0x0, 0xffff, 0, 0xffff), 'UTF-8');
        }
        $str2 .= $c;
    }
    return $str2;
}

function	getOptionsFromArray($array)
{
	$i = 0;
	$options = "";
	
	while (isset($array[$i]))
	{
		$options .= "<option value='". $array[$i] ."'>". $array[$i] ."</option>";
		$i++;
	}
	return $options;
}










?>