<?php 

namespace App\core; 
use \PDO;


class Connect{
    
    protected $_host = 'localhost';
    protected $_dbName = 'security3wa' ;
    protected $_user = 'Marie' ;
    protected $_pass = 'SjzEteZO3BQx2oMJ';
    

    public function connexion(){
        
        $pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbName, $this->_user, $this->_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
        
    }

}