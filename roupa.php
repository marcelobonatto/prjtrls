<?php
if (!isset($_GET['id']))
{
    header('Location: roupas.php');
}
else
{
    $id = $_GET['id'];
}

include('header.php');
?>
    <div class="conteudo">
        <h1>Cadastro de Roupa - <?php echo(($id != 'novo' ? '<< nome da roupa >>' : 'Novo Cadastro')); ?></h1>
        <br />
        <div id="mensagem" class="alert alert-danger d-none" role="alert">
        </div>
        <form id="frmRoupa">
            <div class="form-group">
                <label for="txtId">Código Interno:</label>
                <input class="form-control col-sm-4" type="text" value="" id="txtId" name="txtId" readonly="readonly" />
            </div>
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input class="form-control" type="text" value="" id="txtNome" name="txtNome" required />
            </div>
            <div class="form-group">
                <label for="txtNivel">Nível:</label>
                <input class="form-control col-sm-2" type="number" value="" id="txtNivel" name="txtNivel" min="0" max="30" required />
            </div>
            <div class="form-group">
                <label for="txtEixo">Eixo (colocar dinâmico):</label>
                <select class="form-control col-sm-3" id="cmbEixo" name="cmbEixo">
                    <option value="">Todos</option>
                    <option value="E">Engenharia</option>
                    <option value="N">Negócios</option>
                    <option value="S">Saúde</option>
                    <option value="H">Humanas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="txtBonus">Bônus (%):</label>
                <input class="form-control col-sm-2" type="number" value="" id="txtBonus" name="txtBonus" min="0" max="100" required />
            </div>
            <div class="form-group">
                <label for="txtPreco">Preço:</label>
                <input class="form-control col-sm-3" type="number" value="" id="txtBonus" name="txtPreco" min="0" max="10000" step="10" required />
            </div>
            <div class="form-group">
                <label>Ativo:</label>
                <br />
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success active">
                        <input type="radio" name="optAtivo" id="optSim" autocomplete="off" value="1" checked> Sim
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="optAtivo" id="optNao" autocomplete="off" value="0"> Não
                    </label>
                </div>
            </div>
            <hr />
            <button class="btn btn-info">
                Gravar
            </button>
            <button class="btn btn-danger">
                Voltar
            </button>
        </form>
    </div>
<?php
$js[]   = 'js/roupa.js';
include('footer.php');
?>