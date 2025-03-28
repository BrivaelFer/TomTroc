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
            <article class="background-3">
                <img src="<?= $book->getImg()?? "Asset/img/default.png" ?>" alt="">
                <div class="book-info">
                    <div>
                        <h3><?= $book->getTitle()?></h3>
                        <span>
                            <?php 
                            $a = [];
                            foreach($infos[$book->getId()]['authors'] as $author) 
                            {
                                $a[] = ($author->getPseudo()?? $author->getFirstName(). " " . $author->getName());
                            }
                            echo implode(',', $a);
                            ?>
                        </span>
                    </div>
                    <span>Vendu par:<?= $infos[$book->getId()]['user']->getName() ?></span>
                </div>
            </article>
            <?php
        }
        ?>
    </div>
</section>