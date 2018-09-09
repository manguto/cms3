<?php
namespace manguto\cms3\lib;

class ProcessResult
{

    // ##################################### CHECK ERROR/WARNING/SUCCESS MSG EXISTS ###################################################
    // ##################################### CHECK ERROR/WARNING/SUCCESS MSG EXISTS ###################################################
    // ##################################### CHECK ERROR/WARNING/SUCCESS MSG EXISTS ###################################################
    /**
     * verifica se existem mensagens do tipo informado
     *
     * @param string $type
     * @throws Exception
     * @return bool
     */
    public static function CHECK(string $type): bool
    {
        $type = ucfirst(strtolower($type));
        if ($type == 'Error' || $type == 'Success' || $type == 'Warning') {
            if (isset($_SESSION['ProcessResult'][$type]) && sizeof($_SESSION['ProcessResult'][$type]) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("Tipo de resultado de processo incorreto ($type).");
        }
    }

    // ##################################### GET ERROR/WARNING/SUCCESS MSG ###################################################
    // ##################################### GET ERROR/WARNING/SUCCESS MSG ###################################################
    // ##################################### GET ERROR/WARNING/SUCCESS MSG ###################################################
    /**
     * obtem as mensagens (HTML) do tipo informado caso existam
     *
     * @param string $type
     * @return string
     */
    public static function GET(string $type): string
    {
        $type = ucfirst(strtolower($type));

        $return = [];
        if (self::check($type)) {
            foreach ($_SESSION['ProcessResult'][$type] as $id => $msg) {
                $return[] = self::{'get' . $type}($id);
            }
        }
        // $return[] = '<li>Process Result!</li>';
        if (sizeof($return) == 1) {
            $return = implode('', $return);
        } elseif (sizeof($return) > 1) {
            $return = '<ul><li>' . implode('</li><li>', $return) . '</li></ul>';
        } else {
            $return = '';
        }

        return $return;
    }

    // ##################################### ERROR CONTROL ###################################################
    // ##################################### ERROR CONTROL ###################################################
    // ##################################### ERROR CONTROL ###################################################
    public static function setError($expection_or_message)
    {
        //verifica se o parametro informado eh do tipo exception ou string
        if (is_object($expection_or_message)) {            
            $msg = $expection_or_message->getMessage();            
            Log::this($expection_or_message->show(),'EXCEPTION');
        } else {
            $msg = $expection_or_message;
            Log::this($msg,'ERROR');            
        }

        $_SESSION['ProcessResult']['Error'][] = $msg;
    }

    private static function getError(string $id): string
    {
        $msg = '';
        if (isset($_SESSION['ProcessResult']['Error'][$id])) {
            $msg = $_SESSION['ProcessResult']['Error'][$id];
            unset($_SESSION['ProcessResult']['Error'][$id]);
        }
        return $msg;
    }

    // ################################### WARNING CONTROL ###################################################
    // ################################### WARNING CONTROL ###################################################
    // ################################### WARNING CONTROL ###################################################
    public static function setWarning($expection_or_message)
    {
        
        //verifica se o parametro informado eh do tipo exception ou string
        if (is_object($expection_or_message)) {
            $msg = $expection_or_message->getMessage();
            Log::this($expection_or_message->show(),'WARNING');
        } else {
            $msg = $expection_or_message;
            Log::this($msg,'WARNING');
        }
        
        $_SESSION['ProcessResult']['Warning'][] = $msg;
    }

    private static function getWarning(string $id): string
    {
        $msg = '';
        if (isset($_SESSION['ProcessResult']['Warning'][$id])) {
            $msg = $_SESSION['ProcessResult']['Warning'][$id];
            unset($_SESSION['ProcessResult']['Warning'][$id]);
        }
        return $msg;
    }

    // ################################### SUCCESS CONTROL ###################################################
    // ################################### SUCCESS CONTROL ###################################################
    // ################################### SUCCESS CONTROL ###################################################
    public static function setSuccess($expection_or_message)
    {
        //verifica se o parametro informado eh do tipo exception ou string
        if (is_object($expection_or_message)) {
            $msg = $expection_or_message->getMessage();
            Log::this($expection_or_message->show(),'SUCCESS');
        } else {
            $msg = $expection_or_message;
            Log::this($msg,'SUCCESS');
        }
        
        $_SESSION['ProcessResult']['Success'][] = $msg;
    }

    private static function getSuccess(string $id): string
    {
        $msg = '';
        if (isset($_SESSION['ProcessResult']['Success'][$id])) {
            $msg = $_SESSION['ProcessResult']['Success'][$id];
            unset($_SESSION['ProcessResult']['Success'][$id]);
        }
        return $msg;
    }

    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ VARIABLES PASSAGE CONTROL @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ VARIABLES PASSAGE CONTROL @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ VARIABLES PASSAGE CONTROL @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ VARIABLES PASSAGE CONTROL @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ VARIABLES PASSAGE CONTROL @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    public static function setVar(string $variableName, $variableValue)
    {
        /*
         * if(isset($_SESSION['ProcessResult']['Parameters'][$variableName])){
         * throw new Exception("Parâmetro já definido na sessão ('$variableName').");
         * }
         */
        $_SESSION['ProcessResult']['Parameters'][$variableName] = serialize($variableValue);
    }

    public static function checkVar($variableName)
    {
        if (isset($_SESSION['ProcessResult']['Parameters'][$variableName])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getVar(string $variableName, bool $unset = true)
    {
        if (self::checkVar($variableName)) {
            $return = $_SESSION['ProcessResult']['Parameters'][$variableName];
            $return = unserialize($return);
            if ($unset) {
                unset($_SESSION['ProcessResult']['Parameters'][$variableName]);
            }
        } else {
            $return = null;
            // throw new Exception("Variável não encontrada na sessão ($variableName).");
        }
        return $return;
    }
}

?>