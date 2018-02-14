<?php
namespace lib;

class npc
{
    const NPC_ID        = 0;
    const NPC_NOME      = 1;
    const NPC_CHAVE     = 2;
    const EIXO_ID       = 3;
    const EIXO_NOME     = 4;
    const EIXO_SIGLA    = 5;
    const NPC_ATIVO     = 6;

    public $id;
    public $nome;
    public $chave;
    public $eixo;
    public $eixoNome;
    public $eixoSigla;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();
        
        $sql    = 'SELECT npcId, npcNome, npcChave, n.eixoId, eixoNome, eixoSigla, npcAtivo ' .
                  'FROM npc n ' .
                  'LEFT JOIN eixos e ON e.eixoId = n.eixoId ' .
                  'ORDER BY npcNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
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
                    $obj->eixoSigla     = $npc[self::EIXO_SIGLA];
                    $obj->ativo         = $npc[self::NPC_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function ListarSemImagens()
    {
        $matriz = array();
        
        $sql    = 'SELECT npcId, npcNome, npcChave, n.eixoId, eixoNome, eixoSigla, npcAtivo ' .
                  'FROM npc n ' .
                  'LEFT JOIN eixos e ON e.eixoId = n.eixoId ' .
                  'ORDER BY npcNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
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
                    $obj->eixoSigla     = $npc[self::EIXO_SIGLA];
                    $obj->ativo         = $npc[self::NPC_ATIVO];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($id)
    {
        $sql    = "SELECT npcId, npcNome, npcChave, n.eixoId, eixoNome, npcAtivo " .
                  'FROM npc n ' .
                  'LEFT JOIN eixos e ON e.eixoId = n.eixoId ' .
                  "WHERE npcId = '$id' " .
                  'ORDER BY npcNome';

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $npc   = $res[0];

                $this->id                    = $npc[self::NPC_ID];
                $this->nome                  = $npc[self::NPC_NOME];
                $this->chave                 = $npc[self::NPC_CHAVE];
                $this->eixo                  = $npc[self::EIXO_ID];
                $this->eixoNome              = $npc[self::EIXO_NOME];
                $this->eixoSigla             = $npc[self::EIXO_SIGLA];
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
                  '(npcId, npcNome, npcChave, eixoId, npcAtivo) ' . 
                  "VALUES ('$id', '$this->nome', '$this->chave', $eixo, $this->ativo)";

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
                  "npcAtivo = $this->ativo " .
                  "WHERE npcId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE npc ' .
                  "SET npcAtivo = $modo " .
                  "WHERE npcId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }    
}
?>