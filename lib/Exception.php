<?php
namespace manguto\cms3\lib;

class Exception extends \Exception
{

    /**
     * Exibicao de alguma excessao ou mensagem de erro 
     * @param boolean $echo
     * @return string
     */
    public function show($echo = false)
    {
        $return = '<pre><br/>';
        $return .= '<b>' . nl2br($this->getMessage()) . '</b><br/><br/>';
        $return .= $this->getFile() . ' (' . $this->getLine() . ')<br/><br/>';
        $return .= nl2br($this->getTraceAsString()) . '<br/><br/>';
        if ($echo) {
            echo $return;
        } else {
            return $return;
        }
    }
}

?>