# TomTroc
Site d'échange de livres projet de formation OpenClassRoom

## Installation

### Prérequis 

PHP 8.2
Base de données MySQL

### Clonage

Récupérez le projet avec :
```
git clone https://github.com/BrivaelFer/TomTroc.git
```
### Configuratio BDD
Créer un ficher `dataBaseConfig.php` dans le dossier `config` et copiez y les code suivant:
```php
<?php

$host = ''; //Host
$dbName = ''; //Base de données
$dbUser = ''; // Utilisateur
$dbpw = ''; // Mots de passe
```
Ajouter les valeur corspondant à vortre base de données.

`script/tomtroc_p6.sql` contien un stript MySql pour la structure de la base de données.

### HTACCESS

Créer un ficher `.htaccess` à la racine du projet avec le code dans `htaccess-config.txt`.

Et configurer si votre projet n'est pas place à la racine du server `RewriteBase /projet`.