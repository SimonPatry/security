<?php 
use App\core\{Autoloader};
use App\controller\FrontController;


session_start(); 

require_once './core/Autoloader.php'; 

Autoloader::register();

$routeur = new FrontController(); 

if(isset($_GET['p'])):
    $method = $_GET['p']; 

    (method_exists(FrontController::class, $method)) ? $routeur->$method() : $routeur->index(); 

else: 
    header('Location: index.php?p=home'); 
    exit; 

endif;