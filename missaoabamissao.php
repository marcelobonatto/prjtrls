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
                    <label for="txtAno">Série:</label>
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
                    <label for="txtDataDe">Disponível a partir de:</label>
                    <input class="form-control col-sm-4" type="date" value="<?php echo($datade); ?>" id="txtDateDe" name="txtDataDe" />
                    <input type="hidden" value="<?php echo($datade); ?>" id="hidDateDe" name="hidDataDe" />
                </div>
                <div class="form-group">
                    <label for="txtDataAte">Disponível até:</label>
                    <input class="form-control col-sm-4" type="date" value="<?php echo($dataate); ?>" id="txtDateAte" name="txtDataAte" />
                    <input type="hidden" value="<?php echo($dataate); ?>" id="hidDateAte" name="hidDataAte" />
                </div>
                <div class="form-group">
                    <label>Curso no Moodle:</label>
                    <select class="form-control col-sm-3" id="cmbMoodle" name="cmbMoodle">
                        <option></option>
                        <?php
                        foreach ($moodlearr as $moodle)
                        {
                            if ($moodle->id == $idMoodle)
                            {
                                $selmoodle  = ' selected=\"selected\"';
                            }
                            else
                            {
                                $selmoodle  = '';
                            }

                            echo("\t\t<option value=\"$moodle->id\"$selmoodle>[$moodle->shortname] $moodle->displayname</option>\n");
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtEndereco">Ao aceitar a missão, o aluno será redirecionado para:</label>
                    <input class="form-control" type="url" value="<?php echo($urlredir) ?>" id="txtEndereco" name="txtEndereco" />
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
                    <div id="divOptObrig" class="btn-group" data-toggle="buttons">
                        <label id="lblObrSim" class="btn btn-success<?php echo($obr1); ?>">
                            <input type="radio" name="optObrigatoria" id="optObrSim" autocomplete="off" value="1"<?php echo($chkobr1); ?>> Sim
                        </label>
                        <label id="lblObrNao" class="btn btn-secondary<?php echo($obr0); ?>">
                            <input type="radio" name="optObrigatoria" id="optObrNao" autocomplete="off" value="0"<?php echo($chkobr0); ?>> Não
                        </label>
                    </div>
                </div>
                <div id="divPai" class="form-group">
                    <?php
                    if ($obrigatoria == 1)
                    {
                        $disabledMissoes    = ' disabled="disabled"';
                        $requiredMissoes    = '';
                    }
                    else
                    {
                        $disabledMissoes    = '';
                        $requiredMissoes    = ' required';
                    }
                    ?>
                    <label class="cmbMissoes">Missão Pai:</label>
                    <select class="form-control col-sm-3" id="cmbMissoes" name="cmbMissoes"<?php echo($disabledMissoes . $requiredMissoes); ?>>
                        <option></option>
                        <?php
                        foreach ($outrasmss as $outra)
                        {
                            if ($outra->id == $pai && $obrigatoria == 0)
                            {
                                $selpai = ' selected="selected"';
                            }
                            else
                            {
                                $selpai  = '';
                            }

                            echo("<option value=\"$outra->id\"$selpai>[A: $outra->ano / S: $outra->semestre / Sq: $outra->sequencia]$outra->nome</option>\n");
                        }
                        ?>
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