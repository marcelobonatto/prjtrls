                <table class="table table-striped">
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
                        $dialogoobj = new dialogonpc();
                        $dialogos   = $dialogoobj->ListarRegistros($id);

                        $npcobj     = new npc();
                        $npcs       = $npcobj->ListarRegistros(1);

                        foreach ($dialogos as $indice => $dialogo)
                        {
                            echo("<tr>\n");
                            echo("\t<td>\n");
                            echo("\t\t<input type=\"number\" id=\"txtSequencia$indice\" name=\"txtSequencia[]\" value=\"$dialogo->sequencia\" min=\"1\" max=\"99\" class=\"text-right\" />\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<select id=\"cmbNPC$indice\" name=\"cmbNPC[]\">\n");

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
                            echo("\t\t<select id=\"cmbHumor$indice\" name=\"cmbHumor[]\">\n");
                            echo("\t\t\t<option value=\"NO\">Normal</option>\n");
                            echo("\t\t\t<option value=\"AL\">Alegre</option>\n");
                            echo("\t\t\t<option value=\"EU\">Eufórico</option>\n");
                            echo("\t\t\t<option value=\"TR\">Triste</option>\n");
                            echo("\t\t\t<option value=\"CH\">Chorando</option>\n");
                            echo("\t\t\t<option value=\"ZA\">Zangado</option>\n");
                            echo("\t\t\t<option value=\"EB\">Extremamente Bravo</option>\n");
                            echo("\t\t\t<option value=\"TQ\">Tranquilo</option>\n");
                            echo("\t\t</select>\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<textarea id=\"\" name=\"\" rows=\"3\" maxlength=\"8000\" style=\"width: 100%\">$dialogo->texto</textarea>\n");
                            echo("\t</td>\n");
                            echo("\t<td>\n");
                            echo("\t\t<a href=\"#\" class=\"text-danger\" title=\"Remover\"><i class=\"material-icons\">&#xE15C;</i></a>&nbsp;&nbsp;\n");
                            echo("\t\t<a href=\"#\" class=\"text-primary\" title=\"Mover para Cima\"><i class=\"material-icons\">&#xE5D8;</i></a>&nbsp;&nbsp;\n");
                            echo("\t\t<a href=\"#\" class=\"text-primary\" title=\"Mover para Baixo\"><i class=\"material-icons\">&#xE5DB;</i></a>\n");
                            echo("\t</td>\n");
                            echo("</tr>\n");
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <a href="#" class="btn btn-primary">
                                    <i class="material-icons">&#xE147;</i> Incluir uma nova fala
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>