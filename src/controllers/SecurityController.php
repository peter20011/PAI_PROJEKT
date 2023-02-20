<?php

require_once 'SessionController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Band.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/BandRepository.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';

class SecurityController extends SessionController
{
    public function login()
    {
        $userRepository= new UserRepository();
        $bandRepository= new BandRepository();

        $user= new UserRepository();

        if (!$this->isPost()){
            return $this->render('login');
        }
        if (!$this->areAllSet(['email','password'])) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $pass= $_POST['password'];


        $exists=$user->ifContains($email);

        try{
            if($exists){
                $user=$userRepository->getUser($email);
            }else{
                $band=$bandRepository->getBand($email);
            }
        }catch (NoMatchingRecordException $e){
            return $this->render('login', ['messages' => ["User or Band not exists"]]);
        }

        if($exists){
            if (!password_verify($pass,$user->getPassword())) {
                return $this->render('login', ['messages' => ["Wrong password"]]);
            }
            $this->createSession($user);
        }else{
            if (!password_verify($pass,$band->getPassword())) {
                return $this->render('login', ['messages' => ["Wrong password"]]);
            }
            $this->createSessionBand($band);
        }

        $this->changeHeader('homePage');
    }

    public function registrationBand(){

        if (!$this->isPost()){
            return $this->render("registrationBand");
        }
        if (!$this->areAllSet(['username','email','password','password2','schedule','yt','fb','description'])) {
            return $this->render("registrationBand",['messages' => ['Lack of data']]);
        }

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $schedule=$_POST['schedule'];
        $yt=$_POST['yt'];
        $fb=$_POST['fb'];
        $description=$_POST['description'];

        if (preg_match_all("/^[a-zA-Z0-9]{3,100}$/", $name) == false) {
            return $this->render('registrationBand', ['messages' => ['Wrong bandname']]);
        }

        if (preg_match_all('/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i', $email) == false) {
            return $this->render('registrationBand', ['messages' => ['Wrong email address']]);
        }

        if (strlen($email) > 100) {
            return $this->render('registrationBand', ['messages' => ['Address email is too long']]);
        }
        if (strlen($description) ==0) {
            return $this->render('registrationBand', ['messages' => ['Lack of description']]);
        }

        if (!$this->validatePassword($password)) {
            return $this->render('registrationBand', ['messages' => ['Password is too weak']]);
        }

        if($password!==$password2){
            return $this->render('registrationBand', ['messages' => ['Passwords are not the same']]);
        }
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$schedule)){
            return $this->render('registrationBand', ['messages' => ['Wrong url']]);
        }
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$yt)){
            return $this->render('registrationBand', ['messages' => ['Wrong url']]);
        }
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fb)){
            return $this->render('registrationBand', ['messages' => ['Wrong url']]);
        }

        $bandRepository = new BandRepository();
        $userRepository= new UserRepository();
        if($userRepository->ifContains($email) ){
            return $this->render('registrationBand' ,['messages' => ['User or Band already exists with this address email']]);
        }

        if($bandRepository->ifContains($email)){
            return $this->render('registrationBand' ,['messages' => ['User or Band already exists with this address email']]);
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $band = new Band($name, $email, $hash,$schedule,$yt,$fb,$description);
        try {
            $bandRepository->addBand($band);
        }
        catch(CannotAddRecordException $e) {
            return $this->render('registrationBand', ['messages' => [$e->display()]]);
        }

        $this->render('registrationBand',['messages'=>['Registration has benn passed successfully']]);


    }

    public function changePassword(){
        $this->requiredSession();
        $userRepository= new UserRepository();
        $bandRepository= new BandRepository();

        if(!$this->isPost()){
            return $this->render('changePassword');
        }

        if (!$this->areAllSet(['old_pass','new_pass','new_pass2'])) {
            return $this->render('changePassword',['messages' => ['Lack of data']]);
        }

        $oldPassword=$_POST['old_pass'];
        $newPassword=$_POST['new_pass'];
        $newPassword2=$_POST['new_pass2'];

        $constains=$userRepository->ifContains( $_SESSION['useremail']);

        if (!$this->validatePassword($newPassword)) {
            return $this->render('changePassword', ['messages' => [ 'New password is too weak']]);
        }

        if($newPassword!==$newPassword2){
            return $this->render('changePassword', ['messages' => ['Wrong password ']]);
        }

        if($oldPassword===$newPassword){
            return $this->render('changePassword', ['messages' => ['Wrong password ']]);
        }

        $hash=password_hash($newPassword,PASSWORD_BCRYPT);

        if($constains){
            $result=$this->getUserSession();
            $user=$result['user'];

            if(!password_verify($oldPassword,$user->getPassword())){
                return $this->render('changePassword', ['messages' => ['Wrong password ']]);
            };
            $user->setPassword($hash);
        }else{
            $result=$this->getBandSession();
            $band=$result['band'];

            if(!password_verify($oldPassword,$band->getPassword())){
                return $this->render('changePassword', ['messages' => ['Wrong password ']]);
            };
            $band->setPassword($hash);
        }

        try{
            if($constains){
                $userRepository->updatePassword($user);
            }else{
                $bandRepository->updatePassword($band);
            }
        }catch (NoMatchingRecordException $e){
            return $this->render('changePassword', [ 'messages' => ['Cannot change password']]);
        }

        return $this->render('changePassword', ['messages' => ['Password has been changed!']]);
    }

    public function registrationUser(){
        if (!$this->isPost()){
            return $this->render('registrationUser');
        }
        if (!$this->areAllSet(['username','email','password','password2'])) {
            return $this->render('registrationUser',['messages' => ['Lack of data']]);
        }

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2=$_POST['password2'];

        if (preg_match_all("/^[a-zA-Z0-9]{3,100}$/", $name) == false) {
            return $this->render('registrationUser', ['messages' => ['Wrong user name']]);
        }

        if (preg_match_all('/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i', $email) == false) {
            return $this->render('registrationUser', ['messages' => ['Wrong email address']]);
        }

        if (strlen($email) > 100) {
            return $this->render('registrationUser', ['messages' => ['Address email is too long']]);
        }

        if (!$this->validatePassword($password)) {
            return $this->render('registrationUser', ['messages' => ['Password is too weak']]);
        }

        if($password!==$password2){
            return $this->render('registrationUser', ['messages' => ['Passwords are not the same']]);
        }

        $userRepository = new UserRepository();
        $bandRepository= new BandRepository();
        if($userRepository->ifContains($email)){
            return $this->render('registrationUser' ,['messages' => ['User or Band already exists with this address email']]);
        }
        if($bandRepository->ifContains($email)){
            return $this->render('registrationUser' ,['messages' => ['User or Band already exists with this address email']]);
        }


        $hash = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($name, $email, $hash);
        try {
            $userRepository->addUser($user);
        }
        catch(CannotAddRecordException $e) {
            return $this->render('registrationUser', ['messages' => [$e->display()], 'defaults' => ['name' => $name, 'email' => $email]]);
        }

        $this->render('registrationUser',['messages'=>['Registration has benn passed successfully']]);

    }

    public function logout(){
        session_destroy();
        $this->changeHeader("login");
    }

    public function validatePassword(string $password):bool {
        if (strlen($password) < 8) {
            return false;
        }

        return true;
    }

}