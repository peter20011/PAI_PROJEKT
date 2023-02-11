<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index(){
        $this->render('homepage');
    }

    public function homepage()
    {
        $this->render("chooseBandOrUser");
    }
}
