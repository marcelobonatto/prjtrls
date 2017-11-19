                <div class="form-group">
                    <label for="txtId">Código Interno:</label>
                    <input class="form-control col-sm-4" type="text" value="<?php echo($txtid); ?>" id="txtId" name="txtId" readonly="readonly" />
                </div>
                <div class="form-group">
                    <label for="txtNome">Nome:</label>
                    <input class="form-control" type="text" value="<?php echo($nome); ?>" id="txtNome" name="txtNome" required />
                </div>
                <div class="form-group">
                    <label for="txtTitulo">Título:</label>
                    <input class="form-control" type="text" value="<?php echo($titulo); ?>" id="txtTitulo" name="txtTitulo" required />
                </div>
                <div class="form-group">
                    <label for="txtDescricao">Descrição:</label>
                    <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="5" required><?php echo($descricao); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="txtAno">Ano:</label>
                    <input class="form-control col-sm-2" type="number" value="<?php echo($ano); ?>" id="txtAno" name="txtAno" min="1" max="3" required />
                </div>
                <div class="form-group">
                    <label for="txtSemestre">Semestre:</label>
                    <input class="form-control col-sm-2" type="number" value="<?php echo($semestre); ?>" id="txtSemestre" name="txtSemestre" min="1" max="2" required />
                </div>
                <div class="form-group">
                    <label for="txtSequencia">Sequência:</label>
                    <input class="form-control col-sm-2" type="number" value="<?php echo($sequencia); ?>" id="txtSequencia" name="txtSequencia" min="1" max="99" required />
                </div>
                <div class="form-group">
                    <label>Curso no Moodle:</label>
                    <select class="form-control col-sm-3" id="cmdMoodle" name="cmbMoodle">
                        <option value=" ">&nbsp</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Missão é Obrigatória?</label>
                    <br />
                    <?php 
                    if ($obrigatoria == 1)
                    {
                        $obr1       = ' active';
                        $chkobr1    = ' checked';
                        $obr0       = '';
                        $chkobr0    = '';
                    }
                    else
                    {
                        $obr1       = '';
                        $chkobr1    = '';
                        $obr0       = ' active';
                        $chkobr0    = ' checked';
                    }
                    ?>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-success<?php echo($obr1); ?>">
                            <input type="radio" name="optObrigatoria" id="optObrSim" autocomplete="off" value="1"<?php echo($chkobr1); ?>> Sim
                        </label>
                        <label class="btn btn-secondary<?php echo($obr0); ?>">
                            <input type="radio" name="optObrigatoria" id="optObrNao" autocomplete="off" value="0"<?php echo($chkobr0); ?>> Não
                        </label>
                    </div>
                </div>
                <div id="divPai" class="form-group">
                    <label class="cmbMissoes">Missão Pai:</label>
                    <select class="form-control col-sm-3" id="cmbMissoes" name="cmbMissoes" disabled>
                        <option value=" ">&nbsp</option>
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