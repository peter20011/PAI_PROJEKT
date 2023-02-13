<?php

require_once 'SessionController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';

class SecurityController extends SessionController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()){
            return $this->render('login');
        }
        if (!$this->areAllSet(['email','password'])) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $pass = $_POST['password'];

        try {
            $user = $userRepository->getUser($email);
        }
        catch (NoMatchingRecordException $e) {
            return $this->render('login', ['messages' => ["User not exists"]]);
        }

        if (!$user) {
            return $this->render('login', ['messages' => ["User not exists"]]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ["User with this email not exists"]]);
        }

        if ($user->getPassword()!==$pass) {
            return $this->render('login', ['messages' => ["Wrong password"]]);
        }

        $this->createSession($user);
        $this->changeHeader('homePage');

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