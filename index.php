<?php 

use App\core\{Autoloader};
use App\controllers\FrontController;

// Looing for .env at the root directory
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


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