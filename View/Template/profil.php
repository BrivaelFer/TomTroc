<section id="user-profil">
    <div class="background-3 card profil-info">
        <div class="bottom-separator" style="max-width:242px;">
            <img class="full-profil-img" src="<?= $user->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
            <p id="img_modif_show">modifier</p>
            <form id="img_form" class="hidded" action="index.php?page=editImg" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type" value="user">
                <input type="file" name="user_img" id="user_img" accept="image/*" required>
                <input type="submit" value="valider">
            </form>
        </div>
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
        <a class="button" href="index.php?page=message">Écrire un message</a>
    </div>
    <div class="user-books-list background-3 card">
        <table>
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
                    <td><?= $book->getTitle() ?></td>
                    <td><?= $book->getAuthor() ?></td>
                    <td><?= substr($book->getSummary(), 0, 100) . '...' ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>