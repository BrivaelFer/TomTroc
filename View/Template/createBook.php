<?php 

$book = $book ?? null;

?>
<section id="book-form">
    <a class="link-block v-marged" href="index?page=account">retour</a>
    <h2 class="v-marged">Ajouter livre</h2>
    <div class="background-3 card text-left">
        <div id="book-form-img" class="form-container">
            <form id="book-form-text" action="index.php?page=createBook" method="post" enctype="multipart/form-data">
                <div class="input-container">
                    <label for="imgFile">Photo</label>
                    <input type="file" name="imgFile" id="imgFile" accept="image/*">
                </div>

                <div class="input-container">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title"  placeholder=" " required>
                </div>
                <div class="input-container">
                    <label for="author">Auteur</label>
                    <input type="text" name="author" id="author"  placeholder=" " required>
                </div>
                <div class="input-container">
                    <label for="">Description</label>
                    <textarea name="summary" id="summary" placeholder=" " required></textarea>
                </div>
                <div class="input-container">
                    <label for="">Disponibilité</label>
                    <select name="dispo" id="dispo">
                        <option value="true" >Disponible</option>
                        <option value="false" selected>Indisponible</option>
                    </select>
                </div>
                <input class="button-green" type="submit" value="Valider">
            </form>
        </div>
    </div>
    
</section>