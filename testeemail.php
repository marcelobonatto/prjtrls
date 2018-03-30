<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//mail("marcelo_bonatto@hotmail.com", "Teste", "Será que mandou?") or die('Ih, deu ruim!!!');

$mail               = new PHPMailer(true);

try 
{
    $mail->SMTPDebug    = 4;
    $mail->isSMTP();
    $mail->Host         = 'mail.nossoricodinheirinho.com.br';
    $mail->SMTPAuth     = true;
    $mail->Username     = 'testes@nossoricodinheirinho.com.br';
    $mail->Password     = 'wd6Wn01~';
/*    $mail->SMTPSecure   = 'tsl';/
    $mail->Port         = 587;
/*    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );/

    $mail->setFrom('testes@nossoricodinheirinho.com.br', 'Teste SESI');
    $mail->addAddress('marcelo_bonatto@hotmail.com', 'Marcelo Bonatto');

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Teste de envio de e-mail para o SESI';
    $mail->Body    = 'Isto é mais de <span style="color: #FF0000">8000</span>!!!';
    $mail->AltBody = 'Isto é mais de 8000!!!';

    $mail->send();
    echo 'Message has been sent';
} 
catch (Exception $e)
{
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
*/
require_once('autoload.php');
require_once('vendor/autoload.php');

lib\email::Enviar('marcelo_bonatto@hotmail.com', 'Marcelo Bonatto', true, 
                  'Teste de envio de e-mail para o SESI', 
                  'Não, é mais de <span style="color: #00FF00">9000</span>!!!', 
                  'Não, é mais de 9000!!!');
?>