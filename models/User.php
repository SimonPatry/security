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

    public function recupUserByMail($mail){
    
    $sql = "SELECT `id`, `login`, `password`, `mail`, `creation_date` FROM `user` WHERE mail = :mail";
    $query = $this->_pdo->prepare($sql);
    $query->execute([
            ':mail' => $mail,
        ]);
    return $query->fetch(\PDO::FETCH_ASSOC); 
    
    }

    public function updatePassword($mail,$hashedPassword){
        
        $sql = "UPDATE user SET password = :password WHERE mail = :mail"; 
        $query = $this->_pdo->prepare($sql); 
        $query->execute([
                ':mail' => $mail,
                ':password'=> $hashedPassword,
        ]);

    }
    
    public function recupNumberTextsByUser($id){

        $sql = "SELECT user.id, COUNT(texts.id) AS number_text
                FROM user
                INNER JOIN texts
                ON user.id = texts.id_user
                WHERE user.id = :id
                GROUP BY user.id";

        $query = $this->_pdo->prepare($sql);
        $query->execute([
                ':id' => $id,
        ]); 
        return $query->fetch(\PDO::FETCH_ASSOC); 
    }


}