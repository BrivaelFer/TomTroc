<section>
    <div>
        <h2>Nos livres à l'échange</h2>
        <form action="">
            <input type="search" name="" id="">
        </form>
    </div>
    <div>
        <?php
        foreach($books as $book)
        {
            ?>
            <article>
                <img src="<?= $book->getImg()?? "Asset/img/default.png" ?>" alt="">
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
                    <span>Vendu par:<?= $infos[$book->getId()]['user']->getName() ?></span>
                </div>
            </article>
            <?php
        }
        ?>
    </div>
</section>