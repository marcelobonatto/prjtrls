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