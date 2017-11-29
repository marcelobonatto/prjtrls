<?php
namespace lib;

date_default_timezone_set('America/Sao_Paulo');

class autorizacao
{
    const AUTO_ID       = 0;
    const USUARIO_ID    = 1;
    const AUTO_DATA     = 2;
    const AUTO_IP       = 3;

    public $id;
    public $usuario;
    public $data;
    public $ip;

    public function Validar($token)
    {
        $erro   = 0;

        $sql    = "SELECT autoId, usuarioId, autoData, autoIP " .
                  'FROM autorizacao ' .
                  "WHERE autoId = '$token'";

        $db     = new bancodados();
        $res    = $db->SelecaoSimples($sql);

        if ($res !== FALSE)
        {
            if (count($res) > 0)
            {
                $auto   = $res[0];

                $this->id       = $auto[self::AUTO_ID];
                $this->usuario  = $auto[self::USUARIO_ID];
                $this->data     = $auto[self::AUTO_DATA];
                $this->ip       = $auto[self::AUTO_IP];

                $data   = new \DateTime($this->data);
                $datav  = $data->add(date_interval_create_from_date_string('1 hours'));
                $datan  = new \DateTime();

                if ($datav > $datan)
                {
                    $datan      = $datan->add(date_interval_create_from_date_string('1 hours'));
                    $this->data = $datan->format('Y-m-d H:i:s');
                    
                    if (!$this->Salvar())
                    {
                        $erro   = 3;
                    }
                }
                else
                {
                    $erro = 2;
                }
            }
        }
        else
        {
            $erro = 1;
        }

        return $erro;
    }

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

        if (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED']))
        {
            $ip = $_SERVER['HTTP_FORWARDED'];
        }
        else if(isset($_SERVER['REMOTE_ADDR']))
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