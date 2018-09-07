<?php
session_start();
require_once ("vendor/autoload.php");
use manguto\cms3\lib\Arquivos;
use manguto\cms3\lib\Javascript;
use manguto\cms3\lib\Strings;

try {
    {//configuracoes
        $filename = 'repository/testes.csv';
        $timeout = 1000; //60seg
        $extArray = ['csv','txt'];
    }
    
    
    if(isset($_GET['filename']) && trim($_GET['filename'])!=''){
        $filename = $_GET['filename'];
    }
    if(isset($_GET['filename']) && trim($_GET['timeout'])!=''){
        $timeout = $_GET['timeout'];
    }
    
    {//PRINT
        {//js
            print Javascript::TimeoutDocumentLocation("?filename=$filename&timeout=$timeout",$timeout);
        }
        {//text content
            $ext = strtolower(Arquivos::obterExtensao($filename));
            if(!in_array($ext, $extArray)){
                throw new Exception("Extensão não permitida!");
            }
            $content = Arquivos::obterConteudo($filename);
            $content = utf8_encode($content);
            if($ext=='csv'){
                $content = Strings::showCSV($content);
            }
            print "<pre>";
            print $content;
            print "</pre>";
            exit();
        }
    }
    
} catch (\Exception | \Error | \Throwable $e) {
    $echo = '<pre><br/>';
    $echo .= '<b>'.nl2br($e->getMessage()).'</b><br/><br/>';
    $echo .= $e->getFile() . ' (' . $e->getLine() . ')<br/><br/><br/>';
    $echo .= nl2br($e->getTraceAsString()).'<br/><br/>';
    echo $echo;
}















/*
use Slim\Slim;
use lib\control\Control;

try {
    
    require_once 'gms-functions.php';
    require_once 'gms-configurations.php';
    require_once 'gms-initialization.php';    
    //deb($_SESSION,0);
    
    // SLIM FRAMEWORK CONTROL
    {
        $app = new Slim();
        $app->config('debug', true);
        Control::Run($app);
        $app->run();
    }
    
} catch (\Exception | \Error | \Throwable $e) {
    $echo = '<pre><br/>';
    $echo .= '<b>'.nl2br($e->getMessage()).'</b><br/><br/>';
    $echo .= $e->getFile() . ' (' . $e->getLine() . ')<br/><br/>';
    $echo .= nl2br($e->getTraceAsString()).'<br/><br/>';
    echo $echo;
}

//session_destroy();
*/
?>