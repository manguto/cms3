<?php
use manguto\lib\Help;
use lib\model\User;
use manguto\lib\ProcessResult;

// =============================================================================================================================================
// =============================================================================================================================================
// ========================================= GENERAL FUNCTIONS =======================================================================================
// =============================================================================================================================================
// =============================================================================================================================================
/**
 * Funcao para "debugar" albuma variavel
 *
 * @param
 *            $var
 * @param bool $die
 * @param bool $backtrace
 */
function deb($var, bool $die = true, bool $backtrace = true)
{
    Help::deb($var, $die, $backtrace);
}

function exceptionShow($e,$echo=false){
    $return = '<pre><br/>';
    $return .= '<b>'.nl2br($e->getMessage()).'</b><br/><br/>';
    $return .= $e->getFile() . ' (' . $e->getLine() . ')<br/><br/>';
    $return .= nl2br($e->getTraceAsString()).'<br/><br/>';
    if($echo){
        echo $return;
    }else{
        return $return;
    }    
}

// =============================================================================================================================================
// =============================================================================================================================================
// ======================================== STATIC CLASS METHOD CALLER ========================================================================
// =============================================================================================================================================
// =============================================================================================================================================
/**
 * Get STATIC CLASS METHOD
 *
 * @param string $className
 * @param string $methodName
 * @return
 */
function getStaticClassMethod(string $className, string $methodName, $p1 = NULL, $p2 = NULL, $p3 = NULL, $p4 = NULL, $p5 = NULL)
{
    $return = $className::$methodName($p1, $p2, $p3, $p4, $p5);
    return $return;
}

// =============================================================================================================================================
// =============================================================================================================================================
// ======================================== HTML TEMPLATES FUNCTIONS USE ========================================================================
// =============================================================================================================================================
// =============================================================================================================================================

{

    // ---------------------------------- USER & SESSION
    function checkUserLogged()
    {
        return User::checkUserLogged();
    }

    function getUserName()
    {
        $user = User::getSessionUser();
        return $user->getName();
    }

    function checkUserLoggedAdmin()
    {
        if (checkUserLogged()) {
            $user = User::getSessionUser();
            return intval($user->getadminzoneaccess()) == 0 ? false : true;
        } else {
            return false;
        }
    }
}

{

    // ---------------------------- erro / success / warning
    function checkError()
    {
        return ProcessResult::CHECK('error');
    }

    function checkSuccess()
    {
        return ProcessResult::CHECK('success');
    }

    function checkWarning()
    {
        return ProcessResult::CHECK('warning');
    }

    function getError()
    {
        return ProcessResult::GET('error');
    }

    function getWarning()
    {
        return ProcessResult::GET('warning');
    }

    function getSuccess()
    {
        return ProcessResult::GET('success');
    }
}

{//redirecitoning
    
    function headerLocation($url)
    {
        header('Location: ' . ROOT_LOCATION . $url);
    }
    
    function headerLocationPost(string $URLAbsolute,array $variables=[])
    {
        $url = ROOT_LOCATION . $URLAbsolute;
        
        $inputs = '';
        foreach ($variables as $key => $value) {
            
            //ajuste no caso de parametros informados em array (checkboxes...)
            if(!is_array($value)){
                $inputs .= "$key: <input type='text' name='$key' value='$value' class='form-control mb-2' style='display:none;'>";
            }else{
                $key = $key.'[]';
                foreach ($value as $v){
                    $inputs .= "$key: <input type='text' name='$key' value='$v' class='form-control mb-2' style='display:none;'>";
                }
                
            }
        }
        
        $html = "<!DOCTYPE html>
                <html>
                    <head>
                        <title>REDIRECTION...</title>
                    </head>
                    <body>
                        <section>
                        	<div class='container'>
                        		<form method='post' action='$url' id='postRedirect' style='display:none;'>
                                    $inputs
                        			<input type='submit' value='CLIQUE AQUI PARA CONTINUAR...' style='display:none;'>
                        		</form>
                        	</div>
                        </section>
                    </body>
                </html>
                <script type='text/javascript'>
                    (function() {
                        document.getElementById('postRedirect').submit();
                    })();
                </script>
                
";
                                    echo $html;
    }
    
}


?>