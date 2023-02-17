<?php

class User
{
    private $username;
    private $email;
    private $password;
    private $role;


    public function __construct( string $username, string $email, string $password, int $role=0)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role=$role;
    }


    public function getRole(): int
    {
        return $this->role;
    }


    public function setRole(int $role): void
    {
        $this->role = $role;
    }



    public function getUsername()
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


}