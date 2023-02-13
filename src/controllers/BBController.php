<?php

require_once 'SessionController.php';
class BBController extends SessionController
{
    //TODO
        public function homePage()
    {
        $this->render('homePage');
    }
    //TODO
    public function bandProfile(){
        $this->render('bandProfile');
    }

}