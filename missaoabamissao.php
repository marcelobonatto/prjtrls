<!--                <div id="divPai" class="form-group">
                    <
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
                    <select class="form-control col-sm-3" id="cmbMissoes" name="cmbMissoes"< echo($disabledMissoes . $requiredMissoes); ?>>
                        <option></option>
                        <
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
                </div>-->
                <?php
                controles\campotexto::Gerar('Código Interno', 'id', $txtid, 3, true, false);
                controles\campotexto::Gerar('Nome', 'nome', $nome, 12, false, true);
                controles\campotexto::Gerar('Título', 'titulo', $titulo, 12, false, true);
                controles\campoarea::Gerar('Descrição', 'descrocap', $descricao, 12, false, true, 5);
                controles\camponumero::Gerar('Série', 'ano', $ano, 1, false, true, 1, 3);
                controles\camponumero::Gerar('Semestre', 'semestre', $semestre, 1, false, true, 1, 2);
                controles\camponumero::Gerar('Sequência', 'sequencia', $sequencia, 1, false, true, 1, 99);
                controles\campodata::Gerar('Disponível a partir de', 'datade', $datade, 1, false, false);
                controles\campodata::Gerar('Disponível até', 'dataate', $dataate, 1, false, false);
                controles\comboexterno::GerarMaisDescritivo('Curso no Moodle', 'idMoodle', $idMoodle, 'lib\\moodle\\moodle_cursos', array('shortname', 'displayname'), 'id', true);
                controles\campourl::Gerar('Ao aceitar a missão, o aluno será redirecionado para', 'urlredir', $urlredir, 12, false, true);
                controles\botaoativo::Gerar('Missão é Obrigatória?', $obrigatoria, 'Obrigatoria', 'Sim', 'Sim', 'Nao', 'Não');
                controles\botaoativo::Gerar('Ativo', $ativo, 'Ativo', 'Sim', 'Sim', 'Nao', 'Não');
                ?>