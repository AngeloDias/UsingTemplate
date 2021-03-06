<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConfirmationController extends AbstractController
{
    public function confirmRegistering(string $name) {
        return $this->render('confirmation/confirmation.html.twig',
            ['name' => $name]);
    }
}