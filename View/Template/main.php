<?php 
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>
<body>
    <header>
        <div>
            <img src="" alt="logo Tom Troc">
            <h1>Tom Troc</h1>
        </div>
            <ul>
                <li><a href="index.php"><span>Accueil</span></a></li>
                <li><a href="index.php?page=books"><span>Nos livres à l'échange</span></a></li>
            </ul>
            <ul>
            <?php
            if($user){
                ?>
                    <li><a href="index.php?page=messages"><span class="message-icon count-icon">Messagerie</span></a></li>
                    <li><a href="index.php?page=account"><span>Mon compte</span></a></li>
                    <li><a href="index.php?page=logout"><span>Déconnexion</span></a></li>
                <?php
            }
            else{
                ?>
                <li><a href="index.php?page=loginPage">Connexion</a></li>
                <li><a href="index.php?page=signup">Inscription</a></li>
                <?php
            }
            ?>
            </ul>
        </div>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer>
        <a href="">Politique de confidentialité</a>
        <a href="">Mentions légales</a>
        <a href="">Tom Troc©</a>
        <img src="" alt="logo Tom Troc reverse">
    </footer>
</body>
</html>