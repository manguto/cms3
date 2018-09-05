<?php
namespace manguto\repository;

use manguto\model\Model;
use manguto\lib\Arquivos;
use manguto\lib\Diretorios;
use manguto\lib\Strings;
use manguto\lib\Log;

class Repository extends Model
{

    // pasta onde serao disponibilizados os arquivos de dados
    private const foldername = 'repository';

    // ==================================================================================== PUBLIC
    // ==================================================================================== PUBLIC
    // ==================================================================================== PUBLIC
    public function __construct(int $idValue = 0)
    {
        parent::__construct($idValue);

        if ($idValue != 0) {
            $this->get();
        }
    }

    public function save()
    {
        $repositoryArray = Repository::getRepositoryARRAY($this->getModelname());
        if ($this->getIdValue() == 0) {
            $idValue = sizeof($repositoryArray) + 1;
            $this->setIdValue($idValue);
        }
        $repositoryArray[$this->getIdValue()] = $this->getData();
        Repository::saveRepositoryARRAY($this->repositoryname, $repositoryArray);
    }

    public function get()
    {
        $repositoryArray = Repository::getRepositoryARRAY($this->repositoryname);
        if (isset($repositoryArray[$this->getIdValue()])) {
            $this->setData($repositoryArray[$this->getIdValue()]);
        } else {
            throw new \Exception("O registro de identificador '" . $this->getIdValue() . "', não foi encontrado no repositório '" . $this->repositoryname . "'.");
        }
    }

    public function delete()
    {
        $repositoryArray = Repository::getRepositoryARRAY($this->repositoryname);
        if (isset($repositoryArray[$this->getIdValue()])) {
            $idValueOld = $this->getIdValue();
            $idValueDeleted = abs($this->getIdValue())*(-1);            
            $this->setIdValue($idValueDeleted);
            $repositoryArray[$idValueDeleted] = $this->getData();
            unset($repositoryArray[$idValueOld]);
            Repository::saveRepositoryARRAY($this->repositoryname, $repositoryArray);
        } else {
            throw new \Exception("O registro de identificador '" . $this->getIdValue() . "', não foi encontrado no repositório '" . $this->repositoryname . "'.");
        }
    }

    // ==================================================================================== STATIC
    // ==================================================================================== STATIC
    // ==================================================================================== STATIC
    static function getRepositoryLength(string $repositoryname): int
    {
        $repositoryFull = Repository::getRepository($repositoryname, 'FULL');
        $repositoryLength = sizeof($repositoryFull);
        return $repositoryLength;
    }

    static function getRepository(string $repositoryname, string $conditions = '',bool $returnAsObject=true): array
    {
        $repositoryARRAY = Repository::getRepositoryARRAY($repositoryname);
        //deb($repositoryARRAY);
        //troca de aspas simples por duplas
        $conditions = str_replace("'", '"', $conditions);       

        //deb($conditions,0);
        $idname = Model::getIdnameStatic($repositoryname);
        { // condition analisys
            if ($conditions == '') {                
                //Log::this("$repositoryname => $idname");
                $conditions = " \$$idname>0 ";
            } elseif ($conditions == 'FULL') {
                $conditions = " true ";
            } else {
                $conditions = " \$$idname>0 && ( $conditions )";
            }
        }
        
        foreach ($repositoryARRAY as $idValue => $entry_asArray) {
            extract($entry_asArray);
            //deb($conditions,0);
            $condition = "\$conditionsConfirmed = ( $conditions );";
            
            Log::this($condition,'repository_condition');
            
            //#####################################################
            //#####################################################
            //#####################################################
            eval($condition);
            //#####################################################
            //#####################################################
            //#####################################################
            
            // deb($conditionsConfirmed);
            if ($conditionsConfirmed == true) {                
                if($returnAsObject){
                    $modelClassname = '\lib\model\\' . $repositoryname; // deb($modelClassname);
                    $entry_asModel = new $modelClassname(); // deb($entryModel);
                    $entry_asModel->setData($entry_asArray); // deb($entryModel);
                    $repositoryARRAY[$idValue] = $entry_asModel;
                }else{
                    $repositoryARRAY[$idValue] = $entry_asArray;
                }
                
                // $returnRepositoryARRAY[$index] = $entry;
            } else {
                unset($repositoryARRAY[$idValue]);
            }
        }

        return $repositoryARRAY;
    }
    
    static function clearRepository($repositoryname) {
        Arquivos::excluir(self::getRepositoryFilename($repositoryname));
    }
    
    static function showRepository($repositoryname) {
        $repositoryCSV = Repository::getRepositoryCSV($repositoryname);
        $repositoryCSV = Strings::showCSV($repositoryCSV);
        return "<pre>$repositoryCSV</pre>";
    }

    
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS
    // ============================================================================================================================== INTERNAL AUX FUNCTIONS

    /**
     * obter o conteudo da tabela em csv
     *
     * @param string $repositoryname
     * @return string
     */
    private static function getRepositoryCSV(string $repositoryname): string
    {
        // nome do arquivo em questao 'tabela.csv'
        $filename = Repository::getRepositoryFilename($repositoryname);

        // verificacao se o arquivo ja existe
        Repository::saveRepositoryCSV_START($repositoryname, $filename);

        // obtencao do conteudo
        $repositoryCSV = Arquivos::obterConteudo($filename);
        
        //transformar codificacao do texto
        $repositoryCSV = utf8_encode($repositoryCSV);
        
        return $repositoryCSV;
    }

    // ==============================================================================================================================-

    /**
     * salvar o conteudo da tabela em arquivo (csv)
     *
     * @param string $repositoryname
     * @param string $repositoryCSV
     */
    private static function saveRepositoryCSV(string $repositoryname, string $repositoryCSV)
    {
        //verificacao do diretorio
        Diretorios::mkdir(Repository::foldername);
        //transformar codificacao do texto
        $repositoryCSV = utf8_decode($repositoryCSV);
        //salvar arquivo
        Arquivos::escreverConteudo(Repository::getRepositoryFilename($repositoryname), $repositoryCSV);
    }

    // ==============================================================================================================================-

    /**
     * inicializa o conteudo da tabela em arquivo (csv) caso esta ainda nao exista
     *
     * @param string $repositoryname
     * @param string $filename
     */
    private static function saveRepositoryCSV_START(string $repositoryname, string $filename)
    {
        if (! file_exists($filename)) {
            // montagem do arquivo zerado
            $objectClassname = '\lib\model\\' . $repositoryname;
            $object = new $objectClassname();
            $data = $object->getData();
            $defaultArray = [];
            $defaultEntryArray = [];
            foreach (array_keys($data) as $key) {
                $defaultEntryArray[$key] = '';
            }
            $defaultArray[0] = $defaultEntryArray;
            $repositoryCSV = RepositoryCSV::ArrayToCSV($defaultArray);
            Repository::saveRepositoryCSV($repositoryname, $repositoryCSV);
        }
    }

    // ==================================================================================================================================================
    // ============================================================================================================================================ ARRAY
    // ==================================================================================================================================================
    /**
     * obtem o conteudo da tabela em array
     *
     * @param string $repositoryname
     * @param string $conditions
     * @return string
     */
    private static function getRepositoryARRAY(string $repositoryname)
    {
        { // obtencao do conteudo do arquivo (em csv)
            $CSV = Repository::getRepositoryCSV($repositoryname);
        }
        { // conversao do conteudo em csv para array
            $modelIdname = Model::getIdnameStatic($repositoryname);

            $repositoryARRAY = RepositoryCSV::CSVToArray($CSV, $modelIdname);
        }

        return $repositoryARRAY;
    }

    // ==============================================================================================================================-
    /**
     * converte o array em csv e o salva
     *
     * @param string $repositoryname
     * @param string $repositoryARRAY
     */
    private static function saveRepositoryARRAY(string $repositoryname, array $repositoryARRAY = [])
    {
        // orderby id asc
        ksort($repositoryARRAY);
        //array - csv
        $csv = RepositoryCSV::ArrayToCSV($repositoryARRAY);
        // save
        Repository::saveRepositoryCSV($repositoryname,$csv);
    }

    // ==================================================================================================================================================
    // =========================================================================================================================================== Others
    // ==================================================================================================================================================

    /**
     * obter o nome do arquivo da tabela (.csv)
     *
     * @param string $repositoryname
     * @return string
     */
    private static function getRepositoryFilename(string $repositoryname): string
    {
        $repositoryname = strtolower($repositoryname);
        return Repository::foldername . DIRECTORY_SEPARATOR . $repositoryname . '.csv';
    }
}

?>