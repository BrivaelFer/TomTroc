<section class="form-container">
    <form action="index.php?page=createAccount" method="post">
        <h2>Inscription</h2>
        <div class="input-container">
            <label for="name">Pseudo</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-container">
            <label for="email">Adresse email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="input-container">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="pw" required>
        </div>
        <input class="button-green" type="submit" value="S'inscrire">
        <p>Déjà inscrire ? <a href="index.php?page=loginPage<?= $cible ? '&cible='.$cible:'' ?>">Connectez-vous</a></p>
    </form>
    <img src="./Asset/img/illu1.png" alt="">
</section>
