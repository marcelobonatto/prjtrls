<?php
namespace lib;

class permissao
{
    public $id;
    public $nome;
    public $tela;
    public $telaNome;
    public $incluir;
    public $alterar;
    public $excluir;
    public $acessar;
    public $ativo;

    public function ListarRegistros($pagina)
    {
        $matriz = array();

        $sql    = "SELECT p.permissaoId, p.permissaoNome, p.telaId, t.telaNome, p.permissaoIncluir, p.permissaoAlterar, p.permissaoExcluir, p.permissaoAcessar, p.permissaoAtivo  " .
                  'FROM permissoes p ' .
                  'JOIN telas t ON t.telaId = p.telaId ' .
                  'ORDER BY p.permissaoNome';

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                foreach ($res as $item)
                {
                    $obj            = new permissao();
                    $obj->id        = $item['permissaoId'];
                    $obj->nome      = $item['permissaoNome'];
                    $obj->tela      = $item['telaId'];
                    $obj->telaNome  = $item['telaNome'];
                    $obj->incluir   = $item['permissaoIncluir'];
                    $obj->alterar   = $item['permissaoAlterar'];
                    $obj->excluir   = $item['permissaoExcluir'];
                    $obj->acessar   = $item['permissaoAcessar'];
                    $obj->ativo     = $item['permissaoAtivo'];                

                    array_push($matriz, $obj);
                }
            }
        }

        return $matriz;
    }

    public function Selecionar($id)
    {
        $matriz = array();

        $sql    = 'SELECT permissaoId, permissaoNome, telaId, permissaoIncluir, permissaoAlterar, permissaoExcluir, permissaoAcessar, permissaoAtivo  ' .
                  'FROM permissoes ' .
                  "WHERE permissaoId = '$id'";

        $db     = new bancodados();
        $res    = $db->SelecionarAssociativa($sql);

        if ($res !== false)
        {
            if (count($res) > 0)
            {
                $item           = $res[0];

                $this->id       = $item['permissaoId'];
                $this->nome     = $item['permissaoNome'];
                $this->tela     = $item['telaId'];
                $this->incluir  = $item['permissaoIncluir'];
                $this->alterar  = $item['permissaoAlterar'];
                $this->excluir  = $item['permissaoExcluir'];
                $this->acessar  = $item['permissaoAcessar'];
                $this->ativo    = $item['permissaoAtivo'];
            }
        }
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
        else
        {
            return $this->Atualizar($id);
        }
    }
    
    public function Incluir($id)
    {
        $erro   = -1;

        $sql    = 'INSERT INTO permissoes ' .
                  '(permissaoId, permissaoNome, telaId, permissaoIncluir, permissaoAlterar, permissaoExcluir, permissaoAcessar, permissaoAtivo) ' .
                  "VALUES ('$id', '$this->nome', '$this->tela', $this->incluir, $this->alterar, $this->excluir, $this->acessar, $this->ativo)";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id == null)
        {
            $erro   = 1;
        }

        return $erro;
    }

    public function Atualizar($id)
    {
        $sql    = 'UPDATE permissoes ' .
                  "SET permissaoNome = '$this->nome', " .
                  "telaId = '$this->tela', " .
                  "permissaoIncluir = $this->incluir, " .
                  "permissaoAlterar = $this->alterar, " .
                  "permissaoExcluir = $this->excluir, " .
                  "permissaoAcessar = $this->acessar, " .
                  "permissaoAtivo = $this->ativo " .
                  "WHERE permissaoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    public static function Excluir($id, $modo)
    {
        $sql    = 'UPDATE permissoes ' .
                  "SET permissaoAtivo = $modo " .
                  "WHERE permissaoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }
}
?>