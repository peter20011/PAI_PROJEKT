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
        $pass= $_POST['password'];
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

        if (!password_verify($pass,$user->getPassword())) {
            return $this->render('login', ['messages' => ["Wrong password"]]);
        }

        $this->createSession($user);
        $this->changeHeader('homePage');

    }


    //TODO
    public function registrationBand(){

        $this->render("registrationBand");
    }

    public function changePassword(){

        $this->requiredSession();

        $result=$this->getUserSession();
        $user=$result['user'];

        if(!$this->isPost()){
            $this->render('changePassword');
        }

        if (!$this->areAllSet(['old_pass','new_pass','new_pass2'])) {
            return $this->render('changePassword');
        }

        $oldPassword=$_POST['old_pass'];
        $newPassword=$_POST['new_pass'];
        $newPassword2=$_POST['new_pass2'];

        if(!password_verify($oldPassword,$user->getPassword())){
            return $this->render('changePassword', ['message' => ['Wrong password']]);
        };

        if (!$this->validatePassword($newPassword)) {
            return $this->render('changePassword', ['message' => [ 'New password is too weak']]);
        }

        if(!$newPassword!==$newPassword2){
            return $this->render('changePassword', ['message' => ['Wrong password']]);
        }

        $hash=password_hash($newPassword,PASSWORD_BCRYPT);
        $userRepostory= new UserRepository();

        $user->setPassword($hash);

        return $this->render('changePassword', ['message' => ['Password has been changed!']]);

    }

    public function registrationUser(){
        if (!$this->isPost()){
            return $this->render('registrationUser');
        }
        if (!$this->areAllSet(['username','email','password','password2'])) {
            return $this->render('registrationUser');
        }

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2=$_POST['password2'];

        if (preg_match_all("/^[a-zA-Z0-9]{3,100}$/", $name) == false) {
            return $this->render('registrationUser', ['messages' => ['Wrong user name']]);
        }

        if (preg_match_all('/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i', $email) == false) {
            return $this->render('registrationUser', ['messages' => ['Wrong email address'], 'defaults' => ['username' => $name]]);
        }

        if (strlen($email) > 100) {
            return $this->render('registrationUser', ['messages' => ['Address email is too long'], 'defaults' => ['username' => $name]]);
        }

        if (!$this->validatePassword($password)) {
            return $this->render('registrationUser', ['messages' => ['Password is too weak'], 'defaults' => ['username' => $name, 'email' => $email]]);
        }

        if($password!==$password2){
            return $this->render('registrationUser', ['messages' => ['Passwords are not the same'], 'defaults' => ['username' => $name, 'email' => $email]]);
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $userRepository = new UserRepository();
        $user = new User($name, $email, $hash);
        try {
            $userRepository->addUser($user);
        }
        catch(CannotAddRecordException $e) {
            return $this->render('registrationUser', ['messages' => [$e->display()], 'defaults' => ['name' => $name, 'email' => $email]]);
        }

        $this->render('registrationUser',['messages'=>['Registration has benn passed successfully']]);

    }

    //TODO
    public function bandDescribe(){
        $this->render('bandDescribe');
    }

    public function validatePassword(string $password):bool {
        if (strlen($password) < 8) {
            return false;
        }

        return true;
    }

}