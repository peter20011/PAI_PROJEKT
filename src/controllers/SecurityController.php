<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
class SecurityController extends AppController
{
    public function login()
    {
        $user= new User("janko","janko@gmail.com","makao123",0);

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmial() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        return $this->render('homePage');

    }

    public function registrationBand(){
        $this->render("registrationBand");
    }

    public function changePassword(){
        $this->render('changePassword');
    }

    public function registrationUser(){
        $this->render("registrationUser");
    }

    public function bandDescribe(){
        $this->render('bandDescribe');
    }

}