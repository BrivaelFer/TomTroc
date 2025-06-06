<h2 class="account-title">Mon compte</h2>
<section id="user-infos">
    <div class="background-3 card">
        <div style="max-width:242px;">
            <img class="full-profil-img" src="<?= $user->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
            <p id="img_modif_show" class="color-gray">modifier</p>
            <form id="img_form" class="hidded" action="index.php?page=editImg" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type" value="user">
                <input type="file" name="user_img" id="user_img" accept="image/*" required>
                <input type="submit" value="valider">
            </form>
        </div >
        <div class="bottom-separator" style="max-width:242px; width: 100%;"></div>
        <div>
            <div>
                <h3 class="big-title"><?= $user->getName() ?></h3>
                <p class="color-gray">Membre depuis <?= $user->getAccountAge() ?></p>
            </div>
            <div>
                <h4 class="little-title">BIBLIOTHEQUE</h4>
                <span class="book-count"><i class="book-icon"></i><?= count($books) ?> livres</span>
            </div>
        </div>
    </div>
    <div class="form-container account-form background-3 card text-left">
        <form action="index.php?page=editAccount" method="post">
            <h3>Vos informations personnelles</h3>
            <div class="input-container">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" value="<?= $user->getEmail()?>" autocomplete="off">
            </div>
            <div class="input-container">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="pw" autocomplete="new-password">
            </div>
            <div class="input-container">
                <label for="name">Pseudo</label>
                <input type="text" name="name" id="name" value="<?= $user->getName()?>"S>
            </div>
            <input class="button full-mob" style="--button-size: 150px" type="submit" value="Enregistrer">
        </form>
    </div>
</section>
<section class="user-books-list background-3-desk card-desk">
    <table class="hidden-mob">
        <thead class="text-left bottom-separator">
            <tr>
                <th>PHOTO</th>
                <th>TITRE</th>
                <th>AUTEUR</th>
                <th>DESCRIPTION</th>
                <th>DISPONIBILITE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($books as $book)
        {
            ?>
            <tr>
                <td><img src="<?= $book->getImg() ?? "Asset/img/default.png" ?>" alt=""></td>
                <td><?= $book->getTitle() ?></td>
                <td><?= $book->getAuthor() ?></td>
                <td><?= substr($book->getSummary(), 0, 100) . '...' ?></td>
                <td>
                    <?php 
                    if($book->isDispo()) { 
                        ?>
                        <span class="book-dis">Disponible</span> 
                        <?php 
                    }
                    else { 
                        ?>
                        <span class="book-undis">Indisponible</span> 
                        <?php 
                    }
                    ?>
                </td>
                <td class="book-links">
                    <a class="black_link" href="index.php?page=editBook&book=<?= $book->getId() ?>">Editer</a>
                    <a class="red_link" href="index.php?page=delBook&book=<?= $book->getId() ?>">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <div class="books-list-mob hidden-desk">
        <?php
        foreach($books as $book)
        {
            ?>
            <div class="card background-3">
                <div class="book-main-info-mob">
                    <img src="<?= $book->getImg() ?? "Asset/img/default.png" ?>" alt="">
                    <div>
                        <div>
                            <span><?= $book->getTitle() ?></span>
                            <span><?= $book->getAuthor() ?></span>
                        </div>
                        <?php 
                        if($book->isDispo()) { 
                            ?>
                            <span class="book-dis">Disponible</span> 
                            <?php 
                        }
                        else { 
                            ?>
                            <span class="book-undis">Indisponible</span> 
                            <?php 
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <p><?= substr($book->getSummary(), 0, 100) . '...' ?></p>
                </div>
                <div class="book-links">
                    <a class="black_link" href="index.php?page=editBook&book=<?= $book->getId() ?>">Editer</a>
                    <a class="red_link" href="index.php?page=delBook&book=<?= $book->getId() ?>">Supprimer</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
