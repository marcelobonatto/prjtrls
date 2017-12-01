<?php
namespace lib\ui;

class celulatabela
{
    public $spanlinha       = 1;
    public $spancoluna      = 1;
    public $alinhamento     = 'left';
    public $tipovalor       = 'texto';      //'texto' ou 'check'
    public $valor;
    public $checado         = true;         //apenas se tipovalor for 'check'
    public $valorguardado   = false;
    public $nomecontrole    = '';
    public $ehmatrizcontr   = false;
    public $nomecontresc    = '';
    public $habilitado      = true;
    public $indicepai       = -1;
    public $classe          = '';
}
?>