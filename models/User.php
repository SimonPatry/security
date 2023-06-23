<?php 

namespace App\models;
use App\core\Connect;
use App\core\Cookie;
use \PDO;

class User extends Connect {
    
    protected $_pdo;
    
    public function __construct(){
        $this->_pdo = $this->connexion();
    }
    
    public function addUser($login,$password,$description,$age,$img, $role, $jwt){


        $cok = new Cookie(new User());
        $res = $cok->checkCookie($jwt);

        $password = password_hash($password, PASSWORD_DEFAULT); // je hash mon mot de passe 
    
        $sql = "INSERT INTO `user`( `login`, `password`,`description`,`age`,`img`, `role`) 
            VALUES (:login,:password,:description,:age,:img)";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':login' => $login,
            ':password' => $password,
            ':description'=>$description,
            ':age' => $age,
            ':img' => $img,
            ':role' => $role
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