<?php 

namespace App\models;
use App\core\Connect;
use \PDO;

class User extends Connect {
    
    protected $_pdo;
    
    public function __construct(){
        $this->_pdo = $this->connexion();
    }
    
    public function addUser($login,$password,$description,$age,$img){

    
        $password = password_hash($password, PASSWORD_DEFAULT); // je hash mon mot de passe 
    
        $sql = "INSERT INTO `user`( `login`, `password`,`description`,`age`,`img`) 
            VALUES (:login,:password,:description,:age,:img)";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':login' => $login,
            ':password' => $password,
            ':description'=>$description,
            ':age' => $age,
            ':img' => $img
        ]);
        
    }


    public function recupAllUser(){
        $sql = "SELECT `login`, `age`,`img`,`description` FROM user";
        $query = $this->_pdo->prepare($sql);
        $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC); 
    }

    public function recupUserByLogin($login){
    
    $sql = "SELECT `id`, `login`, `password` FROM `user` WHERE login = :login";
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