<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Band.php';
require_once __DIR__.'/../exceptions/NoMatchingRecordException.php';
require_once __DIR__.'/../exceptions/CannotAddRecordException.php';
class BandRepository extends Repository
{
    public function getBand(string $email):Band{

        $stm = $this->database->connect()->prepare('SELECT * FROM band where email =:email');
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            throw new NoMatchingRecordException();
        }

        $band= $stm->fetch(PDO::FETCH_ASSOC);

        if ($band == false) {
            throw new NoMatchingRecordException();
        }

        return new Band(
            $band['username'],
            $band['email'],
            $band['password'],
            $band['scheduleLink'],
            $band['ytLink'],
            $band['fanpageLink'],
            $band['bandDescription']
        );
    }

    public function addBand(Band $band)
    {
        $pdo = $this->database->connect();
        $pdo->beginTransaction();

        $stm = $pdo->prepare('SELECT * FROM band WHERE username = :username');
        $bandname = $band->getUsername();
        $stm ->bindParam(':username',$bandname,PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            $pdo->rollBack();
            throw new CannotAddRecordException('Band with this name already exists');
        }

        $stm = $pdo->prepare('SELECT * FROM band WHERE email = :email');
        $email = $band->getEmail();
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            $pdo->rollBack();
            throw new CannotAddRecordException('Band with this email already exists');
        }

        $stm = $pdo->prepare('INSERT INTO band (username,email,password,schedule_link,yt_link,fb_link,band_description,likes) VALUES (?,?,?,?,?,?,?,?)');

        $stm->bindParam(1, $bandname, PDO::PARAM_STR);
        $stm->bindParam(2, $email, PDO::PARAM_STR);
        $password = $band->getPassword();
        $stm->bindParam(3, $password, PDO::PARAM_STR);
        $scheduleLink = $band->getScheduleLink();
        $stm->bindParam(4, $scheduleLink, PDO::PARAM_STR);
        $ytLink = $band->getYtLink();
        $stm->bindParam(5, $ytLink, PDO::PARAM_STR);
        $FanpageLink = $band->getFanpageLink();
        $stm->bindParam(6, $FanpageLink, PDO::PARAM_STR);
        $bandDescription = $band->getBandDescription();
        $stm->bindParam(7, $bandDescription, PDO::PARAM_STR);
        $numberLikes = $band->getNumberLikes();
        $stm->bindParam(8, $numberLikes, PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $pdo->rollBack();
            throw new CannotAddRecordException('Cannot register this band');
        }

        $pdo->commit();

    }

    //TODO sprawdzić działanie
    public function updatePassword(Band $band){
        $pdo = $this->database->connect();

        $pdo->beginTransaction();
        $stm = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
        $password = $band->getPassword();
        $stm->bindParam(1, $password, PDO::PARAM_STR);
        $email = $band->getEmail();
        $stm->bindParam(2, $email, PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $pdo->rollBack();
            throw new NoMatchingRecordException();
        }
        $pdo->commit();
    }



}