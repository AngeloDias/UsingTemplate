<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// References:
// https://symfony.com/doc/current/components/asset.html
class SiteController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('base.html.twig');
    }
}