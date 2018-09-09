<?php

namespace manguto\cms3\gms;


use manguto\cms3\lib\Diretorios;
use manguto\cms3\lib\ServerHelp;
use manguto\cms3\lib\Arquivos;

class GMSHelp{
    
    
    static function Initialization(){
                
        if(defined('VIRTUAL_HOST_ACTIVE')){
            
            define('ROOT', GMSHelp::ROOT());
            
            define('ROOT_ACTION', GMSHelp::ROOT_ACTION());
            
            define('ROOT_LOCATION', GMSHelp::ROOT_LOCATION());
            
            define('ROOT_TPL', GMSHelp::ROOT_TPL());
            
        }else{
            throw new \Exception("A constante 'VIRTUAL_HOST_ACTIVE' não foi definida. Defina-a no arquivo de CONFGURAÇÕES e tente novamente.");
        }
    }
        
    private static function ROOT()
    {
        if (VIRTUAL_HOST_ACTIVE) {
            $uri_levels = explode('/', $_SERVER['REQUEST_URI']);
            $return = str_repeat('..' . DIRECTORY_SEPARATOR, sizeof($uri_levels) - 1);
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_ACTION(){
        if (VIRTUAL_HOST_ACTIVE) {
            $return = '';
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_LOCATION(){
        if (VIRTUAL_HOST_ACTIVE) {
            $return = '';
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_TPL()
    {
        if (VIRTUAL_HOST_ACTIVE) {
            $return = $_SERVER['DOCUMENT_ROOT'];
        } else {
            $return = '../'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }

    //##################################################################################################################################################################
    //##################################################################################################################################################################
    //##################################################################################################################################################################

    static function Setup($echo=true){
        
        try {
            
            $relat = [];
            $relat[] = "<hr/>";
            $relat[] = "<h1>SETUP</h1>";
            $relat[] = "<h2>Procedimento de instalação do General Managemente System (GMS) inicializado</h2>";
            $relat[] = "<br/>";
            $relat[] = "<br/>";            
            //config
            $originFilesPath = ServerHelp::fixds('vendor/manguto/cms3/gms/files');
            
            //get folders/files structure to reply
            $originFiles = Diretorios::obterArquivosPastas($originFilesPath, true, true, true);
            $relat[] = "Foram encontrados '".sizeof($originFiles)."' pastas/arquivos.";
            //deb($foldersFiles);
            //criacao de pastas e arquivos
            $relat[] = "<ol>";
            foreach ($originFiles as $originFile){
                $relat[] = "<li>$originFile";
                $destinationFilePath = str_replace($originFilesPath.DIRECTORY_SEPARATOR,'',$originFile);
                if(is_dir($originFile)){
                    if(!file_exists($destinationFilePath)){
                        Diretorios::mkdir($destinationFilePath);
                        $relat[] = " - Diretório '$destinationFilePath' criado com sucesso!";
                    }
                }else if(is_file($originFile)){
                    if(!file_exists($destinationFilePath)){
                        $data = Arquivos::obterConteudo($originFile);
                        Arquivos::escreverConteudo('.'.DIRECTORY_SEPARATOR.$destinationFilePath, $data);
                        $relat[] = " - Arquivo '$destinationFilePath' criado com sucesso!";
                    }
                }else{
                    throw new \Exception("Tipo de arquivo inadequado (?).");
                }
                $relat[] = "</li>";
            }
            {//troca dos arquivos de index
                {//setup file
                    $filename = 'setup.php';
                    $content = Arquivos::obterConteudo('index.php');
                    Arquivos::escreverConteudo($filename, $content);
                }                
                {//index file
                    $filename = 'index.php';
                    $content = Arquivos::obterConteudo('gms-index.php');
                    Arquivos::escreverConteudo($filename, $content);
                }                
                {//gms-index delete
                    $filename = 'gms-index.php';                    
                    Arquivos::excluir($filename);
                }
                
            }
            
            $relat[] = "</ol>";
            $relat[] = "<h3>Procedimento de SETUP finalizado com sucesso!</h3>";
            $relat[] = "<hr/>";            
            $relat[] = "<a href='index.php' title='Clique aqui para acessar a nova plataforma.'>ACESSO ao SISTEMA</a>";
            $relat[] = "<br/>";
            $relat[] = "<br/>";
            $relat[] = "<br/>";
            $relat[] = "<br/>";
            {//relat
                $relat=implode(chr(10), $relat);
                if($echo){
                    echo $relat;
                }else{
                    return $relat;
                }
            }
        } catch (\Exception $e) {
            echo exceptionShow($e);
        }
         
    }
    
    //##################################################################################################################################################################
    //##################################################################################################################################################################
    //##################################################################################################################################################################
    
}



?>