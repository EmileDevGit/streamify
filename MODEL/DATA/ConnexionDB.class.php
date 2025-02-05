<?php
include_once("config/DBconf.interface.php");

    class ConnexionDB{
 
        private static $instance = null;

        private function __construct(){
        }

        public static function getInstance(){

            $config="mysql:host=".DBconf::DB_HOST.";dbname=".DBconf::DB_NAME;
            $user=DBconf::DB_USERNAME;
            $passwd=DBconf::DB_PASSWORD;

            if (self::$instance == null){
                self::$instance = new PDO($config, $user, $passwd);
				self::$instance->exec("SET character_set_results = 'utf8'");	
				self::$instance->exec("SET character_set_client = 'utf8'");	
				self::$instance->exec("SET character_set_connection = 'utf8'");	
            }
            return self::$instance;
        }

        public static function close(){
            self::$instance=null;
        }
        
    }




?>