<?php
namespace manguto\cms3\lib;

class Log
{

    const dir = 'log';

    static function this($msg, $category = '')
    {
        self::checkStruct();
        // $msg = "<span class='log' title='$filename$line$method'>".date('Y-m-d H:i:s')." | $msg</span><br/>".chr(10);
        $return = "<hr><pre>". date('H:i:s d-m-Y') .'</pre>';
        $return .= $msg.'<br/>'.chr(10);
        self::write($return,$category);
    }

    private static function checkStruct()
    {
        { // dir & index.php
            $filename = self::dir . DIRECTORY_SEPARATOR . 'index.php';
            if (! file_exists($filename)) {
                $conteudo = '<?php
$fileList = glob(\'*\');
foreach ($fileList as $filename) {
    if (strpos($filename, \'index\') !== false) {
        continue;
    }
    echo "<a target=\'_blank\' href=\'$filename\'>$filename</a><br>";
}
?>';
                Arquivos::escreverConteudo($filename, $conteudo);
            }
        }
    }

    /**
     * obtem o nome completo do arquivo a ser utilizado para o salvamento do log
     *
     * @return string
     */
    private static function getFilename(string $category=''): string
    {
        $extra = $category!='' ? "_$category" : '';
        
        $filename = self::dir . DIRECTORY_SEPARATOR . date('Y_m_d') . $extra. '.html';

        return $filename;
    }

    /**
     * escreve o conteudo no arquivo de log
     *
     * @param string $data
     */
    private static function write(string $data,string $category='')
    {
        Arquivos::escreverConteudo(self::getFilename($category), $data, FILE_APPEND);
    }
}

?>