<?php

namespace App\Controller;

use App\Entity\Email;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;

// References:
// https://symfony.com/doc/current/components/asset.html
// https://symfonycasts.com/screencast/symfony/assets
// https://www.devmedia.com.br/enviando-email-com-php/37216
// https://www.w3schools.com/php/func_mail_mail.asp
// https://symfony.com/doc/current/mailer.html
class SiteController extends AbstractController
{
    public function indexAction(Request $request, Swift_Mailer $mailer)
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);

        if($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if($form->isSubmitted() && $form->isValid()) {
                $email = $_POST['email'];
                $first_name = $_POST['name'];

                $message = (new Swift_Message('Hello Email'))
                    ->setFrom('meuemail@provedor.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'confirmation/registration.html.twig',
                            ['name' => $first_name]
                        ),
                        'text/html'
                    );

                $mailer->send($message);
            }
        }

        return $this->render('base.html.twig', [
            'form' => $form->createView()
        ]);
    }
}