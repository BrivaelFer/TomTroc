# TomTroc

Site d'échange de livres, projet de formation OpenClassrooms.

## Installation
### Prérequis

PHP 8.2
Base de données MySQL

## Clonage

Récupérez le projet avec :

Copier
`git clone https://github.com/BrivaelFer/TomTroc.git`

## Configuration BDD

Créez un fichier `dataBaseConfig.php` dans le dossier `config` et copiez-y le code suivant :

Copier
```php
<?php

$host = ''; // Hôte
$dbName = ''; // Base de données
$dbUser = ''; // Utilisateur
$dbpw = ''; // Mot de passe
```

Ajoutez les valeurs correspondant à votre base de données.

`script/tomtroc_p6.sql` contient un script MySQL pour la structure de la base de données.

## HTACCESS

Créez un fichier `.htaccess` à la racine du projet avec le code dans `htaccess-config.txt`.

Et configurez `RewriteBase /projet` si votre projet n'est pas placé à la racine du serveur.

(Si le htaccess n'est pas configuré, l'utilisateur ne sera pas redirigé correctement vers la page d'erreur.)