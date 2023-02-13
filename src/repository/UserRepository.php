<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Permission.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';
class UserRepository extends Repository
{
    public function getUser(string $email): User{
        $stm = $this->database->connect()->prepare('SELECT * FROM "users" where email =:email');
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            throw new NoMatchingRecordException();
        }

        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            throw new NoMatchingRecordException();
        }

        return new User(
            $user['username'],
            $user['email'],
            $user['password']
        );
    }

}