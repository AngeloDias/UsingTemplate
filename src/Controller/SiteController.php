<?php

namespace App\Controller;

use App\Entity\Email;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;

//require dirname(__DIR__).'/vendor/autoload.php';

// References:
// https://symfony.com/doc/current/components/asset.html
// https://symfonycasts.com/screencast/symfony/assets
// https://www.devmedia.com.br/enviando-email-com-php/37216
// https://www.w3schools.com/php/func_mail_mail.asp
// https://symfony.com/doc/current/mailer.html
class SiteController extends AbstractController
{
    private function getCredentials()
    {
//        $sender_credentials_path = (new Dotenv())->bootEnv(dirname(__DIR__).'/.senderCredentials');
//
//        file_get_contents($sender_credentials_path);
    }

    public function indexAction(Request $request, Swift_Mailer $mailer)
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);

        if($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if($form->isSubmitted() && $form->isValid()) {
                $email->setEmail($_POST['email']);
                $email->setFirstName($_POST['name']);
                $swift_message = new Swift_Message('Hello Email');

                $message = ($swift_message)
                    ->setFrom('angelossdias@gmail.com')
                    ->setTo($email->getEmail())
                    ->setBody(
                        $this->renderView(
                            'confirmation/registration.html.twig',
                            ['name' => $email->getFirstName()]
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