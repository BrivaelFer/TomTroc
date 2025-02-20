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
        $bookAuthors = [];
        foreach($books as $book)
        {
            $bookAuthors[$book->getId()] = $authorRepository->findAuthorByBookId($book->getId());

        }

        $view = new View("Nos livres");
        $view->render(TEMPLATE_VIEW_PATH . 'ourBooks.php',[
            'books' => $books,
            'authors' => $bookAuthors
        ]);
    }
}