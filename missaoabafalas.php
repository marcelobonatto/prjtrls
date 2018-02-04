                <table id="tbFalas" class="table table-striped">
                    <thead class="thead-dark">
                        <th scope="col">
                            Sequência
                        </th>
                        <th scope="col">
                            Personagem
                        </th>
                        <th scope="col">
                            Humor
                        </th>
                        <th scope="col">
                            Fala
                        </th>
                        <th scope="col">
                            &nbsp;
                        </th>
                    </thead>
                    <tbody>
                        <?php
                        $dialogoobj = new lib\dialogonpc();
                        $dialogos   = $dialogoobj->ListarPorMissao($id);

                        $npcobj     = new lib\npc();
                        $npcs       = $npcobj->ListarRegistros(1);

                        foreach ($dialogos as $indice => $dialogo)
                        {
                            echo("<tr>\n");
                            echo("\t<td>\n");
                            echo("\t\t<input type=\"number\" id=\"txtSequencia$indice\" value=\"$dialogo->sequencia\" min=\"1\" max=\"99\" class=\"text-right\" readonly=\"readonly\" />\n");
                            echo("\t\t<input type=\"hidden\" id=\"hidIdFala$indice\" value=\"$dialogo->id\" />\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<select id=\"cmbNPC$indice\">\n");

                            foreach ($npcs as $npc)
                            {
                                if ($dialogo->npc == $npc->id)
                                {
                                    $selected   = ' selected="selected"';
                                }
                                else
                                {
                                    $selected   = '';
                                }

                                echo("\t\t\t<option value=\"$npc->id\"$selected>[$npc->eixoSigla] $npc->nome</option>\n");
                            }

                            echo("\t\t</select>\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<select id=\"cmbHumor$indice\">\n");
                            echo("\t\t\t<option value=\"NO\"" . ($dialogo->humor == "NO" ? ' selected="selected"' : '') . ">Normal</option>\n");
                            echo("\t\t\t<option value=\"AL\"" . ($dialogo->humor == "RI" ? ' selected="selected"' : '') . ">Rindo</option>\n");
                            echo("\t\t\t<option value=\"TR\"" . ($dialogo->humor == "TR" ? ' selected="selected"' : '') . ">Triste</option>\n");
                            echo("\t\t\t<option value=\"ZA\"" . ($dialogo->humor == "ZA" ? ' selected="selected"' : '') . ">Zangado</option>\n");
                            echo("\t\t</select>\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<textarea id=\"txtFala$indice\" rows=\"3\" maxlength=\"8000\" style=\"width: 100%\">$dialogo->texto</textarea>\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<button type=\"button\" id=\"cmdRemover$indice\" class=\"btn btn-link text-danger\" title=\"Remover\"><i class=\"material-icons\">&#xE15C;</i></button>&nbsp;&nbsp;\n");
                            echo("\t\t<button type=\"button\" id=\"cmdCima$indice\" class=\"btn btn-link text-primary\" title=\"Mover para Cima\"><i class=\"material-icons\">&#xE5D8;</i></button>&nbsp;&nbsp;\n");
                            echo("\t\t<button type=\"button\" id=\"cmdBaixo$indice\"  class=\"btn btn-link text-primary\" title=\"Mover para Baixo\"><i class=\"material-icons\">&#xE5DB;</i></button>\n");
                            echo("\t</td>\n");
                            echo("</tr>\n");
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <button type="button" id="cmdIncluirFala" class="btn btn-primary">
                                    <i class="material-icons">&#xE147;</i> Incluir uma nova fala
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>