<?php

namespace App\Entity;

class Email
{
    protected $email;

    public function getEmail(): String
    {
        return $this->email;
    }

    public function setEmail(String $email): void
    {
        $this->email = $email;
    }
}