<section class="background-1" id="details-book">
    <p><a href="index?page=ourBooks">Nos livre</a>><?= $book->getTitle() ?></p>
    <div class="background-2">
        <img src="<?= $book->getImg() ?? 'Asset/img/default.png' ?>" alt="">
        <div>
            <div>
                <h2><?= $book->getTitle() ?></h2>
                <p>Par: <?= $book->getAuthor() ?></p>
            </div>
            <div>
                <h3>DESCRIPTION</h3>
                <p><?= $book->getSummary() ?></p>
            </div>
            <div style="width:20px;" class="bottom-separator"></div>
            <div>
                <h3>PROPRIÉTAIRE</h3>
                <div>
                    <img class="full-profil-img" src="<?= $user->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
                    <p><?= $user->getName() ?></p>
                </div>
            </div>
            
            <a class="button-green" href="">Envoyer un message</a>
        </div>
    </div>
</section>