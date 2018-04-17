<?php
namespace lib\moodle;

class moodle_cursos
{
    public $id;
    public $fullname;
    public $displayname;
    public $shortname;
    public $categoryid;
    public $categoryname;
    public $sortorder;

    public function ListarCombo()
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

        $arrcursos  = array();

        if (substr($curl_response, 0, 2) == '<?' && strpos($curl_response, 'xml') !== FALSE)
        {
            $dom = new \domDocument();
            $dom->loadXML($curl_response, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

            $s = simplexml_import_dom($dom);

            foreach ($s->SINGLE->KEY[0]->MULTIPLE->SINGLE as $mcursos)
            {
                $arrcursos[]    = new moodle_cursos();
                $poscurso       = count($arrcursos) - 1;

                foreach($mcursos->KEY as $chaves)
                {
                    $campo                          = $chaves['name'];

                    if (property_exists('lib\\moodle\\moodle_cursos', $campo))
                    {
                        $arrcursos[$poscurso]->$campo   = $chaves->VALUE;
                    }
                }
            }
        }

        return $arrcursos;
    }
}
?>