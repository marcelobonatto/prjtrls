<?php
namespace lib;

class autorizacao
{
    public $id;
    public $usuario;
    public $data;
    public $ip;

    public function Salvar()
    {
        if ($this->id == null)
        {
            $id     = '{ID}';
        }
        else
        {
            $id     = $this->id;
        }

        $ip         = $this->ObterIPCliente();

        if ($id == '{ID}')
        {
            return $this->Incluir($id, $ip);
        }
        else
        {
            return $this->Atualizar($id, $ip);
        }
    }
        
    public function Incluir($id, $ip)
    {
        $sql    = 'INSERT INTO autorizacao ' .
                  '(autoId, usuarioId, autoData, autoIP) ' . 
                  "VALUES ('$id', '$this->usuario', '$this->data', '$ip')";

        $db         = new bancodados();
        $this->id   = $db->ExecutarRetornaId($sql);

        if ($this->id != null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Atualizar($id, $ip)
    {
        $sql    = 'UPDATE autorizacao ' .
                  "SET autoData = '$this->data', " .
                  "autoIP = '$ip' " .
                  "WHERE autoId = '$id'";

        $db         = new bancodados();
        $db->Executar($sql);

        return true;
    }

    function ObterIPCliente()
    {
        $ip     = '';

        if ($_SERVER['HTTP_CLIENT_IP'])
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if($_SERVER['HTTP_X_FORWARDED'])
        {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if($_SERVER['HTTP_FORWARDED_FOR'])
        {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if($_SERVER['HTTP_FORWARDED'])
        {
            $ip = $_SERVER['HTTP_FORWARDED'];
        }
        else if($_SERVER['REMOTE_ADDR'])
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            $ip = 'UNKNOWN';
        }
   
        return $ip; 
    }
}
?>