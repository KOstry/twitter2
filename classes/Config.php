<?php
require_once __DIR__.('/../config/init.php');
class Config{
    
    public static function get($path){
        
        $pathArray = explode('/', $path);
        $configArray = $GLOBALS['config'];
        
        
        foreach($pathArray as $path){
         $configArray = $configArray[$path];
        }
        return $configArray;
    }     
        
}
    
