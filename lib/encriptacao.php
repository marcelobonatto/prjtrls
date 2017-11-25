<?php
namespace lib;

class encriptacao
{
    public function encriptar($texto)
    {
        return $this->executar($texto, 'e');
    }

    public function descriptar($texto)
    {
        return $this->executar($texto, 'd');
    }

    function executar($texto, $acao = 'e')
    {
        // you may change these values to your own
        $secret_key = 'TJ745JtKMLgCTD0ruR1HGhYJHqIW8v1r';
        $secret_iv = 'eEyoyCruoSI00ztfnUrfmNO17Gl0wdcb';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
     
        switch ($acao)
        {
            case 'e':
                $output = base64_encode(openssl_encrypt($texto, $encrypt_method, $key, 0, $iv));
                break;
            case 'd':
                $output = openssl_decrypt(base64_decode($texto), $encrypt_method, $key, 0, $iv);
                break;
        }
     
        return $output;
    }
}
?>