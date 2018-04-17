<?php
include_once('autoload.php');

use lib\cidade;

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
    $estado     = '';
    $ativo      = 1;
}
else
{
    $id         = $_GET['id'];

    $cidade     = new cidade();
    $cidade->Selecionar($id);
    
    $txtid      = $id;
    $nome       = $cidade->nome;
    $estado     = $cidade->estado;
    $ativo      = $cidade->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Cidade - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmCidade" method="post" action="cidade.php">
            <input type="hidden" id="novo" value="<?php echo($id); ?>" />
            <?php
            controles\campotexto::Gerar('C&oacute;digo IBGE', 'id', $txtid, 2, ($txtid !== ''), true);
            controles\campotexto::Gerar('Nome', 'nome', $nome, 6, false, true);
            controles\comboexterno::Gerar('Estado', 'estado', $estado, 'lib\\estado', 'nome', 'id', true);
            controles\botaoativo::Gerar('Ativo', $ativo, 'Ativo', 'Sim', 'Sim', 'Nao', 'Não');
            controles\botoescadastro::Gerar();
            ?>
        </form>
    </div>
<?php
$js[]   = 'js/cadastro.js';
$js[]   = 'js/cidade.js';
include('footer.php');
?>