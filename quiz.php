<?php
include_once('autoload.php');

/*
id (i.d)
codigo (no.me)
enunciado (login.moodle)
eixo (esco.la)
ativo (ati.vo)
*/

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
    $codigo       = '';
    $enunciado      = '';
    $eixo       = '*';
    $ativo      = 1;
}
else
{
    $id = $_GET['id'];

    $pergunta  = new lib\pergunta();
    $pergunta->Selecionar($id);
    
    $txtid      = $id;
    $codigo       = $pergunta->codigo;
    $enunciado      = $pergunta->enunciado;
    $eixo       = $pergunta->eixo;
    $ativo      = $pergunta->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de QUIZ - <?php echo(($id != 'novo' ? $codigo : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmPergunta" method="post" action="pergunta.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtCodigo">Referência:</label>
                <input class="form-control" type="text" value="<?php echo($codigo); ?>" id="txtCodigo" name="txtCodigo" required />
            </div>       
            <div class="form-group">
                <label for="txtEnunciado">Enunciado:</label>
                <input class="form-control" type="text" value="<?php echo($enunciado); ?>" id="txtEnunciado" name="txtEnunciado" required />
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
$js[]   = 'js/quiz.js';
include('footer.php');
?>