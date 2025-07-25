<?php 

$book = $book ?? null;

?>
<section id="book-form">
    <a class="link-block v-marged" href="index?page=account.php"><img class="arrow-left" src="Asset/img/fleche.png" alt="">retour</a>
    <h2 class="v-marged">Modifier les informations</h2>
    <div id="book-edit" class="background-3 card">
        <div id="book-form-img" class="form-container">
            <p class="item-start label">Photo</p>
            <img  src="<?= $book->getImg() ?? 'Asset/img/default.png' ?>" alt="">
            <form id="img_form" class="hidded" action="index.php?page=editImg" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type" value="book">
                <input type="hidden" name="bookId" id="bookId" value="<?= $book->getId() ?>">
                <input type="file" name="book_img" id="book_img" accept="image/*" required>
                <input type="submit" value="valider">
            </form>
            <p class="item-end" id="img_modif_show">Modifier la photo</p>
        </div>
        <div class="form-container text-left">
            <form id="book-form-text" action="<?= $book ? 'index.php?page=editBook&book='. $book->getId():'index.php?page=createBook' ?>" method="post">
                <div class="input-container">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?= Tools::xssClean($book->getTitle()) ?>" placeholder=" ">
                </div>
                <div class="input-container">
                    <label for="author">Auteur</label>
                    <input type="text" name="author" id="author" value="<?= Tools::xssClean($book->getAuthor()) ?>" placeholder=" ">
                </div>
                <div class="input-container">
                    <label for="summary">Description</label>
                    <textarea name="summary" id="summary" placeholder=" "><?= $book->getSummary() ?></textarea>
                </div>
                <div class="input-container">
                    <label for="dispo">Disponibilité</label>
                    <select name="dispo" id="dispo">
                        <option value="true" <?= $book->isDispo() ? 'selected': '' ?>>Disponible</option>
                        <option value="false" <?= !$book->isDispo() ? 'selected': '' ?>>Indisponible</option>
                    </select>
                </div>
                <input class="button-green full-mob" type="submit" value="Valider">
            </form>
        </div>
    </div>
    
</section>