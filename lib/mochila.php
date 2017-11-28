<?php
namespace lib;

class mochila
{
    const ITEMMOCHILA_ID            = 0;
    const ALUNO_ID                  = 1;
    const ITEM_ID                   = 2;
    const ITEMMOCHILA_SELECIONADO   = 3;

    public $id;
    public $aluno;
    public $item;
    public $selecionado;

    public function ListarPorAluno($aluno)
    {
        $matriz = array();
        
        $sql    = 'SELECT itemmochilaId, alunoId, itemId, itemmochilaSelecionado ' .
                  'FROM itensmochila ' .
                  "WHERE alunoId = '$aluno'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $mochila)
                {
                    $obj                    = new mochila();
                    $obj->id                = $mochila[self::ITEMMOCHILA_ID];
                    $obj->aluno             = $mochila[self::ALUNO_ID];
                    $obj->item              = $mochila[self::ITEM_ID];
                    $obj->selecionado       = $mochila[self::ITEMMOCHILA_SELECIONADO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>