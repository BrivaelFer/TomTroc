<?php

class MainController{
    public function homePage(): void
    {
        $view = new View('Accueil');
        $view->render(TEMPLATE_VIEW_PATH . 'homePage.php');
    }
    public function ourBooks(): void
    {

        $search = Tools::request('search', null);

        $bookRepository = new BookRepository();

        if($search)
        {
            $books = $bookRepository->findAllBooks([
                'filters' => ['title' => $search]
            ]);
        }
        else 
        {
            $books = $bookRepository->findAllBooks();
        }

        $authorRepository = new AuthorRepository();
        $userRepository = new UserRepository();
        $booksInfos = [];
        foreach($books as $book)
        {
            $booksInfos[$book->getId()] = [
                'authors'=> $authorRepository->findAuthorByBookId($book->getId()),
                'user' => $userRepository->findUserById($book->getUsrId())
            ];

        }

        $view = new View("Nos livres");
        $view->render(TEMPLATE_VIEW_PATH . 'ourBooks.php',[
            'books' => $books,
            'infos' => $booksInfos
        ]);
    }
}