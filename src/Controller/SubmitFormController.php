<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// References:
// https://www.devmedia.com.br/enviando-email-com-php/37216
// https://www.w3schools.com/php/func_mail_mail.asp

class SubmitFormController extends AbstractController
{
    public function submit()
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        // É necessário indicar que o formato do e-mail é html
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'From: $nome <$email>';
        //$headers .= "Bcc: $EmailPadrao\r\n";

        $destino = $email;
        $assunto = "Confirmação de contato";
        $mensagem = "
        <html>
            Olá, $nome. Esse e-mail é para confirmar que foi você quem mandou seu contato para mim. Se não foi você, pode ignorar.
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