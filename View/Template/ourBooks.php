<section class="books-container">
    <div class="books-head">
        <h2>Nos livres à l'échange</h2>
        <form action="index.php?page=books" method="get">
            <input type="hidden" name="page" value="books">
            <div class="input-container search-bar">
                <input type="search" name="search" id="search" placeholder="Rechercher un livre" >
            </div>
        </form>
    </div>
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
                            <h3><?= $book->getTitle()?></h3>
                            <span><?= $book->getAuthor() ?></span>
                        </div>
                        <span>Vendu par:<?= $infos[$book->getId()]['user']->getName() ?></span>
                    </div>
                </article>
            </a>
            
            <?php
        }
        ?>
    </div>
</section>