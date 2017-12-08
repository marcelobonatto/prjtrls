<?php
namespace lib;

class dialogonpc
{
    const DIALOGO_ID        = 0;
    const MISSAO_ID         = 1;
    const DIALOGO_SEQUENCIA = 2;
    const NPC_ID            = 3;
    const DIALOGO_HUMOR     = 4;
    const DIALOGO_TEXTO     = 5;
    
    public $id;
    public $missao;
    public $sequencia;
    public $npc;
    public $chave;
    public $humor;
    public $texto;

    public function ListarPorMissao($missao)
    {
        $matriz = array();

        $sql    = 'SELECT dialogoId, missaoId, dialogoSequencia, n.npcId, n.npcChave, dialogoHumor, dialogoTexto ' .
                  'FROM dialogosnpc dn ' .
                  'JOIN npc n ON n.npcId = dn.npcId ' .
                  "WHERE missaoId = '$missao' " .
                  'ORDER BY dialogoSequencia';
        
        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $dialogo)
                {
                    $obj                = new dialogonpc();
                    $obj->id            = $dialogo['dialogoId'];
                    $obj->missao        = $dialogo['missaoId'];
                    $obj->sequencia     = $dialogo['dialogoSequencia'];
                    $obj->npc           = $dialogo['npcId'];
                    $obj->chave         = $dialogo['npcChave'];
                    $obj->humor         = $dialogo['dialogoHumor'];
                    $obj->texto         = $dialogo['dialogoTexto'];

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id = '{ID}';
        }
        else
        {
            $id = $this->id;
        }

        if ($id == '{ID}')
        {
            return $this->Incluir($id);
        }
        else if ($this->npc !== '')
        {
            return $this->Atualizar($id);
        }
        else
        {
            return $this->Excluir($id);
        }
    }

    public function Incluir($id)
    {
        $sql    = 'INSERT INTO dialogosnpc ' .
                  '(dialogoId, missaoId, dialogoSequencia, npcId, dialogoHumor, dialogoTexto) ' .
                  "VALUES ('$id', '$this->missao', '$this->sequencia', '$this->npc', '$this->humor', '$this->texto')";

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

    public function Atualizar($id)
    {
        $sql    = 'UPDATE dialogosnpc ' .
                  "SET missaoId = '$this->missao', " .
                  "dialogoSequencia = '$this->sequencia', " .
                  "npcId = '$this->npc', " .
                  "dialogoHumor = '$this->humor', " .
                  "dialogoTexto = '$this->texto' " .
                  "WHERE dialogoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Excluir($id)
    {
        $sql        = "DELETE FROM dialogosnpc WHERE dialogoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>