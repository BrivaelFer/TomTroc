<?php

class MainController{
    public function homePage(): void
    {
        $bookRepository = new BookRepository();

        $books = $bookRepository->findAllBooks(['orders' => ['id'=> -1], 'limit' => 4]);
        $userRepository = new UserRepository();
        $booksInfos = [];
        foreach($books as $book)
        {
            $booksInfos[$book->getId()] = [
                'user' => $userRepository->findUserById($book->getUsrId())
            ];

        }

        $view = new View('Accueil');
        $view->render(TEMPLATE_VIEW_PATH . 'homePage.php', [
                'books' => $books,
                'infos' => $booksInfos
            ],
            [
                'css' => ['home']
            ]
        );
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
        $userRepository = new UserRepository();
        $booksInfos = [];
        foreach($books as $book)
        {
            $booksInfos[$book->getId()] = [
                'user' => $userRepository->findUserById($book->getUsrId())
            ];

        }

        $view = new View("Nos livres");
        $view->render(TEMPLATE_VIEW_PATH . 'ourBooks.php',[
                'books' => $books,
                'infos' => $booksInfos
            ],
            [
                'css' => ['ourBooks']
            ]
        );
    }
    public function error(): void
    {
        
    }
}