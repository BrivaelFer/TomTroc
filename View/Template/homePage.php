<section class="background-1" id="intro-home">
    <div class="home-text">
        <h2>Rejoignez nos lecteurs passionnés </h2>
        <p >Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
        <a class="button-green full-mob button-size-1" href="">Découvrir</a>
    </div>
    <div class="intro-img">
        <img src="Asset/img/illu_intro.jpg" alt="">
        <p class="sign text-right">Hamza</p>
    </div>
</section>
<section id="ourbooks-home">
    <h2 class="text-center">Les derniers livres ajoutés</h2>
    <div class="books-grid">
        <?php
        foreach($books as $book)
        {
            ?>
            <a href="index.php?page=bookDetail&book=<?= $book->getId() ?>">
                <article class="background-3">
                    <img src="<?= $book->getImg()?? "Asset/img/default.png" ?>" alt="">
                    <div class="book-info">
                        <div>
                            <h3><?= Tools::xssClean($book->getTitle()) ?></h3>
                            <span><?= Tools::xssClean($book->getAuthor()) ?></span>
                        </div>
                        <span>Vendu par:<?= Tools::xssClean($infos[$book->getId()]['user']->getName()) ?></span>
                    </div>
                </article>
            </a>
            <?php
        }
        ?>
    </div>
    <a class="button-green hidden-mob button-size-2" href="index.php?page=books">Voir tous les livres</a>
</section>
<section class="background-1 text-center" id="mcm-home" >
    <h2>Comment ça marche ?</h2>
    <p>Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div class="mcm-grid">
        <article class="background-3">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </article>
        <article class="background-3">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </article>
        <article class="background-3">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </article>
        <article class="background-3">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </article>
    </div>
    <a class="button full-mob button-size-2" href="index.php?page=books">Voir tous les livres</a>
</section>
<section class="background-1 text-center" id="valeurs-home">
    <img class="img-band hidden-mob" src="Asset/img/bande.png" alt="">
    <img class="img-band hidden-desk" src="Asset/img/val_illu.png" alt="">
    <div>
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <p class="sign">L'équipe Tom Troc</p>
        <img src="Asset/img/end_home.svg" alt="">
    </div>
</section>
