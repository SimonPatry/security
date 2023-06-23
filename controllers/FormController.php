<?php 

namespace App\controller;

use App\model\User;
use App\core\{ Session, Connect,Cookie };
use App\classes\Litophanie; 

class FormController {
    
     
    protected $_user;
    
    public function __construct(User $user){
        
        $this->_user = $user;
       

    }
    
    public function registerForm(array $data){

        $messages = [];
        
        // verif 1
        if(empty($data['login']) || empty($data['password'])|| empty($data['password2']) || empty($data['mail']))
            $messages['errors'][] = "veuillez remplir tous les champs";

        // verif 2
        if(!strlen($data['login']) >= 4)
            $messages['errors'][] = "login trop court ";
    
            // verif 3
        if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) 
            $messages['errors'][] = "L'adresse email est incorrecte ";
    
        // verif 4
        if ($data['password'] !== $data['password2']) 
            $messages['errors'][] = "Les mots de passe doivent être les memes";

        $exist = $this->_user->recupUserByMail($data['mail']);
    
        if($exist)
            $messages['errors'][] = "L'email correspond à un compte déja existant";

        if(empty($messages['errors'])){
            
            $this->_user->addUser($data['login'],$data['password'],$data['mail']);
            $messages['success'] = [' Inscription réussie !'];
            
        }
        
        return $messages;
    }

    public function loginForm(array $data){
        
        // verif 1
        if(empty($data['password']) || empty($data['mail'])){
            
            return ['errors' => ["veuillez remplir tous les champs"]] ;

        }
        else{ 
            
            $exist = $this->_user->recupUserByMail($data['mail']);
            
            if(!$exist){
                
                return ['errors' => ["L'email n'existe pas"]];
                
            }else if (password_verify($data['password'], $exist['password'])) {  
                
                    Session::setUserSession($exist);

               

                (isset($data['remember'])) ? Cookie::setCookies($data) : Cookie::deleteCookie($data);

            
            } else {
                
                return ['errors' => ['Le mot de passe est invalide.']];
            }

            
        }
        
        header('location: index.php');
        exit;
            
    }

    public function passwordForm(array $data){

        $messages = [];

        if(isset($_POST['mail'])){

            $exist = $this->_user->recupUserByMail($data['mail']);
            
            if(!$exist){
                
                return ['errors' => ["L'email n'existe pas"]];
                
            } else {

            $password = uniqid();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $message = "Bonjour, suite à votre demande, voici votre nouveau mot de passe : $password.  Pensez à le modifier dans votre espace.";
            $headers = 'Content-Type: text/plain; charset="utf-8"'." ";

                if(mail($_POST['mail'], 'Mot de passe oublié', $message, $headers)){
                    $this->_user->updatePassword(
                                                $_POST['mail'],
                                                $hashedPassword );

                    $messages['success'] = ['Mail envoyé ']; 
                } else {
                    return ['errors' => ["Une erreur s'est produite. Si cela se réitère, contactez-moi."]];
                }


            }
        }
         return $messages;
    }
}