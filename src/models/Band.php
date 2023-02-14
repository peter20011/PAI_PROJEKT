<?php

class Band
{
    private $username;
    private $email;
    private $password;
    private $scheduleLink;
    private $ytLink;
    private $fanpageLink;
    private $bandDescription;
    private $numberLikes;


    public function __construct(string $username,string $email,string $password, string $scheduleLink,
                                string $ytLink,string $fanpageLink,string $bandDescription)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->scheduleLink = $scheduleLink;
        $this->ytLink = $ytLink;
        $this->fanpageLink = $fanpageLink;
        $this->bandDescription = $bandDescription;
        $this->numberLikes=0;
    }


    public function getUsername(): string
    {
        return $this->username;
    }


    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    public function getScheduleLink(): string
    {
        return $this->scheduleLink;
    }


    public function setScheduleLink(string $scheduleLink): void
    {
        $this->scheduleLink = $scheduleLink;
    }


    public function getYtLink(): string
    {
        return $this->ytLink;
    }


    public function setYtLink(string $ytLink): void
    {
        $this->ytLink = $ytLink;
    }

    public function getFanpageLink(): string
    {
        return $this->fanpageLink;
    }


    public function setFanpageLink(string $fanpageLink): void
    {
        $this->fanpageLink = $fanpageLink;
    }


    public function getBandDescription(): string
    {
        return $this->bandDescription;
    }


    public function setBandDescription(string $bandDescription): void
    {
        $this->bandDescription = $bandDescription;
    }


    public function getNumberLikes(): int
    {
        return $this->numberLikes;
    }


    public function setNumberLikes(int $numberLikes): void
    {
        $this->numberLikes = $numberLikes;
    }






}