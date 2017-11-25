<?php
include_once('autoload.php');

use lib\item;

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
    $nivel      = 1;
    $eixo       = '*';
    $bonus      = 0;
    $preco      = 0;
    $ativo      = 1;
}
else
{
    $id = $_GET['id'];

    $item  = new item();
    $item->Selecionar($id);
    
    $txtid      = $id;
    $nome       = $item->nome;
    $nivel      = $item->nivel;
    $eixo       = $item->eixo;
    $bonus      = $item->bonus;
    $preco      = $item->preconormal;
    $ativo      = $item->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Item - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmItem" method="post" action="item.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
            </div>
            <div class="form-group">
                <label for="txtNivel">Nível:</label>
                <input class="form-control col-sm-2" type="number" value="<?php echo($nivel); ?>" id="txtNivel" name="txtNivel" value="1" min="1" max="30" required />
            </div>
            <div class="form-group">
                <label for="txtEixo">Eixo:</label>
                <?php
                $seltxt         = ' selected="selected"';
                $selecionado    = ($eixo == "*");

                if ($selecionado)
                {
                    $seltxtef   = $seltxt;
                }
                else
                {
                    $seltxtef   = '';
                }
                
                $opcoes = "<option value=\"*\"$seltxtef>Todos</option>";

                $eixoobj  = new lib\eixo();
                $eixos    = $eixoobj->ListarRegistros(1);

                foreach ($eixos as $eixoitem)
                {
                    $selecionado    = ($eixo == $eixoitem->id);
                    
                    if ($selecionado)
                    {
                        $seltxtef   = $seltxt;
                    }
                    else
                    {
                        $seltxtef   = '';
                    }

                    $opcoes .= "<option value=\"$eixoitem->id\"$seltxtef>$eixoitem->nome</option>";
                }
                ?>
                <select class="form-control col-sm-3" id="cmbEixo" name="cmbEixo">                    
                    <?php echo($opcoes); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="txtBonus">Bônus (%):</label>
                <input class="form-control col-sm-2" type="number" value="<?php echo($bonus); ?>" id="txtBonus" name="txtBonus" value="0" min="0" max="100" required />
            </div>
            <div class="form-group">
                <label for="txtPreco">Preço:</label>
                <input class="form-control col-sm-3" type="number" value="<?php echo($preco); ?>" id="txtPreco" name="txtPreco" value="0" min="0" max="10000" step="10" required />
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
$js[]   = 'js/item.js';
include('footer.php');
?>