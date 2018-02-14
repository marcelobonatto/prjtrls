<?php
namespace lib;

class pele
{
    public $id;
    public $nome;
    public $cor;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT corpeleId, corpeleNome, corpeleCor, corpeleAtivo ' .
                  'FROM corespele ' .
                  'ORDER BY corpeleNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $coritem)
                {
                    $obj                = new pele();
                    $this->atribuirValores($obj, $coritem);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    function atribuirValores($obj, $cor)
    {
        $obj->id            = $cor['corpeleId'];
        $obj->nome          = $cor['corpeleNome'];
        $obj->cor           = $cor['corpeleCor'];
        $obj->ativo         = $cor['corpeleAtivo'];
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE corespele ' .
                  "SET corpeleAtivo = $modo " .
                  "WHERE corpeleId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>