<section>
    <form action="index.php?page=createAccount" method="post">
        <!-- gestion img -->
        <label for="name">Pseudo</label>
        <input type="text" name="name" id="name">
        <label for="email">Adresse email</label>
        <input type="text" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="pw">
        <input type="submit" value="Se connecter">
    </form>
</section>
<section>
    <table>
        <thead>
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
            $book->setAuthors();
            ?>
            <tr>
                <td><img src="<?= $book->getImg() ?>" alt=""></td>
                <td><?= $book->getTitle() ?></td>
                <td><?= $book->getAuthorsNames() ?></td>
                <td><?= $book->getSummary() ?></td>
                <td>
                    <?php 
                    if($book->getDispo()) { 
                        ?>
                        <span class="">Disponible</span> 
                        <?php 
                    }
                    else { 
                        ?>
                        <span class="">Indisponible</span> 
                        <?php 
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?page=editeBook&book=<?= $book->getId ?>">Editer</a>
                    <a href="index.php?page=delBook&book=<?= $book->getId ?>">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</section>
