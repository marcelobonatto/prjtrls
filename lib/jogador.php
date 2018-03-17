<?php
namespace lib;

class jogador
{
    public $id;
    public $dinheiro;
    public $pontos;
    public $cabelo;
    public $pele;
    public $sexo;
    public $ano;
    public $eixos;
    public $missoes;
    public $diabonus;
    public $databonus;
    public $tickets;

    public function Selecionar($id)
    {
        $sql    = 'SELECT alunoId, jogadorDinheiro, jogadorPontuacao, corcabeloId, corpeleId, jogadorSexo, jogadorAno, jogadorDiaBonus, ' .
                  'jogadorDataBonus, jogadorTicketQuiz ' .
                  'FROM jogadores ' .
                  "WHERE alunoId = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecaoAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $jogador        = $res[0];

                $this->id               = $jogador["alunoId"];
                $this->dinheiro         = $jogador["jogadorDinheiro"];
                $this->pontos           = $jogador["jogadorPontuacao"];
                $this->cabelo           = $jogador["corcabeloId"];
                $this->pele             = $jogador["corpeleId"];
                $this->sexo             = $jogador["jogadorSexo"];
                $this->ano              = $jogador["jogadorAno"];
                $this->diabonus         = $jogador["jogadorDiaBonus"];
                $this->databonus        = $jogador["jogadorDataBonus"];
                $this->tickets          = $jogador["jogadorTicketQuiz"];
            }
        }
    }

    public function Salvar($incluir)
    {
        if ($this->cabelo == null)
        {
            $cabelo = 'NULL';
        }
        else 
        {
            $cabelo = "'$this->cabelo'";
        }

        if ($this->pele == null)
        {
            $pele = 'NULL';
        }
        else 
        {
            $pele = "'$this->pele'";
        }

        if ($incluir)
        {
            return $this->Incluir($cabelo, $pele);
        }
        else
        {
            return $this->Atualizar($cabelo, $pele);
        }
    }

    public function Incluir($cabelo, $pele)
    {
        $sql    = 'INSERT INTO jogadores ' .
                  '(alunoId, jogadorDinheiro, jogadorPontuacao, corcabeloId, corpeleId, jogadorSexo, jogadorAno, jogadorDiaBonus, ' .
                  'jogadorDataBonus, jogadorTicketQuiz) ' . 
                  "VALUES ('$this->id', $this->dinheiro, $this->pontos, $cabelo, $pele, $this->sexo, $this->ano, $this->diabonus, " .
                  "NOW(), $this->tickets)";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public function Atualizar($cabelo, $pele)
    {
        $sql    = 'UPDATE jogadores ' .
                  "SET jogadorDinheiro = $this->dinheiro, " .
                  "jogadorPontuacao = $this->pontos, " .
                  "corcabeloId = $cabelo, " .
                  "corpeleId = $pele, " .
                  "jogadorSexo = $this->sexo, " .
                  "jogadorAno = $this->ano, " .
                  "jogadorDiaBonus = $this->diabonus, " .
                  "jogadorDataBonus = '$this->databonus', " .
                  "jogadorTicketQuiz = $this->tickets " .
                  "WHERE alunoId = '$this->id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>