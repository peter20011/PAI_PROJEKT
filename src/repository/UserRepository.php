<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Permission.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';
class UserRepository extends Repository
{
    public function getUser(string $email): User{
    $stm=$this->database->connect()->prepare('SELECT * FROM Users WHERE email=:email');
    }
}