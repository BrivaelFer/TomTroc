<?php

$cible = Tools::request('cible', null);
$fail = Tools::request('fail', false);
?>

<form action="index.php?page=login<?= $cible ? '&cible='.$cible:'' ?>" method="post">
    <?php
    if($fail){
        ?>
        <p class="warning">Identifians invalide.</p>
        <?php
    }
    ?>
    <label for="email">Adresse email</label>
    <input type="text" name="email" id="email">
    <label for="pw">Mot de passe</label>
    <input type="password" name="pw" id="pw">
    <input type="submit" value="Se connecter">

</form>
<img src="" alt="">