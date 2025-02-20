<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

$page = Tools::request('page', 'home');

try {
    switch($page)
    {
        case 'home':
            $mainController = new MainController();
            $mainController->homePage();
            break;
        case 'books':
            $mainController = new MainController();
            $mainController->ourBooks();
        default;
            throw new Exception("La page demandée n'existe pas.", 404);
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage(), 'code' => $e->getCode()]);
}