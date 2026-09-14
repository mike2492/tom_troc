<?php

class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $userManager = new UserManager();
        $latestBooks = $bookManager->findLatest(4);

        $owners = [];
        foreach($latestBooks as $book){
            $owners[$book->getUserId()] = $userManager->findById($book->getUserId());
        }

        $this->render('home', ['latestBooks' => $latestBooks, 'owners' => $owners]);
    }
}