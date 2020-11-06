<?php

namespace App\Entity;

class Email
{
    protected $email;
    protected $first_name;

    public function getEmail(): String
    {
        return $this->email;
    }

    public function setEmail(String $email): void
    {
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }
}