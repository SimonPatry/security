<?php 

namespace App\controllers;

use App\models\User;
use App\core\{ Session, Connect, Cookie };

class FormController {
     
    protected $_user;
    
    public function __construct(User $user){
        $this->_user = $user;
    }
    
    public function registerForm(array $data){
        $messages = [];
        
        // Vérification des champs obligatoires
        if(empty($data['login']) || empty($data['password']) || empty($_FILES["img"]) || empty($data['description']) || empty($data['age'])){
            $messages['errors'][] = "Veuillez remplir tous les champs.";
        }
        
        // Vérification de la longueur du login
        if(strlen($data['login']) < 4){
            $messages['errors'][] = "Le login est trop court (minimum 4 caractères).";
        }

        // Vérification du mot de passe
        if(strlen($data['password']) < 8){
            $messages['errors'][] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        
        if(!preg_match('/[A-Z]/', $data['password']) || !preg_match('/[a-z]/', $data['password']) || !preg_match('/[0-9]/', $data['password'])){
            $messages['errors'][] = "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.";
        }
    
        // Contrôle de l'image
        if(isset($_FILES['img'])){
            $uploadedFile = $_FILES['img']['tmp_name'];
            $fileExtension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
            $fileType = mime_content_type($uploadedFile);
    
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
    
            if (in_array($fileExtension, $allowedExtensions) && in_array($fileType, $allowedMimeTypes)) {
                $maxFileSize = 20 * 100 * 100; // 2MB
    
                if ($_FILES['img']['size'] <= $maxFileSize) {
                    $destinationPath = './assets/uploads/'; 
                    $newFileName = uniqid('', true) . '.' . $fileExtension;
                    $destinationFile = $destinationPath . $newFileName;
    
                    move_uploaded_file($uploadedFile, $destinationFile);
    
                    chmod($destinationFile, 0644);
    
                    $successMessage = "Le fichier a été téléchargé avec succès.";
                } else {
                    $messages['errors'][] = "Le fichier dépasse la taille maximale autorisée.";
                }
            } else {
                $messages['errors'][] = "Le type de fichier n'est pas autorisé.";
            }
        } else {
            $messages['errors'][] = "Aucun fichier n'a été téléchargé.";
        }
        
        // Vérification de l'âge et de la description
        // ...

        $exist = $this->_user->recupUserByLogin($data['login']);
    
        if($exist){
            $messages['errors'][] = "Ce login existe déjà, veuillez en choisir un autre.";
        }

        if(empty($messages['errors'])){
            $this->_user->addUser($data['login'], $data['password'], $data['description'], $data['age'], $newFileName);
            $messages['success'] = ['Inscription réussie !'];
        }
        
        return $messages;
    }

    public function loginForm(array $data){
        $messages = [];
        
        // Vérification des champs obligatoires
        if(empty($data['password']) || empty($data['login'])){
            $messages['errors'][] = "Veuillez remplir tous les champs.";
        } else { 
            $exist = $this->_user->recupUserByLogin($data['login']);
            
            if(!$exist){
                $messages['errors'][] = "Le login n'existe pas.";
            } else if (password_verify($data['password'], $exist['password'])) {  
                Session::setUserSession($exist);

                if(isset($data['remember'])){
                    Cookie::setCookies($data);
                } else {
                    Cookie::deleteCookie($data);
                }
            } else {
                $messages['errors'][] = "Le mot de passe est invalide.";
            }
        }
        
        return $messages;
    }
}