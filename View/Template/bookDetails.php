<section class="background-1" id="details-book">
    <div class="path-container">
        <p class="path-nav color-gray"><a href="index?page=ourBooks">Nos livre</a> > <?= $book->getTitle() ?></p>
    </div>
    <div class="background-2">
        <img src="<?= $book->getImg() ?? 'Asset/img/default.png' ?>" alt="">
        <div class="infos-book">
            <div>
                <div>
                    <h2 class="no-top-margin"><?= $book->getTitle() ?></h2>
                    <p class="color-gray">Par: <?= $book->getAuthor() ?></p>
                </div>
                <div class="bottom-separator detail-separator gray-border"></div>
                <div>
                    <h3>DESCRIPTION</h3>
                    <p><?= $book->getSummary() ?></p>
                </div>
                <div>
                    <h3>PROPRIÉTAIRE</h3>
                    <a class="profil-link" href="index.php?page=profil&user=<?= $user->getId() ?>">
                        <div class="user-i background-3">
                            <img class="medium-profil-img" src="<?= $user->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
                            <p><?= $user->getName() ?></p>
                        </div>
                    </a>
                </div>
            </div>
            <a class="button-green button-full flex-end" href="index.php?page=message&id=<?= $user->getId() ?>">Envoyer un message</a>
        </div>
    </div>
</section>