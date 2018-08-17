<?php
namespace controles;

class campoemail
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura)
    {
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'email', false, $outras);
    }

    public static function GerarRequerido($rotulo, $campo, $valor, $tamanho, $leitura)
    {
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'email', true, '');
    }
}