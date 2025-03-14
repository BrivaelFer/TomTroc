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
            $_SESSION['user'] = $usr;
            Tools::redirect('home');
        }
        else
        {
            $userRepository = new UserRepository();
            $usr = $userRepository->findUserByEmail($email);
            if ($usr && Tools::comparePassword($pw, $usr->getPassword())) 
            {
                $_SESSION['user'] = $usr;
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
    public function account(){
        $user = $_SESSION['user'] ?? null;
        if ($user) {
            $bookRepository = new BookRepository();
            $usrBooks = $bookRepository->findBooksByUser($user->getId());

            $veiw = new View('Compte');
            $veiw->render(TEMPLATE_VIEW_PATH . 'account.php', [
                'books' => $usrBooks
            ]);
        }
        else Tools::redirect('loginPage', ['cible' => 'account']);
    }
    public function profil(): void
    {
        // $id = Tools::request('user', null);
        // if($id)
        // {

        // }
        // else 
    }
    public function message(): void
    {

    }
}