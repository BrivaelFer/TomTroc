<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

$page = Tools::request('page', 'home');

// try {
    switch($page)
    {
        case 'home':
            $mainController = new MainController();
            $mainController->homePage();
            break;
        case 'books':
            $mainController = new MainController();
            $mainController->ourBooks();
            break;
        case 'loginPage':
            $userController = new UserController();
            $userController->loginPage();
            break;
        case 'login':
            $userController = new UserController();
            $userController->login();
            break;
        case 'signup':
            $userController = new UserController();
            $userController->signupPage();
            break;
        case 'createAccount':
            $userController = new UserController();
            $userController->createAccount();
            break;
        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;
        case 'account':
            $userController = new UserController();
            $userController->account();
            break;
        case 'editAccount':
            $userController = new UserController();
            $userController->editAccount();
            break;
        case 'editImg':
            $userController = new UserController();
            $userController->editImg();
        case 'profil':
            $userController = new UserController();
            break;
        case 'message':
            $userController = new UserController();
            break;
        case 'bookDetail':
            $bookController = new BookController();
            $bookController->bookDetails();
            break;
        case 'editBook':
            $bookController = new BookController();
            $bookController->editBook();
            break;
        case 'createBook':
            $bookController = new BookController();
            $bookController->createBook();
            break;
        case 'delBook':
            $bookController = new BookController();
            $bookController->delBook();
            break;
        default;
            throw new Exception("La page demandée n'existe pas.", 404);
    }
// } catch (Exception $e) {
//     $errorView = new View('Erreur');
//     $errorView->render('errorPage', ['errorMessage' => $e->getMessage(), 'code' => $e->getCode()]);
// }