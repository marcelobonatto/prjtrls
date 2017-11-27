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

    public function descompactar($chave)
    {
//echo(urlencode(gzcompress(base64_encode($chave), 9)));
/*
        $enc64   = base64_encode($chave);
        echo("DESC:  $enc64<br />");

        $com    = gzcompress($enc64);
        echo("COM:  $com<br />");

        $enc    = urlencode($com);
        echo("ENC:  $enc<br />");   */ 
/*
    $enc64   = base64_encode($chave);
    echo("DESC:  $enc64<br />");

    $com    = gzcompress($enc64);
    echo("COM:  $com<br />");

    $enc    = urlencode($com);
    echo("ENC:  $enc<br />");    

    $dec    = urldecode($enc);
    echo("DEC:  $dec<br />");

    $unc    = gzuncompress($dec);
    echo("UNC:  $unc<br />");

    $dec64   = base64_decode($unc);
    echo("DESC:  $dec64<br />");
*/
/*
        $dec    = urldecode($chave);
echo("DEC:  $dec<br />");

        $unc    = gzuncompress($dec);
        echo("UNC:  $unc<br />");

        $desc   = base64_decode($unc);
        echo("DESC:  $desc<br />");        

        $letras = array();

        for ($letra = 0; $letra < strlen($desc); $letra += 3)
        {
            $letras[]   = substr($desc, $letra, 3);
        }
*/
        $contarq    = file_get_contents(realpath('../dados/config.json'));
        $json       = json_decode($contarq);

        $posbusca   = array_search('UNITY', array_column($json->sistemas, 'sistema'));

        if ($posbusca !== FALSE)
        {
            $chaveunity = $json->sistemas[$posbusca]->chave;

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
                $letunt = '';

                for ($cmp = 0; $cmp < strlen($chaveunity); $cmp++)
                {
                    if ($cmp < 14)
                    {
                        $chrunt = $carsrun[$cmp];
                        $chrinf = $cars[$cmp];

                        $dif    = $chrinf - $chrunt;

                        $letunt .= chr($dif);

                        echo("$chrinf - $chrunt = $dif (" . chr($dif) . ")<br />");
                    }
                    else if ($cmp == 14)
                    {
                        $d = \DateTime::createFromFormat('YmdHis', $letunt);
                        $ehdata = $d && $d->format('YmdHis') == $letunt;

                        echo("$letunt - $ehdata<br />");
                    }
                }
            }

            $this->texto    = $letra;
        }
    }
}
?>