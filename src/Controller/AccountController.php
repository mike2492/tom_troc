<?php

class AccountController extends Controller{

    public function index(){

        $this->requireAuth();
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            $password = $_POST['password'];


            if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "L'email n'est pas valide";
            }

            if(empty($errors)){
                if(!empty($username)){
                    $user->setUsername($username);
                }

                if(!empty($email)){
                    $user->setEmail($email);
                }

                if(!empty($password)){
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                }

                $userManager->update($user);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
            

        }

        $this->render('account/index', ['user' => $user, 'books' => $books, 'errors' => $errors]);

    }
}