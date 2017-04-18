<?php
namespace HelperNamespace
{
    /* ========== PHP Helper ========== */
            /*
            - directories' & files' paths
            - utility functions'
            */
    class Helper
    {
        /* ---------- Variables ---------- */
        private     $root_path;
        private     $sleipnir_ini_path;
        protected   $sleipnir_settings = array();

        public      function __construct ()
        {
            // Get paths
            $this->$root_path = "/var/www/html";
            $this->$sleipnir_ini_path = $root_dir . "/include/config/sleipnir_settings.ini";

            // Parse the sleipnir_settings.ini into a protected array
            $sleipnir_settings[] = parse_ini_file($sleipnir_settings);
        }

        /* ---------- Methods ---------- */
        public      function    __destruct (){}
    }

    class User extends Helper
    {
        /* ---------- Variables ---------- */
        private     $email;
        private     $password;
        private     $level;

        /* ---------- Methods ---------- */
        public      function __construct ($def_email, $def_password, $def_level)
        {
            $email = $def_email;
            $password = $def_password;
            $level = $def_level;
            echo "User created with consulting rights (code only)";
        }

        public      function __destruct (){}
    }

    class Database extends Helper
    {
        /* ---------- Variables ---------- */
        private     $slq_host;
        private     $sql_login;
        private     $sql_password;

        /* ---------- Methods ---------- */
        public      function __construct ()
        {
            /// PARSER
            $this->$slq_host = "host";
            $this->$sql_login = "login";
            $this->$sql_password = "password";
            echo "Generic constructor used";
        }

        public      function __destruct (){}
        
        protected   function    getSQLHost()
        {
            return $slq_host;
        }

        protected   function    setSQLHost($new_sql_host)
        {
            $sql_host = $new_sql_host;
        }

        //$test[] = parse_ini_file($file);
    }
}
?>