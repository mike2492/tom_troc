<?php

class HomeController extends Controller{

    public function index() : void{
        $bookManager = new BookManager();
        $latestBooks = $bookManager->findLatest(4);

        $this->render('home/index', ['latestBooks' => $latestBooks]);
    }
}