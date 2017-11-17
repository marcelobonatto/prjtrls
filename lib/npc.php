<?php
class npc
{
    const NPC_ID        = 0;
    const NPC_NOME      = 1;
    const NPC_CHAVE     = 2;
    const EIXO_ID       = 3;
    const EIXO_NOME     = 4;
    const NPC_IMGNORMAL = 5;
    const NPC_IMGICONE  = 6;
    const NPC_ATIVO     = 7;

    public $id;
    public $nome;
    public $chave;
    public $eixo;
    public $eixoNome;
    public $imagemNormal;
    public $icone;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT npcId, npcNome, npcChave, n.eixoId, eixoNome, npcImgNormal, npcImgIcone, npcAtivo ' .
                  'FROM npc n ' .
                  'LEFT JOIN eixos e ON e.eixoId = n.eixoId ' .
                  'ORDER BY npcNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                foreach ($res as $npc)
                {
                    $obj                = new npc();
                    $obj->id            = $npc[self::NPC_ID];
                    $obj->nome          = $npc[self::NPC_NOME];
                    $obj->chave         = $npc[self::NPC_CHAVE];
                    $obj->eixo          = $npc[self::EIXO_ID];
                    $obj->eixoNome      = $npc[self::EIXO_NOME];
                    $obj->imagemNormal  = $npc[self::NPC_IMGNORMAL];
                    $obj->icone         = $npc[self::NPC_IMGICONE];
                    $obj->ativo         = $npc[self::NPC_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }
}
?>