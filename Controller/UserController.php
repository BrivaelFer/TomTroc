<?php

class UserController
{
    public function loginPage()
    {
        $email = Tools::request('email', false);
        $pw = Tools::request('pw', false);


        $view = new View('Connexion');
        $view->render(TEMPLATE_VIEW_PATH.'loginPage.php', ['email' => $email, 'pw' => $pw]);
    }
    public function signupPage()
    {
        $view = new View('Inscription');
        $view->render(TEMPLATE_VIEW_PATH.'signup.php');
    }
    public function createAccount()
    {
        $userRepository = new UserRepository();

        if(
            $_POST['name'] != '' && 
            preg_match("/^[^@]+@[^@]+\.[^@]+$/",$_POST['email']) && 
            $_POST['password'] != ''
        )
        {
            $user = new User($_POST);

            $id = $userRepository->addUser($user);
    
            $this->login($id);
        }
        else Tools::redirect('signup');
       
    }
    public function login(int $id = null)
    {
        $cible = Tools::request('cible', null);
        $email = $_POST['email'] ?? null;
        $pw = $_POST['pw'] ?? null;

        if((!$email || !$pw) && !$id) 
        {
            Tools::redirect(
                'loginPage', 
                !$cible ? ['email' => !$email, 'pw' => !$pw]:['cible' => $cible ,'email' => !$email, 'pw' => !$pw]
            );
        }
        elseif($id){
            $userRepository = new UserRepository();
            $usr = $userRepository->findUserById($id);
            $_SESSION['user'] = serialize($usr);
            Tools::redirect('home');
        }
        else
        {
            $userRepository = new UserRepository();
            $usr = $userRepository->findUserByEmail($email);
            if ($usr && Tools::comparePassword($pw, $usr->getPassword())) 
            {
                $_SESSION['user'] = serialize($usr);
                Tools::redirect($cible ?? 'home');
            }
            else
            {
                Tools::redirect('loginPage', !$cible ? ['fail' => true]: ['cible' => $cible, 'fail' => true]);
            }
        }
    }
    public function logout(){
        $page = Tools::request('cible', 'home');
        unset($_SESSION['user']);
        Tools::redirect($page);
    }
    public function account()
    {
        $user = $_SESSION['user'] ?? null;
        if ($user) {
            $user = unserialize($user);
            $bookRepository = new BookRepository();
            $usrBooks = $bookRepository->findBooksByUser($user->getId());

            $veiw = new View('Compte');
            $veiw->render(TEMPLATE_VIEW_PATH . 'account.php', [
                    'books' => $usrBooks,
                    'user' => $user
                ],
                [
                    'js' => ['account']
                ]
            );
        }
        else Tools::redirect('loginPage', ['cible' => 'account']);
    }
    public function editAccount(): void
    {
        $user = $_SESSION['user'];
        if ($user)
        {
            $user = unserialize($user);

            $name = $_POST['name'] ?? null;
            $pw = $_POST['password'] ?? null;
            $email = $_POST['email'] ?? null;

            if(!empty(trim($name))) $user->setName($name);
            if(!empty(trim($email))) $user->setEmail($email);

            $userRepository = new UserRepository();

            if(!empty(trim($pw))) { 
                $user->setPassword($pw);
                $userRepository->updateUser($user);
            }
            else $userRepository->updateUser($user, true);
            
            $_SESSION['user'] = serialize($userRepository->findUserById($user->getId()));

            Tools::redirect('account');
        }
        else Tools::redirect('home');
    }
    public function editImg(): void
    {
        $user = $_SESSION['user'] ?? null;

        if($user)
        {
            $user = unserialize($user);
            $typeImg = $_POST['type'];
            $redirect = 'account';
            $param = [];
            $file = $_FILES[$typeImg.'_img'];
            if(!in_array($typeImg, ['user', 'book']))
            {
                Tools::redirect('account');
            }
            elseif($typeImg == 'book'){
                $bookId = $_POST['bookId'];
                $redirect = 'editBook';
                $param['book'] = $bookId;
            }
            $imgName = ($typeImg. ($bookId ?? "") . "_" . $user->getId());
            $path = Tools::uploadImg($file, $imgName, $typeImg);
            if($typeImg == 'user'){
                if($path != $user->getUsrImg())
                {
                    $user->setUsrImg($path);
    
                    $userRepositry = new UserRepository();
                    $userRepositry->updateUser($user, true);
    
                    $user = $userRepositry->findUserById($user->getId());
                    $_SESSION['user'] = serialize($user);
                }
            }
            elseif($typeImg == 'book'){
                $bookRepo = new BookRepository();
                $book = $bookRepo->findBookById($bookId);
                $book->setImg($path);
                $bookRepo->updateBook($book);
            }
           
            Tools::redirect($redirect, $param);
        }
        Tools::redirect('account');
    }
    public function profil(): void
    {
        $id = Tools::request('user', null);
        if($id)
        {
            $userRepo = new UserRepository();
            $user = $userRepo->findUserById($id);
            if($user)
            {
                $bookRepo = new BookRepository();
                $books = $bookRepo->findBooksByUser($id);

                $veiw = new View('Profil');
                $veiw->render(TEMPLATE_VIEW_PATH . 'profil.php',[
                    'user' => $user,
                    'books' => $books
                ]);
            }
            else Tools::redirect('home');
        }
        else Tools::redirect('home');
    }
    public function message(): void
    {
        $user = $_SESSION['user'] ?? null;

        if($user) {
            $user = unserialize($user);

            $id = Tools::request('id', null);

            $messageRepo = new MessageRepository();
            $userRepo = new UserRepository();

            $messages = $messageRepo->findByUser($user->getId());
            $messagesUsers = [];
            foreach($messages as $message)
            {
                $otherUserId = ($message->getWriterId() === $user->getId())? $message->getReaderId():$message->getWriterId();
                $messagesUsers[$otherUserId]['messages'][] = $message;
            }
            foreach($messagesUsers as $key=>$values)
            {
                $otherUser = $userRepo->findUserById($key);
                $messagesUsers[$key]['user'] = $otherUser;
                $lastMessage = end($values['messages']);
                $messagesUsers[$key]['time'] = $lastMessage->getPublication()->format('d.m');
                $messagesUsers[$key]['lmContent'] = $lastMessage->getContent();
            }
            if($id && !isset($messagesUsers[$id]))
            {
                $messagesUsers[$id]['user'] = $userRepo->findUserById($id);
                $messagesUsers[$id]['messages'] = [];
            }
            if(empty($id) || !isset($id))
            {
                $id = array_key_first($messagesUsers);
            }

            $view = new View('Messageri');
            $view->render(TEMPLATE_VIEW_PATH . 'message.php', [
                    'user' => $user,
                    'messagesUsers' => $messagesUsers,
                    'selected' => $id
                ],
                [
                    'css' => ['message'],
                    'js' => ['message']
                ]
            );
        }
        else
        {
            Tools::redirect('loginPage');
        }
    }
    public function addMessage(){
        $user = $_SESSION['user'];
        if($user)
        {
            $user = unserialize($user);

            $id = Tools::request('id', null);
            $content = $_POST['message'];
            if (empty($id)) {
                Tools::redirect('message');
            }
            elseif(empty($content))
            {
                Tools::redirect('message', ['id' => $id]);
            }
            else
            {
                $userRepo = new UserRepository();
                $reader = $userRepo->findUserById($id);

                $messageRepo = new MessageRepository();
                $messageRepo->insertMessage($user->getId(), $reader->getId(), $content);

                Tools::redirect('message', ['id' => $id]);
            }
        }
        else Tools::redirect('loginPage', ['cible' => 'message']);
    }
}