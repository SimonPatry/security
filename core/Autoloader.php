<?php 

namespace App\core;


class Autoloader {
    
    static function register(){
    
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }
    
    static function autoload($namespace){
 
        
        $class = str_replace("\\", "/", $namespace);

        
        $class = str_replace("App", ".", $class);
        
        require_once $class.'.php';
        
        
    }

}