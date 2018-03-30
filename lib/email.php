<?php
namespace lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class email
{
    public static function Enviar($email, $nome, $ehtml, $titulo, $corpohtml, $corpo)
    {       
        $mail               = new PHPMailer(true);
        
        try 
        {
            $contarq            = file_get_contents(realpath('../dados/config.json'));
            $json               = json_decode($contarq);

            $mail->SMTPDebug    = 0;
            $mail->isSMTP();
            $mail->Host         = $json->email->host;
            $mail->SMTPAuth     = $json->email->autenticacao;
            $mail->Username     = $json->email->usuario;
            $mail->Password     = $json->email->senha;
            $mail->Port         = $json->email->porta;

            if ($json->email->usassl)
            {
                $mail->SMTPSecure   = 'tsl';
                $mail->SMTPOptions = array(
                                            'ssl' => array(
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                            )
                                        );
            }
        
            $mail->setFrom($json->email->usuario, $json->email->nome);
            $mail->addAddress($email, $nome);
        
            $mail->isHTML($ehtml);
            $mail->Subject      = $titulo;
            $mail->Body         = $corpohtml;
            $mail->AltBody      = $corpo;
        
            $mail->send();

            return '';
        } 
        catch (Exception $e)
        {
            return $mail->ErrorInfo;
        }
    }
}
?>