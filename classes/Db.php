<?php

class Db {
    
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;
    
    
  
    
    
    private function __construct() {
        $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='. Config::get('mysql/db_name'), Config::get('mysql/login'), Config::get('mysql/password') );
    }
    
    function get_pdo() {
        return $this->_pdo;
    }

        
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new Db();
        }
        return self::$_instance;
    }
}
