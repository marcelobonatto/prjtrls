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
    $limite     = 0;
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
    $limite     = $item->limite;
    $preco      = $item->preconormal;
    $ativo      = $item->ativo;
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Carteira - <?php echo(($id != 'novo' ? $nome : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmCarteira" method="post" action="carteira.php">
            <?php
            controles\campotexto::Gerar('C&oacute;digo Interno', 'Id', $txtid, 4, true);
            controles\campotexto::GerarRequerido('Nome', 'Nome', $nome, 12, false);
            controles\camponumero::GerarRequerido('Nível', 'Nivel', $nivel, 2, false, 1, 30);
            controles\camponumero::GerarRequerido('Limite', 'Limite', $limite, 2, false, 0, 10000);
            controles\camponumero::GerarRequerido('Preço', 'Preco', $preco, 2, false, 0, 10000, 10);
            controles\botaoativo::Gerar('Ativo', $ativo, 'Ativo', 'Sim', 'Sim', 'Nao', 'Não');
            controles\botoescadastro::Gerar();
            ?>
        </form>
    </div>
<?php
$js[]   = 'js/carteira.js';
include('footer.php');
?>