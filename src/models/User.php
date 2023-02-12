<?php

class User
{
    private $username;
    private $email;
    private $password;


    public function __construct( string $username, string $email, string $password, int $permissions)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->permissions=$permissions;
    }

    public function getEmial(): string
    {
        return $this->emial;
    }


    public function setEmial(string $email): void
    {
        $this->email = $email;
    }


    public function getUsername(): string
    {
        return $this->username;
    }


    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email): void
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


    public function getPermissions(): int
    {
        return $this->permisions;
    }


    public function setPermissions(int $permissions): void
    {
        $this->permisions = $permissions;
    }






}