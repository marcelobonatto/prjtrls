<?php
class dialogonpc
{
    const DIALOGO_ID        = 0;
    const MISSAO_ID         = 1;
    const DIALOGO_SEQUENCIA = 2;
    const NPC_ID            = 3;
    const DIALOGO_TEXTO     = 4;
    
    public $id;
    public $missao;
    public $sequencia;
    public $npc;
    public $humor;
    public $texto;

    public function ListarPorMissao($missao)
    {
        $matriz = array();

        $sql    = 'SELECT dialogoId, missaoId, dialogoSequencia, npcId, dialogoTexto ' .
                  'FROM dialogosnpc ' .
                  "WHERE missaoId = '$missao' " .
                  'ORDER BY dialogoSequencia';
        
        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $dialogo)
                {
                    $obj                = new dialogonpc();
                    $obj->id            = $dialogo[self::DIALOGO_ID];
                    $obj->missao        = $dialogo[self::MISSAO_ID];
                    $obj->sequencia     = $dialogo[self::DIALOGO_SEQUENCIA];
                    $obj->npc           = $dialogo[self::NPC_ID];
                    $obj->texto         = $dialogo[self::DIALOGO_TEXTO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>