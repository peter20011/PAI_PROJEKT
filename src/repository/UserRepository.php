<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';
class UserRepository extends Repository
{
    public function getUser(string $email): User
    {
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
            $user['password'],
            $user['role']
        );
    }

    public function addUser(User $user)
    {
        $pdo = $this->database->connect();
        $pdo->beginTransaction();

        $stm = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $username = $user->getUsername();
        $stm ->bindParam(':username',$username,PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            $pdo->rollBack();
            throw new CannotAddRecordException('User with this name already exists');
        }

        $stm = $pdo->prepare('INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)');

        $stm->bindParam(1, $username, PDO::PARAM_STR);
        $email=$user->getEmail();
        $stm->bindParam(2, $email, PDO::PARAM_STR);
        $password = $user->getPassword();
        $stm->bindParam(3, $password, PDO::PARAM_STR);
        $role=$user->getRole();
        $stm->bindParam(4, $role, PDO::PARAM_INT);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $pdo->rollBack();
            throw new CannotAddRecordException('Cannot register this user');
        }

        $pdo->commit();

    }

    public function updatePassword(User $user) {
        $pdo = $this->database->connect();

        $pdo->beginTransaction();
        $stm = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
        $password = $user->getPassword();
        $stm->bindParam(1, $password, PDO::PARAM_STR);
        $email = $user->getEmail();
        $stm->bindParam(2, $email, PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $pdo->rollBack();
            throw new NoMatchingRecordException();
        }
        $pdo->commit();
    }

    public function ifContains(string  $email): bool{
        $stm = $this->database->connect()->prepare('SELECT * FROM "users" where email =:email');
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            return false;
        }

        return true;
    }



}