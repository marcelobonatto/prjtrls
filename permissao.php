<?php
include_once('autoload.php');

if (!isset($_GET['id']))
{
    $getid      = 'novo';
}
else
{
    $getid      = $_GET['id'];
}

if ($getid == 'novo')
{
    $id             = 'novo';

    $txtid          = '';
    $nome           = '';
    $tela           = '';
    $incluir        = 0;
    $alterar        = 0;
    $excluir        = 0;
    $acessar        = 1;
    $ativo          = 1;
}
else
{
    $id             = $_GET['id'];

    $permissao      = new lib\permissao();
    $permissao->Selecionar($id);
    
    $txtid          = $id;
    $nome           = $permissao->nome;
    $tela           = $permissao->tela;
    $incluir        = $permissao->incluir;
    $alterar        = $permissao->alterar;    
    $excluir        = $permissao->excluir;
    $acessar        = $permissao->acessar;
    $ativo          = $permissao->ativo;
}

$telaobj        = new lib\tela();
$telas          = $telaobj->ListarRegistros();

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Permissões - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmPermissao" method="post" action="permissao.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
            </div>
            <div class="form-group">
                <label>Tela:</label>
                <select class="form-control col-sm-3" id="cmbTela" name="cmbTela" required>
                    <option></option>
                    <?php
                    foreach ($telas as $telaitm)
                    {
                        if ($telaitm->id == $tela)
                        {
                            $seltela    = ' selected=\"selected\"';
                        }
                        else
                        {
                            $seltela    = '';
                        }

                        echo("\t\t<option value=\"$telaitm->id\"$seltela>$telaitm->nome</option>\n");
                    }
                    ?>
                </select>
            </div>
            <?php
            echo(controles\botaoativo::Gerar('Incluir', $incluir, 'Incluir', 'Sim', 'Sim', 'Nao', 'Não'));
            echo(controles\botaoativo::Gerar('Alterar', $alterar, 'Alterar', 'Sim', 'Sim', 'Nao', 'Não'));
            echo(controles\botaoativo::Gerar('Excluir', $excluir, 'Excluir', 'Sim', 'Sim', 'Nao', 'Não'));
            echo(controles\botaoativo::Gerar('Acessar', $acessar, 'Acessar', 'Sim', 'Sim', 'Nao', 'Não'));
            echo(controles\botaoativo::Gerar('Ativo',   $ativo,   'Ativo',   'Sim', 'Sim', 'Nao', 'Não'));
            ?>
            <hr />
            <button class="btn btn-info">
                Gravar
            </button>
            <button id="cmdVoltar" type="button" class="btn btn-danger">
                Voltar
            </button>
        </form>
    </div>
<?php
$js[]   = 'js/permissao.js';
include('footer.php');
?>