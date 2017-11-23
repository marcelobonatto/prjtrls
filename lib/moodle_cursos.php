<?php
class moodle_cursos
{
    const ENDERECO      = 'http://localhost/moodle/';
    const TOKEN         = 'd799f165d712e0ff700d64e0f9ab2615'; //celepar
    //const TOKEN         = '6d545b9f02e20a1e81c91e5b7c40fa92'; //notebook
    const FUNCAO        = 'core_course_get_courses_by_field';
    const CATEGORIA     = 2;

    public $id;
    public $fullname;
    public $displayname;
    public $shortname;
    public $categoryid;
    public $categoryname;
    public $sortorder;

    public function Obter()
    {
        $url            = self::ENDERECO . 'webservice/rest/server.php';

        $curl           = curl_init($url);
        $curl_params    = array('wstoken' => self::TOKEN, 'wsfunction' => self::FUNCAO,
                                'field' => 'category', 'value' => self::CATEGORIA
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
            $dom = new domDocument();
            $dom->loadXML($curl_response, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

            $s = simplexml_import_dom($dom);

            foreach ($s->SINGLE->KEY[0]->MULTIPLE->SINGLE as $mcursos)
            {
                $arrcursos[]    = new moodle_cursos();
                $poscurso       = count($arrcursos) - 1;

                foreach($mcursos->KEY as $chaves)
                {
                    $campo                          = $chaves['name'];

                    if (property_exists('moodle_cursos', $campo))
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