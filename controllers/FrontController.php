<?php 

namespace App\controllers; 

use App\controllers\FormController; 
use App\models\User; 
use App\core\{Connect,Session,Cookie}; 


class FrontController {
    
    
    public function home(){

        $this->render('home');
    }

    public function register(){
        // (Session::online()) ? Https::redirect('index.php') : '';
        Session::online(); 

        if($_POST):

            $form = new FormController(new User()); 
            $messages = $form->registerForm($_POST); 
        
        endif; 

        $recupUsers = new User(); 
        $users = $recupUsers->recupAllUser();
        // var_dump($users);  


        $this->render('registerUser', ['messages' => ($messages) ?? null,
                                        'users' => $users,
                                                                ]);
    }

    public function userConnect(){

        Session::online();

        if($_POST):

            $form   = new FormController(new User());
            $messages = $form->loginForm($_POST);

        
        endif;
        
        
        $this->render('userConnect', [ 'messages' => ($messages) ?? null,
                                           'cookie'  => new Cookie ]);
    }

     public function logout(){
        
        Session::deconnect();
        
        header('Location: index.php');
        exit;
    }

   

    // public function forgetPassword(){

    //     $form = new FormController(new User()); 
    //     $messages = $form->passwordForm($_POST);

    //     $this->render('forgetPassword', ['messages' => ($messages) ?? null]);
    // }

    public function espaceUser(){

        $this->render('espaceUser');
    }

    public function addUser(){

    }
    
    public function render(string $path,$array = []){

        if(count($array) > 0){
            foreach($array as $key => $value){
                ${$key} = $value; 
            }
        }

        $session = new Session; 
        // $https = new Https; 
        
        $path = $path.".php"; 
        require 'views/template.php';
    }


}