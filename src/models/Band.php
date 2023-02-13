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
    private $id;
    private $numberLikes;


    public function __construct(string $username, string $email,string $password,string $scheduleLink,string $ytLink,string $fanpageLink, string $bandDescription,
    int $id, int $numberLikes)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->scheduleLink = $scheduleLink;
        $this->ytLink = $ytLink;
        $this->fanpageLink = $fanpageLink;
        $this->bandDescription=$bandDescription;
        $this->id=$id;
        $this->numberLikes->$numberLikes;
    }

    public function getUsername(): string
    {
        return $this->username;
    }


    public function getBandDescription(): string
    {
        return $this->bandDescription;
    }


    public function setBandDescription(string $bandDescription): void
    {
        $this->bandDescription = $bandDescription;
    }


    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getNumberLikes()
    {
        return $this->numberLikes;
    }


    public function setNumberLikes($numberLikes): void
    {
        $this->numberLikes = $numberLikes;
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




}