<?php
include_once('autoload.php');
include_once('header.php');

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
    $titulo         = '';
    $descricao      = '';
    $ativo          = true;
    $idMoodle       = '';
    $ano            = 1;
    $semestre       = 1;
    $sequencia      = 1;
    $obrigatoria    = true;
    $pai            = '';
    $datade         = '';
    $dataate        = '';
    $urlredir       = '';
}
else
{
    $id             = $getid;

    $missao         = new lib\missao();
    $missao->Selecionar($id);

    $txtid          = $missao->id;
    $nome           = $missao->nome;
    $titulo         = $missao->titulo;
    $descricao      = $missao->descricao;
    $ativo          = $missao->ativo;
    $idMoodle       = $missao->idMoodle;
    $ano            = $missao->ano;
    $semestre       = $missao->semestre;
    $sequencia      = $missao->sequencia;
    $obrigatoria    = $missao->obrigatoria;
    $pai            = $missao->pai;
    $datade         = '';
    $dataate        = '';

    if ($missao->datade != null)
    {
        $datade     = $missao->datade->format('d/m/Y');
    }

    if ($missao->dataate != null)
    {
        $dataate    = $missao->dataate->format('d/m/Y');
    }

    $urlredir       = $missao->urlredir;
}

$outrasobj      = new lib\missao();
$outrasmss      = $outrasobj->ListarRegistrosExceto($getid, true);

$emeobj         = new lib\eixomissaoeixo();
$emearr         = $emeobj->ListarRegistros($getid);
?>
    <div class="conteudo">
        <h1>Cadastro de Missão - <?php echo($id != 'novo' ? $nome : 'Novo Cadastro'); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmMissao" method="post" action="missao.php">
            <ul class="nav nav-tabs" id="meusTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tabMissao" data-toggle="tab" href="#divMissao" role="tab" aria-controls="divMissao" aria-selected="true">Missão</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabEixo" data-toggle="tab" href="#divEixos" role="tab" aria-controls="divEixos" aria-selected="false">Eixos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabFalas" data-toggle="tab" href="#divFalas" role="tab" aria-controls="divFalas" aria-selected="false">Falas dos Personagens</a>
                </li>
            </ul>
            <div class="tab-content" id="meuConteudoTab">
                <div class="tab-pane fade show active" id="divMissao" role="tabpanel" aria-labelledby="tabMissao">
                    <?php include_once('missaoabamissao.php'); ?>
                </div>
                <div class="tab-pane fade" id="divEixos" role="tabpanel" aria-labelledby="tabEixo">
                    <?php include_once('missaoabaeixos.php'); ?>
                </div>
                <div class="tab-pane fade" id="divFalas" role="tabpanel" aria-labelledby="tabFalas">
                    <?php include_once('missaoabafalas.php'); ?>
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
$js[]   = "js/missao.js";
include_once('footer.php');
?>