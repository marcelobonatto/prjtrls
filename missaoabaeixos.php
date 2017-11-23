                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th scope="col">
                            Eixo
                        </th>
                        <th scope="col">
                            Pontos
                        </th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($emearr as $chave => $eme)
                        {
                            echo("<tr>\n");
                            echo("\t<td>\n\t\t$eme->eixoNome\n\t\t<input type=\"hidden\" id=\"hidId$chave\" value=\"$eme->id\" />\n");
                            echo("\t<input type=\"hidden\" id=\"hidEixo$chave\" value=\"$eme->eixo\" />\n\t</td>\n");
                            echo("\t<td>\n\t\t");
                            echo("<input type=\"number\" id=\"txtPontos$chave\" value=\"$eme->pontos\" style=\"text-align: right\" min=\"0\" max=\"10000\" step=\"10\" />\n\t</td>\n");
                            echo("</tr>\n");
                        }
                        ?>
                    </tbody>
                </table>