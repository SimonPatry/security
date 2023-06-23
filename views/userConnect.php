<!DOCTYPE html>
<html>
<head>
    <title>Admin game</title>
</head>
<body>
    <main class="login">

        <section class="container">
            <h1>Se connecter</h1>

            <?php if(empty($messages['success'])) : ?>
            <?php  if(!empty($messages['errors'])){  ?>
                <ul>
                <?php foreach($messages['errors'] as $error):  ?>
                    <li class="msg-error"><?=  $error ?></li>
                <?php endforeach ?>
                </ul>
            <?php    }  ?>

            <form action="index.php?p=userConnect" method="POST" class="form-register">
                <div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Votre utilisateurs">
                </div>
                <div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                </div>
                <div>
                    <button type="submit" id="form-submit" class="submit">Connexion</button>
                </div>
            </form>
            <?php else : ?> 
                        <img src=".assets/img/connexion.jpg" alt="connect">
                        <p><?= $message ?></p>
                        <a href="index.php">retourner a l'accueil</a>
                        <a href="index.php?p=logout">Se déconnecter</a> 
            <?php endif; ?>

        </section>

    </main>
</body>
</html>
