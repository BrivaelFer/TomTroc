<section class="section-conn-sign">
    <div class="form-container">
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
                <label for="pw">Mot de passe</label>
                <input type="password" name="password" id="pw" required>
            </div>
            <input class="button-green button-full" type="submit" value="S'inscrire">
            <p>Déjà inscrire ? <a href="index.php?page=loginPage">Connectez-vous</a></p>
        </form>
        <div>
            <img src="./Asset/img/illu1.png" alt="">
        </div>
    </div>
</section>
