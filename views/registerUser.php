<main class="register">

    <section class="container">
        <h1>Ajouter un utilisateur</h1>
            <?php if(empty($messages['success'])) : ?>
            <div>
                <?php  if(!empty($messages['errors'])){  ?>
                    <ul>
                <?php foreach($messages['errors'] as $error):  ?>    
                    <li class="msg-error"><?=  $error ?></li>
                <?php endforeach ?>    
                </ul>
                <?php    }  ?>
                <form action="index.php?p=register" method="POST" class="form-register" enctype="multipart/form-data">
                    <div>
                        <input type="text" class="form-control" id="login" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                    </div>
                    <div>
                        <input type="int" class="form-control" id="age" name="age" placeholder="Age">
                    </div>
                    <div>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Une breve description">
                    </div>
                    <div>
                        <label for="image">Photo de profil:</label>
                        <input type="file" class="form-control" id="img" name="img" placeholder="Photo de profil">
                    </div>
                    <div>
                        <button type="submit" id="form-submit" class="submit">S'inscrire</button>
                    </div>
                </form>
                <?php else : ?>
                    <p class="msg-success"><?= $messages['success'][0] ?></p>  
                    <a href="index.php?p=userConnect">Se connecter</a>
                <?php endif; ?>
        </div>

    </section>
    <section>
    <?php foreach ($users as $user) :  ?>
        <?php if(isset($user)): ?>
            <div>
                <p>Pseudo : <?= htmlspecialchars($user['login']) ?></p>
                <p>Age : <?= htmlspecialchars($user['age']) ?></p>
                <img src="./assets/uploads/<?= htmlspecialchars($user['img'])?>"/>
                <hr>
            </div>
        <?php endif; ?>
    <?php endforeach; ?> 
    </section>

</main>