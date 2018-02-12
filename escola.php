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
    $id         = 'novo';

    $txtid      = '';
    $nome       = '';
    $bairro      = '';
    $estado       = '*';
    $cidade  = '*';
    $ativo      = 1;
}
else
{
    $id = $_GET['id'];

    $escola  = new lib\escola();
    $escola->Selecionar($id);
    
    $txtid      = $id;
    $nome       = $escola->nome;
    $bairro      = $escola->bairro;
    $estado       = $escola->estado;
    $cidade  = $escola->cidade;
    $ativo      = $escola->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de ESCOLA - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmEscola" method="post" action="escola.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
            </div>
                <div class="form-group">
                <label for="txtBairro">Bairro:</label>
                <input class="form-control" type="text" value="<?php echo($bairro); ?>" id="txtBairro" name="txtBairro" required />
            </div>
            <div class="form-group">
                <label for="cmbEstado">Estado:</label>
                <?php
                $seltxt         = ' selected="selected"';
                $selecionado    = ($estado == "*");

                if ($selecionado)
                {
                    $seltxtef   = $seltxt;
                }
                else
                {
                    $seltxtef   = '';
                }
                
                $opcoes = "<option value=\"*\"$seltxtef>(Selecione)</option>";

                $estadoobj  = new lib\estado();
                $estados    = $estadoobj->ListarRegistros(1);

                foreach ($estados as $estadoitem)
                {
                    $selecionado    = ($estado == $estadoitem->sigla);
                    
                    if ($selecionado)
                    {
                        $seltxtef   = $seltxt;
                    }
                    else
                    {
                        $seltxtef   = '';
                    }

                    $opcoes .= "<option value=\"$estadoitem->sigla\"$seltxtef>$estadoitem->nome</option>";
                }
                ?>
                <select class="form-control col-sm-3" id="cmbEstado" name="cmbEstado" required>                    
                    <?php echo($opcoes); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cmbCidade">Cidade:</label>
                <?php
                $seltxt         = ' selected="selected"';
                $selecionado    = ($cidade == "*");

                if ($selecionado)
                {
                    $seltxtef   = $seltxt;
                }
                else
                {
                    $seltxtef   = '';
                }
                
                $opcoes = "<option value=\"*\"$seltxtef>(Selecione)</option>";

                $cidadeobj  = new lib\cidade();
                $cidades    = $cidadeobj->ListarPorEstado($estado);

                foreach ($cidades as $cidadeitem)
                {
                    $selecionado    = ($cidade == $cidadeitem->id);
                    
                    if ($selecionado)
                    {
                        $seltxtef   = $seltxt;
                    }
                    else
                    {
                        $seltxtef   = '';
                    }

                    $opcoes .= "<option value=\"$cidadeitem->id\"$seltxtef>$cidadeitem->nome</option>";
                }
                ?>
                <select class="form-control col-sm-3" id="cmbCidade" name="cmbCidade" required>                    
                    <?php echo($opcoes); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Ativo:</label>
                <br />
                <?php 
                if ($ativo == 1)
                {
                    $ativo1 = ' active';
                    $check1 = ' checked';
                    $ativo0 = '';
                    $check0 = '';
                }
                else
                {
                    $ativo1 = '';
                    $check1 = '';
                    $ativo0 = ' active';
                    $check0 = ' checked';
                }
                ?>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success<?php echo($ativo1); ?>">
                        <input type="radio" name="optAtivo" id="optSim" autocomplete="off" value="1"<?php echo($check1); ?>> Sim
                    </label>
                    <label class="btn btn-secondary<?php echo($ativo0); ?>">
                        <input type="radio" name="optAtivo" id="optNao" autocomplete="off" value="0"<?php echo($check0); ?>> Não
                    </label>
                </div>
            </div>
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
$js[]   = 'js/escola.js';
include('footer.php');
?>