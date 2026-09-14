<?php

class UserController extends Controller{

    public function account(){
        if($this->isLoggedIn()){
            $this->render('user/account');
        }
    }
}