<?php


require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Permission.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
class SessionController extends AppController
{
    protected function createSession(User $user){
        session_start();
        if(isset($_SESSION['auth'])){
            session_destroy();
            session_start();
        }
        $_SESSION['auth']=true;
        $_SESSION['useremail']=$user->getEmail();
        $_SESSION['username']=$user->getUsername();
    }

    protected function requiredSession(){
        session_start();
        if(!isset($_SESSION['auth'])){
            $this->changeHeader('login');
            die();
        }
    }

    //from yt may be usueful
    protected function getUserSession(){
        $userRepository = new UserRepository();
        try {
            $user = $userRepository->getUser($_SESSION['useremail']);
        }
        catch(NoMatchingRecordException $e) {
            session_destroy();
            $this->changeHeader('login');
            die();
        }
        return ["user" => $user];
    }

    protected function destroySession(){
        session_destroy();
    }
}