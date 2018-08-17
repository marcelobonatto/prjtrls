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

    $aluno  = new lib\aluno();
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
            <?php
            controles\campotexto::Gerar('C&oacute;digo Interno', 'Id', $txtid, 4, true);
            controles\campotexto::GerarRequerido('Nome', 'Nome', $nome, 12, false);
            controles\campotexto::GerarRequerido('Matrícula', 'Matricula', $matricula, 2, false);
            controles\campotexto::GerarRequerido('Login Moodle', 'LoginMoodle', $loginMoodle, 12, false);
            controles\campoemail::GerarRequerido('E-mail', 'Email', $email, 12, false);
            controles\camponumero::GerarRequerido('S&eacute;rie', 'Ano', $ano, 1, false, 1, 3);
            controles\comboexterno::Gerar('Escola', 'Escola', $escola, 'lib\\escola', 'nome', 'id');
            controles\botaoativo::Gerar('Ativo', $ativo, 'Ativo', 'Sim', 'Sim', 'Nao', 'Não');
            controles\botoescadastro::Gerar();
            ?>
        </form>
    </div>
<?php
$js[]   = 'js/aluno.js';
include('footer.php');
?>