<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="montagne.ico"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/fontawesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/brands.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Projet Security</title>
</head>
<body>
<a name="haut"></a>
    <header>
        <div class="container flex-header">
            <div class="flex-logo">
                <a href="index.php?p=home"><span>Projet sécurité</span></a>
            </div>
            <div>
                <nav id="Nav">
                    <ul>
                        <li><a href="index.php?p=home">Accueil</a></li>
                        <?php if($session::online() === false) : ?> 
                        <li><a href="index.php?p=userConnect">Connexion</a></li>
                        <?php else : ?>
                        <li><a href="index.php?p=register">Ajouter un utilisateur</a></li>
                        <li><a href="index.php?p=logout">Déconnexion</a></li>
				        <?php endif; ?>
                    </ul>
                </nav>
                <div id="displayMenu" class="iconeMenu"></div>
            </div>
        </div>
    </header>

    <?php require 'views/'.$path ?>
    
    <footer>

    <div class="container">
            <div class="footer-flex">
                <div class="contact">
                    <strong>Contact</strong>
                    <ul>
                        <li><a href="index.php?p=contact">Contactez-moi</a></li>
                    </ul>
                </div>
            </div>


        </div>
        <a href="#haut" class="haut-page"><i class="fas fa-arrow-alt-circle-up"></i></a>


    </footer>
    

</body>
</html>