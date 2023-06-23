<?php 

namespace App\model;
use App\core\Connect;
use \PDO;

class User extends Connect {
    
    protected $_pdo;
    
    public function __construct(){
        $this->_pdo = $this->connexion();
    }
    
    public function addUser($login,$password,$mail){

    
    $password = password_hash($password, PASSWORD_DEFAULT); // je hash mon mot de passe 
    
    $sql = "INSERT INTO `user`( `login`, `password`, `mail`) 
            VALUES (:login,:password,:email)";
    $query = $this->_pdo->prepare($sql);
    $query->execute([
            ':login' => $login,
            ':password' => $password,
            ':email' => $mail
    ]);
        
    }

    public function recupUserByLogin($login){
    
    $sql = "SELECT `id`, `login`, `password`, `mail`, `creation_date` FROM `user` WHERE login = :login";
    $query = $this->_pdo->prepare($sql);
    $query->execute([
            ':login' => $login,
        ]);
    return $query->fetch(\PDO::FETCH_ASSOC); 
    
    }

    public function updatePassword($login,$hashedPassword){
        
        $sql = "UPDATE user SET password = :password WHERE login = :login"; 
        $query = $this->_pdo->prepare($sql); 
        $query->execute([
                ':login' => $login,
                ':password'=> $hashedPassword,
        ]);

    }

}