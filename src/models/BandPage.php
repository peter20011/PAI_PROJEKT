<?php

require_once 'Band.php';
class BandPage extends Band
{
    private $id;


    public function __construct(string $username, string $email, string $password, string $scheduleLink, string $ytLink, string $fanpageLink, string $bandDescription, int $numberLikes = 0, int $id)
    {
        parent::__construct($username, $email, $password, $scheduleLink, $ytLink, $fanpageLink, $bandDescription, $numberLikes);
        $this->id=$id;
    }

}