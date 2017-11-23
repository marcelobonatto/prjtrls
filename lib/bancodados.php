<?php
class bancodados
{
    function Conectar()
    {
        $mysqli = null;

        if (PHP_OS == 'WINNT')
        {
            //No Windows
            $mysqli = new mysqli("localhost", "root", "", "prjtrls");
        }
        else
        {
            //No Mac
            $mysqli = new mysqli("localhost", "root", "root", "prjtrls", 8889);
        }

        $mysqli->set_charset("utf8");

        return $mysqli;
    }
    
    public function SelecaoSimples($comando)
    {
        $mysqli = $this->Conectar();

        $res = $mysqli->query($comando);

        if (!is_bool($res))
        {
            $itens = $res->fetch_all();
        }
        else
        {
            $itens = $res;
        }

        $mysqli->close();

        return $itens;
    }

    public function Executar($comando)
    {
        $mysqli = $this->Conectar();       
        $res = $mysqli->query($comando);
        $mysqli->close();
    }

    public function ExecutarRetornaId($comando)
    {
        $mysqli     = $this->Conectar($comando);

        $resu       = $mysqli->query('SELECT UUID() id');
        $uuid       = $resu->fetch_object();
        $nextid     = $uuid->id;
        
        $comando    = str_replace('{ID}', $nextid, $comando);
        $res        = $mysqli->query($comando);

        $mysqli->close();

        if ($res === TRUE)
        {
            return $nextid;
        }
        else
        {
            return null;
        }
    }
}
?>