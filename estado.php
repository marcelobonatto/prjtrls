<?php
include_once('autoload.php');

use lib\estado;

if ($_GET['id']=='novo')
{
    $getid      = 'novo';
}
else
{
    $getid      = $_GET['id'];
}

if ($getid == 'novo')
{
    echo 'NOVO';
    $sigla      = '';
    $nome       = '';
}
else
{
    echo 'NAO novo';

    $id = $_GET['id'];
    $getid = $id;

    $estado  = new estado();
    $estado->Selecionar($id);
    
    $sigla      = $estado->id;
    $nome       = $estado->nome;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Estado - <?php echo(($sigla != '' ? $sigla : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmEstado" method="post" action="estado.php">
            <input class="form-control" type="hidden" value="<?php echo($getid); ?>" id="hdId" name="hdId" />
            <div class="form-group">
                <label for="txtSigla">Sigla:</label>
                <input class="form-control" type="text" value="<?php echo($sigla); ?>" id="txtSigla" name="txtSigla" required />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
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
$js[]   = 'js/estado.js';
include('footer.php');
?>