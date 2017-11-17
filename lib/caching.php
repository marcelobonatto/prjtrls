<?php
class caching
{
    public static function GravarCache($nome, $array)
    {
        file_put_contents( "cache_file", serialize($array));
    }
}
?>