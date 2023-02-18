<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Band.php';
require_once __DIR__.'/../models/BandPage.php';
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
            $band['schedule_link'],
            $band['yt_link'],
            $band['fb_link'],
            $band['band_description']
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

        $stm = $pdo->prepare('INSERT INTO band (username,email,password,schedule_link,yt_link,fb_link,band_description,likes) VALUES (?,?,?,?,?,?,?,?)');

        $stm->bindParam(1, $bandname, PDO::PARAM_STR);
        $email=$band->getEmail();
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

    public function updatePassword(Band $band){
        $pdo = $this->database->connect();

        $pdo->beginTransaction();
        $stm = $pdo->prepare('UPDATE band SET password = ? WHERE email = ?');
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

    public function ifContains(string  $email): bool{
        $stm = $this->database->connect()->prepare('SELECT * FROM band where email =:email');
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            return false;
        }

        return true;
    }

    public function allBandsGet():array{
        $result=[];

        $stm = $this->database->connect()->prepare('SELECT * FROM band');
        $stm->execute();
        $bands=$stm->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bands as $band){
            $result[]= new BandPage(
                $band['username'],
                $band['email'],
                $band['password'],
                $band['schedule_link'],
                $band['yt_link'],
                $band['fb_link'],
                $band['band_description'],
                $band['likes'],
                $band['id_band']
            );
        }

        return $result;
    }

    public function getBandByName(string $searchName){

        $searchName='%'.strtolower($searchName).'%';
        $stm = $this->database->connect()->prepare('SELECT band.username FROM band WHERE LOWER(username) LIKE :search');
        $stm->bindParam(':search', $searchName, PDO::PARAM_STR);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBandById(int $id):Band{

        $stm = $this->database->connect()->prepare('SELECT * FROM band where id_band =:id');
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
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
            $band['schedule_link'],
            $band['yt_link'],
            $band['fb_link'],
            $band['band_description'],
            $band['likes']
        );
    }

    public function like(int $id){
        $stm = $this->database->connect()->prepare('UPDATE band SET "likes" +1 WHERE id= :id ');
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            throw new NoMatchingRecordException();
        }

        $band= $stm->fetch(PDO::FETCH_ASSOC);
    }





}