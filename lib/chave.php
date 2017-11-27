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
    echo("ENC:  $enc<br />");    

    $dec    = urldecode($enc);
    echo("DEC:  $dec<br />");

    $unc    = gzuncompress($dec);
    echo("UNC:  $unc<br />");

    $dec64   = base64_encode($unc);
    echo("DESC:  $dec64<br />");
*/

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

        $this->texto    = $letras;
    }
}
?>