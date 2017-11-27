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
        $desc   = gzuncompress(urldecode($chave));
        $unbase = base64_decode($desc);

        $letras = array();

        for ($letra = 0; $letra < strlen($desc); $letra += 3)
        {
            $letras[]   = substr($desc, $letra, 3);
        }

        $this->texto    = $unbase;
    }
}
?>