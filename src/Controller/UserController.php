<?php

class UserController extends Controller{


    public function show() : void{

        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($id);
        if($user === null){
            header('Location: index.php?controller=home&action=index');
            exit;
        }

        $books = $bookManager->findByUserId($id);

        $this->render('user/show', ['user' => $user, 'books' => $books]);

    }
}