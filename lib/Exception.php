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
        /*$return = '<pre><br/>';
        $return .= '<b>' . nl2br($this->getMessage()) . '</b><br/><br/>';
        $return .= $this->getFile() . ' (' . $this->getLine() . ')<br/><br/>';
        $return .= nl2br($this->getTraceAsString()) . '<br/><br/>';
        if ($echo) {
            echo $return;
        } else {
            return $return;
        }*/
        return self::show_($this,$echo);
    }
    
    static function show_($e,$echo=false){
        $type = gettype($e);
        $return = "<pre title='$type'><br/>";
        $return .= '<b>' . nl2br($e->getMessage()) . '</b><br/><br/>';
        $return .= $e->getFile() . ' (' . $e->getLine() . ')<br/><br/>';
        $return .= nl2br($e->getTraceAsString()) . '<br/><br/>';
        if ($echo) {
            echo $return;
        } else {
            return $return;
        }
    }
}

?>