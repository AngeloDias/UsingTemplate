<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

// References:
// https://symfony.com/doc/current/components/asset.html
// https://symfonycasts.com/screencast/symfony/assets
class SiteController extends AbstractController
{
    public function indexAction(Request $request)
    {
        return $this->render('base.html.twig');
    }
}