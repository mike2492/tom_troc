<?php

class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $latestBooks = $bookManager->findLatest(4);
        $this->render('home', ['latestBooks' => $latestBooks]);
    }
}