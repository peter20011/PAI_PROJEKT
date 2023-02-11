<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index(){
        $this->render('changePassword');
    }

    public function homepage()
    {
        $this->render("chooseBandOrUser");
    }
}
