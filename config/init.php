<?php
session_start();
   
     $GLOBALS['config'] = array(
        'mysql' => array(
          'host' => 'localhost',
          'login'=> 'root',
          'password' => 'test',
          'db_name'  => 'twitter2'
        ),
        'session' => array(
            
        )
    );
     
     
spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});

    
    