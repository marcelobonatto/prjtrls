<?php
namespace lib;

class tela
{
    public $id;
    public $nome;
    public $caminho;
    public $ativo;

    public function ListarRegistros()
    {
        $matriz = array();

        $sql    = "SELECT telaId, telaNome, telaCaminho, telaAtivo " .
                  'FROM telas ' .
                  'ORDER BY telaNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $item)
                {
                    $obj            = new permissao();
                    $obj->id        = $item['telaId'];
                    $obj->nome      = $item['telaNome'];
                    $obj->caminho   = $item['telaCaminho'];
                    $obj->ativo     = $item['telaAtivo'];                

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>