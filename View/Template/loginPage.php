<?php

$cible = Tools::request('cible', null);
$fail = Tools::request('fail', false);
?>

<section class="login-container">
    <form action="index.php?page=login<?= $cible ? '&cible='.$cible:'' ?>" method="post">
       <h2>Connexion</h2>
       <?php
        if($fail){
            ?>
            <p class="warning">Identifiants invalides.</p>
            <?php
        }
        ?>
        <div class="input-container">
            <label for="email">Adresse email</label>
            <input  type="text" name="email" id="email">
        </div>
        <div class="input-container">
            <label for="pw">Mot de passe</label>
            <input type="password" name="pw" id="pw">
        </div>
        <input class="button-green" type="submit" value="Se connecter">
        <p>Pas de compte ? <a href="index.php?page=signup<?= $cible ? '&cible='.$cible:'' ?>">Inscrivez-vous</a></p>
    </form>
    <img src="./Asset/img/illu1.png" alt="">
</section>
