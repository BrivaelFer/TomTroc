<?php 
$user = $_SESSION['user'] ?? null;
if ($user) $user = unserialize($user);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href='https://fonts.googleapis.com/css?family=Playfair Display' rel='stylesheet'>
    <link rel="stylesheet" href="./Asset/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="background-2">
    <header class="background-1">
        <nav>
            <div class="main-logo">
                <img src="./Asset/img/logoTomTroc.png" alt="logo Tom Troc">
            </div>
            <div class="menu-icon hidden-desk">
                <img src="Asset/img/icon_menu.svg" alt="menu">
            </div>
            <div class="main-menus hidden-mob">
                <div class="princ-menu">
                    <div><a href="index.php"><span>Accueil</span></a></div>
                    <div><a href="index.php?page=books"><span>Nos livres à l'échange</span></a></div>
                </div>
                <div class="account-menu">
                <?php
                if($user){
                    ?>
                        <div><a class="message-link" href="index.php?page=message"><span><i class="message-icon"></i>Messagerie</span></a></div>
                        <div><a class="account-link" href="index.php?page=account"><span><i class="account-icon"></i>Mon compte</span></a></div>
                        <div><a href="index.php?page=logout"><span>Déconnexion</span></a></div>
                    <?php
                }
                else{
                    ?>
                    <div><a href="index.php?page=loginPage">Connexion</a></div>
                    <div><a href="index.php?page=signup">Inscription</a></div>
                    <?php
                }
                ?>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer class="main-footer background-3">
        <a href="">Politique de confidentialité</a>
        <a href="">Mentions légales</a>
        <a href="">Tom Troc©</a>
        <img class="logo-footer" src="./Asset/img/logoTomTrocRev.png" alt="logo Tom Troc reverse">
    </footer>
</body>
<script src="Asset/js/account.js"></script>
</html>