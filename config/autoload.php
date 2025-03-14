<?php

/**
 * Système d'autoload. 
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction 
 * et chercher dnas les divers dossiers (ici models, controllers, views, services) s'il trouve 
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
spl_autoload_register(function($className) {
    // On va voir dans le dossier Service si la classe existe.
    // if (file_exists('services/' . $className . '.php')) {
    //     require_once 'services/' . $className . '.php';
    // }

    // On va voir dans le dossier Model si la classe existe.
    if (file_exists('Model/' . $className . '.php')) {
        require_once 'Model/' . $className . '.php';
    }

    // On va voir dans le dossier Controller si la classe existe.
    if (file_exists('Controller/' . $className . '.php')) {
        require_once 'Controller/' . $className . '.php';
    }

    // On va voir dans le dossier View si la classe existe.
    if (file_exists('View/' . $className . '.php')) {
        require_once 'View/' . $className . '.php';
    }

    if (file_exists('Repository/'. $className .'.php')){
        require_once 'Repository/'. $className .'.php';
    }

    if (file_exists('services/'. $className .'.php')){
        require_once 'services/'. $className .'.php';
    }
    
});