<?php
namespace controles;

class camponumero
{
    public static function Gerar($rotulo, $campo, $valor, $tamanho, $leitura, $minimo = null, $maximo = null, $passo = null)
    {
        $outras = camponumero::FormarOutrasPropriedades($minimo, $maximo, $passo);
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'number', false, $outras);
    }

    public static function GerarRequerido($rotulo, $campo, $valor, $tamanho, $leitura, $minimo = null, $maximo = null, $passo = null)
    {
        $outras = camponumero::FormarOutrasPropriedades($minimo, $maximo, $passo);
        campotexto::GerarCompleto($rotulo, $campo, $valor, $tamanho, $leitura, 'number', true, $outras);
    }

    static function FormarOutrasPropriedades($minimo, $maximo, $passo)
    {
        $outras = '';

        if ($minimo != null)    $outras .= " min=\"$minimo\"";
        if ($maximo != null)    $outras .= " max=\"$maximo\"";
        if ($passo != null)     $outras .= " step=\"$passo\"";

        return $outras;
    }
}