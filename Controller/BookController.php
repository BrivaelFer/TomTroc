<?php

class BookController
{
    public function bookDetails(): void
    {
        $id = Tools::request('book', null);
        if(!isset($id)){
            Tools::redirect('ourBooks');
        }
        else {
            $bookRepo = new BookRepository();
            $book = $bookRepo->findBookById($id);
            
            if($book)
            {
                $userRepo = new UserRepository();
                $user = $userRepo->findUserById($book->getUsrId());
                $view = new View('Détails livre');
                $view->render(TEMPLATE_VIEW_PATH . 'bookDetails.php', [
                        'user' => $user,
                        'book' => $book
                    ],
                    [
                        'css' => ['bookDetails']
                    ]
                );
            }
            else Tools::redirect('ourBooks');
        }
    }
    public function createBook(): void
    {
        $user = $_SESSION['user'] ?? null;
        if($user) {
            $user = unserialize($user);
            if($_POST){
                $param = $_POST;
                $param['usrId'] = $user->getId();
                $param['dispo'] = $param['dispo'] == 'true';
                $book = new Book($param);
                $bookRepo = new BookRepository();
                $id = $bookRepo->insertBook($book);
                if(isset($_FILES['imgFile']))
                {
                    $book = $bookRepo->findBookById($id);
                    $fileName = 'book'. $id . '_' . $book->getUsrId();
                    $book->setImg(Tools::uploadImg($_FILES['imgFile'], $fileName, 'book'));
                    $bookRepo->updateBook($book);
                }
                Tools::redirect('bookDetail', [
                    'book' => $id
                ]);
            }
            else {

                $view = new View('Créer livre');
                $view->render(TEMPLATE_VIEW_PATH . 'createBook.php', [
                    'user' => $user
                ]);
            }
        }
        else {
            Tools::redirect('loginPage', ['cible' => 'createBook']);
        }
    }
    public function editBook(): void
    {
        $user = $_SESSION['user'] ?? null;
        if($user) {
            $user = unserialize($user);
            $bookId = Tools::request('book', null);
            if($bookId){
                $bookRepository = new BookRepository();
                $book = $bookRepository->findBookById($bookId);
                if ($_POST) {
                    $book->setTitle($_POST['title']);
                    $book->setSummary($_POST['summary']);
                    $book->setAuthor($_POST['author']);
                    $book->setDispo($_POST['dispo'] == 'true');
                    $bookRepository->updateBook($book);
                    Tools::redirect('bookDetail', ['book' => $bookId]);
                }
                else
                {
                    $view = new View('Editer livre');
                    $view->render(TEMPLATE_VIEW_PATH . 'editBookPage.php', [
                            'user' => $user,
                            'book' => $book
                        ],
                        [
                            'css' => ['editBook'],
                            'js' => ['account']
                        ]
                    );
                }
            }
            else {
                Tools::redirect('account');
            }
        }
        else {
            Tools::redirect('loginPage', ['cible' => 'editBook']);
        } 
    }
    public function delBook(): void
    {
        $user = $_SESSION['user'] ?? null;
        $id = Tools::request('book', null);
        if ($user && $id) {
            $user = unserialize($user);
            $bookRepository = new BookRepository();
            $book = $bookRepository->findBookById($id);
            if($book && $user->getId() == $book->getUsrId()){
                $bookRepository->deleteBook($id);
            }
            Tools::redirect('account');
        }
        elseif ($user)
        {
            Tools::redirect('account');
        }
        else
        {
            Tools::redirect('home');
        }
    }
}