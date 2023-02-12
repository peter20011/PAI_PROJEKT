<?php

require_once 'AppController.php';
class BBController extends AppController
{
        public function homePage()
    {
        $this->render('homePage');
    }

    public function bandProfile(){
        $this->render('bandProfile');
    }

}