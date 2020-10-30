<?php

namespace App\Controller;

use App\Entity\Email;
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
    public function indexAction(Request $request)
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);

        if($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if($form->isSubmitted() && $form->isValid()) {
                $email = $form->getData();

//                $nome = $_POST['nome'];
//                $email = $_POST['email'];

                // É necessário indicar que o formato do e-mail é html
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Ângelo de Sant\'Ana <assd@cin.ufpe.br>';
                //$headers .= "Bcc: $EmailPadrao\r\n";

                $destino = $email;
                $assunto = "Confirmação de contato";
                $mensagem = "
                    <html>
                        Olá, $ nome. Esse e-mail é para confirmar que foi você quem mandou seu contato para mim. Se não foi você, pode ignorar.
                        Para confirmar basta clicar no link.
                    </html>
                    ";

                $enviar_email = mail($destino, $assunto, $mensagem, $headers);

                if($enviar_email){
                    $mgm = "E-mail enviado com sucesso! <br> O link será enviado para o e-mail fornecido no formulário";
                    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
                } else {
                    $mgm = "ERRO AO ENVIAR E-MAIL!";
                    echo "";
                }
            }
        }

        return $this->render('base.html.twig', [
            'form' => $form->createView()
        ]);
    }
}