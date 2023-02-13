<?php

require_once 'SessionController.php';
class BBController extends SessionController
{
        public function homePage()
    {
        $this->render('homePage');
    }

    public function bandProfile(){
        $this->render('bandProfile');
    }

}