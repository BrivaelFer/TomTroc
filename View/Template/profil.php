<section id="user-profil">
    <div class="background-3 card profil-info">
        <div class="user-img">
            <img class="full-profil-img" src="<?= $user->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
            <p id="img_modif_show">modifier</p>
            <form id="img_form" class="hidded" action="index.php?page=editImg" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type" value="user">
                <input type="file" name="user_img" id="user_img" accept="image/*" required>
                <input type="submit" value="valider">
            </form>
        </div>
        <div class="bottom-separator profil-separator"></div>
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
        <a class="button button-full" href="index.php?page=message">Écrire un message</a>
    </div>
    <div class="user-books-list background-3-desk card-desk">
        <table class="hidden-mob text-left">
            <thead class="text-left bottom-separator">
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>DESCRIPTION</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            foreach($books as $book)
            {
                ?>
                <tr>
                    <td><img src="<?= $book->getImg() ?? "Asset/img/default.png" ?>" alt=""></td>
                    <td><a class="link-block black_link" href="index.php?page=bookDetail&book=<?= $book->getId() ?>"><?= $book->getTitle() ?></a></td>
                    <td><?= $book->getAuthor() ?></td>
                    <td class="text-left"><?= substr($book->getSummary(), 0, 100) . '...' ?></td>
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
                <a href="index.php?page=bookDetail&book=<?= $book->getId() ?>" class="card background-3 profil-link">
                    <div class="book-main-info-mob">
                        <img src="<?= $book->getImg() ?? "Asset/img/default.png" ?>" alt="">
                        <div>
                            <div>
                                <span><?= $book->getTitle() ?></span>
                                <span><?= $book->getAuthor() ?></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p><?= substr($book->getSummary(), 0, 100) . '...' ?></p>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</section>