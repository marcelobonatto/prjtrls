<?php
namespace lib;

class cabelo
{
    public $id;
    public $nome;
    public $cor;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = 'SELECT corcabeloId, corcabeloNome, corcabeloCor, corcabeloAtivo ' .
                  'FROM corescabelo ' .
                  'ORDER BY corcabeloNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $coritem)
                {
                    $obj                = new cabelo();
                    $this->atribuirValores($obj, $coritem);
                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    function atribuirValores($obj, $cor)
    {
        $obj->id            = $cor['corcabeloId'];
        $obj->nome          = $cor['corcabeloNome'];
        $obj->cor           = $cor['corcabeloCor'];
        $obj->ativo         = $cor['corcabeloAtivo'];
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE corescabelo ' .
                  "SET corcabeloAtivo = $modo " .
                  "WHERE corcabeloId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>