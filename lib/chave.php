<?php
namespace lib;
/*
Para o C#:
private static byte[] GZipCompress(byte[] data)
{
    using(var input = new MemoryStream(data))
    using (var output = new MemoryStream())
    {
        using (var gzip = new GZipStream(output, CompressionMode.Compress, true))
        {
            input.CopyTo(gzip); 
        }
        return output.ToArray();
    }
}
*/

class chave
{
    public $real;
    public $texto;
    public $erro        = 0;

    public function descompactar($chave)
    {
        $contarq    = file_get_contents(realpath('../dados/config.json'));
        $json       = json_decode($contarq);

        $posbusca   = array_search('UNITY', array_column($json->sistemas, 'sistema'));

        if ($posbusca !== FALSE)
        {
            $chaveunity = $json->sistemas[$posbusca]->chave;
/*
            $letrun     = array();

            for ($j = 0; $j < strlen($chaveunity); $j++)
            {
                $caracter   = substr($chaveunity, $j, 1);
                $letrun[]   = $caracter;
                $carsrun[]  = ord($caracter);
            }

            $unc        = gzuncompress($chave);
            $dec        = base64_decode($unc);

            $cars       = array();
            $letra      = array();
            
            for ($c = 0; $c < strlen($dec); $c += 3)
            {
                $caracter   = substr($dec, $c, 3);
                $cars[]     = hexdec($caracter);
                $letracar   = chr(hexdec($caracter));
                $letra[]    = $letracar;
            }

            if (strlen($chaveunity) == count($letra))
            {
                $letunt     = '';
                $letsnh     = '';
                $ok         = true;
                $fimsenha   = false;

                for ($cmp = 0; $cmp < strlen($chaveunity); $cmp++)
                {
                    if ($cmp < 14)
                    {
                        $chrunt = $carsrun[$cmp];
                        $chrinf = $cars[$cmp];

                        $dif    = $chrinf - $chrunt;

                        $letunt .= chr($dif);
                    }
                    else if ($cmp == 14)
                    {
                        $data   = \DateTime::createFromFormat('YmdHis', $letunt);
                        $ehdata = $data && $data->format('YmdHis') == $letunt;

                        if (!$ehdata)
                        {
                            $this->erro = 2;
                            break;
                        }

                        if ($carsrun[$cmp] != $cars[$cmp])
                        {
                            $this->erro = 3;
                            break;
                        }
                    }
                    else if (($cmp > 14 && $cmp < 26) || $fimsenha)
                    {
                        if ($carsrun[$cmp] != $cars[$cmp])
                        {
                            $this->erro = 3;
                            break;
                        }
                    }
                    else if ($cmp >= 26 && !$fimsenha)
                    {
                        $chrunt = $carsrun[$cmp];
                        $chrinf = $cars[$cmp];

                        $dif    = $chrinf - $chrunt;

                        if ($dif == 127)
                        {
                            $fimsenha   = true;
                        }
                        else
                        {
                            $letsnh     .= chr($dif);
                        }
                    }
                }
            }
            else
            {
                $this->erro = 1;
            }*/

            $chavedec = base64_decode($chave);

            if (strlen(trim($chavedec)) > 77)
            {
                $letunt = substr($chavedec, 0, 14);
                $data   = \DateTime::createFromFormat('YmdHis', $letunt);
                $ehdata = $data && $data->format('YmdHis') == $letunt;
                
                if (!$ehdata)
                {
                    $this->erro = 2;
                }

                if (substr($chavedec, 14, 63) != $chaveunity)
                {
                    $this->erro = 3;
                }
            }
            else
            {
                $this->erro = 1;
            }

            if ($this->erro == 0)
            {
                $this->real     = $data->format('Y-m-d H:i:s');
                //$this->texto    = $letsnh;
                $this->texto    = substr($chavedec, 77, strlen(trim($chavedec)) - 77);
            }
        }
        else
        {
            $this->erro = 4;
        }
    }
}
?>