<?php

namespace manguto\cms3\lib;

class ServerHelp{
    
    /**
     * Ajusta o caminho informado com o DIRECTORY SEPARATOR correto do sitema *
     * @param string $path
     * @return string
     */
    static function fixds(string $path): string
    {
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        return $path;
    }
  
    
}


?>