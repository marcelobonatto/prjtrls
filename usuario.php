<?php
include_once('autoload.php');

use lib\usuario;

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
    $nomeusu    = '';
    $senhausu   = '';
    $ativousu   = 1;
    $email      = '';

    $aparecer   = 'd-none';
    $aparecer2  = 'd-none';
}
else
{
    $id         = $_GET['id'];

    $usuario    = new usuario();
    $usuario->Selecionar($id);
    
    $txtid      = $id;
    $nomeusu    = $usuario->nome;
    $senhausu   = '';
    $ativousu   = $usuario->ativo;
    $email      = $usuario->email;

    $aparecer   = 'd-block';
    $aparecer2  = '';
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Usuario - <?php echo(($id != 'novo' ? $nomeusu : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmUsuario" method="post" action="usuario.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nomeusu); ?>" id="txtNome" name="txtShrek" required autocomplete="off" />
            </div>
            <div class="form-group">
                <label for="txtEmail">E-mail:</label>
                <input class="form-control" type="email" value="<?php echo($email); ?>" id="txtEmail" name="txtEmail" required autocomplete="off" />
            </div>
            <br class="<?php echo($aparecer2); ?>" />
            <button id="enviarEmail" type="button" class="btn btn-info <?php echo($aparecer); ?>">
                Enviar e-mail para troca de senha
            </button>
            <br class="<?php echo($aparecer2); ?>" />
            <div class="form-group">
                <label>Ativo:</label>
                <br />
                <?php 
                if ($ativousu == 1)
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
            <button id="cmdGravar" class="btn btn-info">
                Gravar
            </button>
            <button id="cmdVoltar" type="button" class="btn btn-danger">
                Voltar
            </button>
        </form>
    </div>
<?php
$js[]   = 'js/usuario.js';
include('footer.php');
?>