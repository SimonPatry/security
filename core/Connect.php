<?php

namespace App\core; 
use \PDO;


class Connect{
    
    protected $_host = 'localhost';
    protected $_dbName = 'secu' ;
    protected $_user = 'root' ;
    protected $_pass = 'R!8q5rSRVe]XmC3';
    

    public function connexion(){
        try{
        $pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbName, $this->_user, $this->_pass);
        } catch (\PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            exit();
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
        
}

}