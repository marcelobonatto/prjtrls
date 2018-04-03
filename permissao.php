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
    $loginMoodle      = '';
    $email       = '';
    $ano  = 0;   
    $escola       = '*';
    $matricula  = 0;
    $ativo      = 1;
}
else
{
    $id = $_GET['id'];

    $aluno  = new lib\permissao();
    $aluno->Selecionar($id);
    
    $txtid      = $id;
    $nome       = $aluno->nome;
    $loginMoodle      = $aluno->loginMoodle;
    $email       = $aluno->email;
    $ano  = $aluno->ano;    
    $escola       = $aluno->escola;
    $matricula  = $aluno->matricula;
    $ativo      = $aluno->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de ALUNO - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmAluno" method="post" action="aluno.php">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
            </div>
            <div class="form-group">
                <label for="txtId">Matrícula:</label>
                <input class="form-control col-sm-4" type="text" value="<?php echo($matricula); ?>" id="txtMatricula" name="txtMatricula" required />
            </div>            
            <div class="form-group">
                <label for="txtLoginMoodle">LoginMoodle:</label>
                <input class="form-control" type="text" value="<?php echo($loginMoodle); ?>" id="txtLoginMoodle" name="txtLoginMoodle" required />
            </div>
            <div class="form-group">
                <label for="txtE-mail">E-mail:</label>
                <input class="form-control" type="email" value="<?php echo($email); ?>" id="txtEmail" name="txtEmail" required />
            </div>
            <div class="form-group">
                <label for="txtId">Série:</label>
                <input class="form-control col-sm-4" type="number" value="<?php echo($ano); ?>" id="txtAno" name="txtAno" min="1" max="3" required />
            </div>             
            <div class="form-group">
                <label for="txtEscola">Escola:</label>
                <?php
                $seltxt         = ' selected="selected"';
                $selecionado    = ($escola == "*");

                if ($selecionado)
                {
                    $seltxtef   = $seltxt;
                }
                else
                {
                    $seltxtef   = '';
                }
                
                $opcoes = "<option value=\"*\"$seltxtef>Todos</option>";

                $escolaobj  = new lib\escola();
                $escolas    = $escolaobj->ListarRegistros(1);

                foreach ($escolas as $escolaitem)
                {
                    $selecionado    = ($escola == $escolaitem->id);
                    
                    if ($selecionado)
                    {
                        $seltxtef   = $seltxt;
                    }
                    else
                    {
                        $seltxtef   = '';
                    }

                    $opcoes .= "<option value=\"$escolaitem->id\"$seltxtef>$escolaitem->nome</option>";
                }
                ?>
                <select class="form-control col-sm-3" id="cmbEscola" name="cmbEscola">                    
                    <?php echo($opcoes); ?>
                </select>
            </div>
            <?php
            echo(controles\botaoativo::Gerar('Ativo', $ativo, 'Ativo', 'Sim', 'Sim', 'Nao', 'Não'));
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