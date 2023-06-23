<?php 

namespace App\core;
use App\models\User;

require_once 'vendor/autoload.php'; 
use Firebase\JWT\JWT;

class Cookie{

    protected $_user;

    public function __construct(User $user)
    {

        $this->_user = $user;
    }

    public static function deleteCookie() :void{
        unset($_COOKIE['token']);
    }
    

    public static function setCookies(string $jwt) :void{
        setcookie( "token", $jwt, time()+365*24*3600);
    }
        

    public function checkCookie(string $cookie){
        $jwt_key = $_ENV['SECRET_KEY'];
        
        $data = JWT::decode($cookie, $jwt_key);

        $exist = $this->_user->recupUserByLogin($data->login);
        if (!$exist) {
            return false;
        } else {
            return true;
        }
        
    }
    
}