<?php
use lib\model\User;
use manguto\cms3\lib\ProcessResult;

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

{

    // redirecitoning
    function headerLocation($url)
    {
        header('Location: ' . ROOT_LOCATION . $url);
    }

    function headerLocationPost(string $URLAbsolute, array $variables = [])
    {
        $url = ROOT_LOCATION . $URLAbsolute;
        
        $inputs = '';
        foreach ($variables as $key => $value) {
            
            // ajuste no caso de parametros informados em array (checkboxes...)
            if (! is_array($value)) {
                $inputs .= "$key: <input type='text' name='$key' value='$value' class='form-control mb-2' style='display:none;'>";
            } else {
                $key = $key . '[]';
                foreach ($value as $v) {
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
                </script>";
        echo $html;
    }
}

?>