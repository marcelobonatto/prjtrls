<?php
/*
    http://www.eadsesipr.org.br/ead/webservice/rest/server.php?
                                                    moodlewsrestformat=json                     -> retorno via JSON
                                                    &wstoken=ba489802513fef20f03b052ba2476d3e   -> token
                                                    &wsfunction=core_user_get_users_by_field    -> função de busca usuário por campo
                                                    &field=username                             -> campo a buscar. como sabemos que o CPF é o usuário, então usaremos username
                                                    &values[0]=64725681385                      -> valores. sempre será um array e permite buscar vários.
*/
namespace lib\moodle;

class moodle_usuario
{
    public function Obter()
    {
        $contarq        = file_get_contents(realpath('dados/config.json'));
        $json           = json_decode($contarq);

        $url            = $json->moodle->endereco . 'webservice/rest/server.php';

        $curl           = curl_init($url);
        $curl_params    = array('wstoken' => $json->moodle->token, 'wsfunction' => $json->moodle->missoes->funcao,
                                'field' => 'category', 'value' => $json->moodle->missoes->categoria
                               );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_params);

        $curl_response = curl_exec($curl);

        if ($curl_response === false)
        {
            $info   = curl_getinfo($curl);
            curl_close($curl);
            die('Hummm, acho que alguma coisa deu errado. Vamos ver? ' . var_export($info));
        }

        curl_close($curl);
    }
}
?>