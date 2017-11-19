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

    public function Selecionar($id)
    {
        $sql    = "SELECT npcId, npcNome, npcChave, n.eixoId, eixoNome, npcImgNormal, npcImgIcone, npcAtivo " .
                  'FROM npc n ' .
                  'LEFT JOIN eixos e ON e.eixoId = n.eixoId ' .
                  "WHERE npcId = '$id' " .
                  'ORDER BY npcNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $npc   = $res[0];

                $this->id                    = $npc[self::NPC_ID];
                $this->nome                  = $npc[self::NPC_NOME];
                $this->chave                 = $npc[self::NPC_CHAVE];
                $this->eixo                  = $npc[self::EIXO_ID];
                $this->eixoNome              = $npc[self::EIXO_NOME];
                $this->imagemNormal          = $npc[self::NPC_IMGNORMAL];
                $this->icone                 = $npc[self::NPC_IMGICONE];
                $this->ativo                 = $npc[self::NPC_ATIVO];
            }
        }
    }

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id     = '{ID}';
        }
        else
        {
            $id     = $this->id;
        }

        if ($this->eixo == '*')
        {
            $eixo   = 'NULL';
        }
        else
        {
            $eixo   = "'$this->eixo'";
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $eixo);
        }
        else
        {
            return $this->Atualizar($id, $eixo);
        }
    }

    public function Incluir($id, $eixo)
    {
        $sql    = 'INSERT INTO npc ' .
                  '(npcId, npcNome, npcChave, eixoId, npcImgNormal, npcImgIcone, npcAtivo) ' . 
                  "VALUES ('$id', '$this->nome', '$this->chave', $eixo, $this->imagemNormal, $this->icone, $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Atualizar($id, $eixo)
    {
        $sql    = 'UPDATE npc ' .
                  "SET npcNome = '$this->nome', " .
                  "npcChave = '$this->chave', " .
                  "eixoId = $eixo, " .
                  "npcImgNormal = $this->imagemNormal, " .
                  "npcImgIcone = $this->icone, " .
                  "npcAtivo = $this->ativo " .
                  "WHERE npcId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir()
    {
        $sql    = 'UPDATE npc ' .
                  "SET npcAtivo = 0 " .
                  "WHERE npcId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }    
}
?>