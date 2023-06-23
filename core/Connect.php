<?php 

namespace App\core; 
use \PDO;


class Connect{
    
    protected $_host = 'localhost';
    protected $_dbName = 'secu' ;
    protected $_user = 'root' ;
    protected $_pass = '';
    

    public function connexion(){
        
        $pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbName, $this->_user, $this->_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
        
    }

}